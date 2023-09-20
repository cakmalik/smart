<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoicePaymentFile;
use App\Repositories\Invoice\InvoiceRepositoryImplement;
use App\Tables\InvoiceCategories;
use App\Tables\Invoices;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\Splade\Facades\Toast;

class InvoiceController extends Controller
{

    private $repo;

    public function __construct(InvoiceRepositoryImplement $repo)
    {
        $this->repo = $repo;
    }

    function invoiceQuery(Request $request)
    {
        $inv = Invoice::query()
            ->Join('invoice_categories as ic', 'invoices.invoice_category_id', '=', 'ic.id')
            ->select('invoices.*', 'ic.name as category_name');
        return $inv;
    }

    public function index(Request $request)
    {

        $invoices = $this->invoiceQuery($request)
            ->where('status', 'unpaid')
            ->orderByDesc('id')
            ->get();

        $histories = $this->invoiceQuery($request)
            ->where('user_id', auth()->user()->id)
            ->where(function ($q) {
                $q->where('status', 'paid');
                $q->orWhere('status', 'waiting');
            })
            ->get();

        if (auth()->user()->hasRole('santri')) {
            return view('invoice.list', compact('invoices', 'histories'));
        } else {
            return view(
                'invoice.index',
                [
                    'invoices' => Invoices::class
                ]
            );
        }
    }

    public function show($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();

        $invoice->load('file');

        $pi = DB::table('payment_methods')
            ->join('payment_instructions as pi', 'pi.payment_method_id', '=', 'payment_methods.id')
            ->where('payment_methods.id', $invoice->payment_method_id)
            ->first();

        return view('invoice.show', compact('invoice', 'pi'));
    }

    function uploadProof(Request $request)
    {
        $request->validate(
            [
                'invoice_number' => 'required|exists:invoices,invoice_number',
                'from_bank' => 'required',
                'to_bank' => 'required',
                'from_account' => 'required',
                'filename' => 'required|image|mimes:png,jpg',
                'amount' => 'required|numeric',
            ]
        );
        $i = Invoice::where('invoice_number', $request->invoice_number)->first();
        // Get the file from the request
        $imageFile = $request->file('filename');

        // Generate a unique name for the image to avoid conflicts
        $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

        // Store the image in the "public" disk (assuming you have configured it in config/filesystems.php)
        $imageFile->storeAs('public/proof', $imageName);

        //find invoice payment file
        $ipf = InvoicePaymentFile::where('invoice_id', $i->id)->first();
        //jika ada, hapus dulu
        if ($ipf) {
            $ipf->delete();
        }

        try {
            $ifp = new InvoicePaymentFile();
            $ifp->invoice_id = $i->id;
            $ifp->file_name = $imageName;
            $ifp->from_bank = $request->from_bank;
            $ifp->to_bank = $request->to_bank;
            $ifp->from_account = $request->from_account;
            $ifp->to_account = $request->to_account;
            $ifp->amount = $request->amount;
            $ifp->title = $request->title;
            $ifp->reference = $request->reference;
            $ifp->desc = $request->desc;
            $ifp->user_id = auth()->user()->id;
            $ifp->to_account = 'as';
            $ifp->save();

            $i->status = 'waiting';
            $i->save();

            Toast::success('Bukti pembayaran berhasil dikirim')->autoDismiss(20);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Toast::danger('Bukti pembayaran gagal dikirim')->autoDismiss(2);
            Log::error($e->getMessage() . '--' . $e->getLine());
            return back();
        }
    }

    public function confirm(Request $request)
    {
        $request->validate(
            [
                'invoice_number' => 'required|exists:invoices,invoice_number',
            ]
        );

        try {

            $i = Invoice::where('invoice_number', $request->invoice_number)->first();
            $i->status = 'waiting';
            $i->save();

            $ipf = InvoicePaymentFile::where('invoice_id', $i->id)->first();
            $ipf->status = 'reject';
            $ipf->desc = $request->desc;
            $ipf->save();

            Toast::success('Penolakan berhasil dikonfirmasi')->autoDismiss(5);
            return back();
        } catch (\Exception $e) {
            Log::error($e->getMessage() . '--' . $e->getLine());
            Toast::danger('Penolakan gagal dikonfirmasi')->autoDismiss(5);
            return back();
        }
    }

    public function approve($invoice_number)
    {
        DB::beginTransaction();
        try {
            $i = Invoice::where('invoice_number', $invoice_number)->first();
            $i->status = 'paid';
            $i->save();

            $ipf = InvoicePaymentFile::where('invoice_id', $i->id)->first();
            $ipf->status = 'approved';
            $ipf->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . '--' . $e->getLine());
            Toast::error('Pembayaran gagal dikonfirmasi')->autoDismiss(6);
            return back();
        }

        Toast::success('Pembayaran berhasil dikonfirmasi')->autoDismiss(6);
        return redirect()->route('invoice.index');
    }

    public function categories()
    {
        $categories = $this->repo->getCategories();
        return view('invoice.categories', [
            'categories' => InvoiceCategories::class,
        ]);
    }
}

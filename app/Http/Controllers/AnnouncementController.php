<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Announcement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\Splade\SpladeForm;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Input;
use App\Forms\Bakid\CreateAnnouncementForm;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Textarea;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('title', 'LIKE', "%{$value}%");
                });
            });
        });

        $data = QueryBuilder::for(Announcement::class)
            ->defaultSort('title')
            ->allowedSorts(['title'])
            ->allowedFilters(['title', $globalSearch]);

        return view('announcement.index', [
            'data' => SpladeTable::for($data)
                ->withGlobalSearch()
                ->defaultSort('title')
                ->column(key: 'title', searchable: true, sortable: true, canBeHidden: false)
                ->column(key: 'start_show', searchable: true, sortable: true)
                ->column(key: 'end_show', searchable: true, sortable: true)
                ->column(label: 'action')
                ->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcement.create', [
            'form' => CreateAnnouncementForm::class
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request)
    {
        DB::beginTransaction();
        try {
            $start = Carbon::createFromFormat('d-m-Y H:i', $request->start_show);
            $end = Carbon::createFromFormat('d-m-Y H:i', $request->end_show);

            if ($file = $request->file('image')) {
                $filename =  compressAndStoreImage($file, 'announcement');
            }

            $announ = new Announcement();
            $announ->title = $request->title;
            $announ->body = $request->body;
            $announ->start_show = $start->format('Y-m-d H:i:s');
            $announ->end_show = $end->format('Y-m-d H:i:s');
            $announ->created_by = Auth::user()->id;
            $announ->image = $filename;
            $announ->save();

            DB::commit();

            Toast::success('Berhasil menambah pengumuman');
            return redirect()->route('announcement.index');
        } catch (Exception $e) {
            DB::rollBack();
            Toast::danger('Terjadi kesalahan: ' . $e->getMessage());
            Log::error($e->getMessage() . ' - ' . $e->getLine()); // Cek penggunaan Log
            return back()->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        Toast::success(__('Deleted'));
        return back();
    }
}

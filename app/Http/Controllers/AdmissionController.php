<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use ProtoneMedia\Splade\Facades\Toast;
use App\Repositories\User\UserRepository;
use App\Http\Requests\StoreAdmissionRequest;
use App\Http\Requests\UpdateAdmissionRequest;

class AdmissionController extends Controller
{
    protected $model;
    public function __construct(UserRepository $uRepo)
    {
        $this->model = $uRepo;
    }

    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        return view('admissions.register');
    }

    /**
     * check
     *
     * @param  mixed $request
     * @return void
     */
    function check(Request $request)
    {
        $request = $request->only('identifier');
        $attemptsKey = 'login_attempts:' . $request['identifier'];

        // Mengambil jumlah percobaan sebelumnya dari cache
        $attempts = Cache::get($attemptsKey, 0);
        // dd($attempts);

        if ($attempts >= 1) {
            // Jika sudah mencapai batas percobaan, menunggu 1 menit sebelum melanjutkan
            Toast::title('Hummm,')->message('Terlalu banyak percobaan gagal. Coba lagi dalam 1 menit.')->danger()->centerTop()->autoDismiss(3);
            sleep(60); // Menunda eksekusi selama 1 menit
            return back();
        }

        $user = $this->model->check($request['identifier']);
        if (!$user) {
            // Jika akun tidak ditemukan, meningkatkan jumlah percobaan gagal
            $attempts++;
            Cache::put($attemptsKey, $attempts, 1); // Menyimpan jumlah percobaan dalam cache selama 1 menit

            Toast::title('Hummm,')->message('Akun tidak ditemukan')->danger()->centerTop()->autoDismiss(3);
            return back();
        }

        // Jika berhasil, menghapus jumlah percobaan dari cache
        Cache::forget($attemptsKey);

        // Lanjutkan dengan logika berikutnya
        Toast::title('Yeee,')->message('Berhasil.')->success()->centerTop()->autoDismiss(3);

        return view('admissions.login', compact('user'));
    }

    public function loginPost(Request $request)
    {
        dd($request->all());
    }

    public function settings()
    {
        return view('bakid.setting.admission.index');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdmissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admission $admission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admission $admission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdmissionRequest $request, Admission $admission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admission $admission)
    {
        //
    }
}
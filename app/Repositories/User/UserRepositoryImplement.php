<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;
use App\Repositories\User\UserRepository;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function check($identifier)
    {
        $keys = ['username', 'email', 'phone', 'kk']; // Daftar kunci yang ingin diperiksa

        foreach ($keys as $key) {
            $U = $this->model->where($key, '=', $identifier)->first();

            if ($U) {
                return [$key, $identifier]; // Mengembalikan kunci jika nilai identifikator cocok
            }
        }

        return null; // Mengembalikan null jika tidak ada kunci yang cocok
    }

    public function login($request)
    {
        $identifier = $request['identifier'];
        $password = $request['password'];

        $user = $this->model
            ->where(function ($query) use ($identifier) {
                $query->where('username', $identifier)
                    ->orWhere('email', $identifier)
                    ->orWhere('phone', $identifier)
                    ->orWhere('kk', $identifier);
            })
            ->first();

        if (!$user) {
            // Jika akun tidak ditemukan
            Toast::title('Hummm,')
                ->message('Akun tidak ditemukan')
                ->danger()
                ->centerTop()
                ->autoDismiss(3);
            return back();
        }

        // Lakukan logika autentikasi atau tindakan lain yang sesuai

        // Contoh: Memeriksa kata sandi
        if (Hash::check($password, $user->password)) {
            return true;
        } else {
            // Kata sandi tidak cocok
            Toast::title('Oops!')
                ->message('Kata sandi salah')
                ->danger()
                ->centerTop()
                ->autoDismiss(3);
            return back();
        }
    }
}

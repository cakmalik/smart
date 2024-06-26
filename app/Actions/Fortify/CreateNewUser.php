<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string',],
            'kk' => ['required', 'numeric'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        //isthere
        $isthere = User::where('kk', $input['kk'])
            ->orWhere('phone', $input['phone'])
            ->orWhere('email', $input['email'])->first();

        if ($isthere) {
            if ($isthere->email == $input['email']) {
                throw ValidationException::withMessages([
                    'email' => __('The email has already been taken.'),
                ]);
            } elseif ($isthere->phone == $input['phone']) {
                throw ValidationException::withMessages([
                    'phone' => __('Nomor HP sudah digunakan, jika anda pernah mendaftar silahkan login.'),
                ]);
            } elseif ($isthere->kk == $input['kk']) {
                throw ValidationException::withMessages([
                    'kk' => __('Nomor KK sudah digunakan, jika anda pernah mendaftar silahkan login.'),
                ]);
            }
        }

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'phone' => $input['phone'],
                'kk' => $input['kk'],
                'username' => generateUniqueUsername($input['name'])
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));

        $user->assignRole('santri');
    }
}

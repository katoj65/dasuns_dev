<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {




        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'gender'=>['required'],
            'dob'=>['required'],
            'tel'=>['required'],
            'role'=>['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'account_type'=>['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();




        return User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'gender' => $input['gender'],
            'dob' => $input['dob'],
            'tel' => $input['tel'],
            'role' => $input['role'],
            'email' => $input['email'],
            'account_type'=>$input['account_type'],
            'password' => Hash::make($input['password']),
        ]);









    }
}

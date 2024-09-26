<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->fill([
            'first_name'        => 'Super',
            'last_name'         => 'Admin',
            'email'             => 'admin@octaglory.com',
            'password'          => Hash::make('octopus'),
            'status'            => UserStatus::ACTIVE,
            'email_verified_at' => Carbon::now(),
            'roles'             => [(string) Role::SUPER_ADMIN],
            'is_superuser'      => true,
        ]);
        $user->save();
    }
}

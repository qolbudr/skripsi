<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'email' => 'admin@shehrazat.id',
            'password' => Hash::make('admin123'),
            'name' => 'Administrator',
        ]);
    }
}

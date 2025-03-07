<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::query()->updateOrCreate(['email' => 'mohammmed.elabidi123@gmail.com'],[
            'company_id' => 1,
            'name' => 'John Doe',
            'password' => Hash::make('password'),
        ]);
    }
}

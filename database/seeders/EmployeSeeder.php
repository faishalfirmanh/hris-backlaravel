<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 20; $i++) { 
            DB::table('employes')->insert([
                'fullname' => $faker->name,
                'username' => $faker->name,
                'email' => $faker->email,
                'phone_number'=> $faker->phoneNumber,
                'file_cv' =>$faker->state,
                'password' => Hash::make($faker->state),
                'type_employe'=> mt_rand(0,3),
                'created_at'=> \Carbon\Carbon::now()
            ]);
        }
    }
}

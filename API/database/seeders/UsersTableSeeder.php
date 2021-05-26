<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user = User::create([
            'email' =>  'bonnie@sawe.com',
            'name' => $faker->name,
            'password' => bcrypt('123456'),
            'created_at' => now()->subMonths(3)->subDays(22),
        ]);
    }
}

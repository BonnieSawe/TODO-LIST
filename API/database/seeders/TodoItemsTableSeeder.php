<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TodoItem;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TodoItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $faker = Faker::create();

        for ($i=0; $i < 100 ; $i++) { 
            TodoItem::create([
                'name' => $faker->text(30),
                'user_id' => $user->id, 
                'date' => $user->created_at->copy()->addMonths(mt_rand(1,3))->addDays(mt_rand(1,6))->addHours(mt_rand(1,23))->toDateTimeString()
            ]);
        }
      
    }
}

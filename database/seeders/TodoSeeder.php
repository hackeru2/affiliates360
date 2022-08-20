<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Faker;
class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $names = collect(['Install npm' , 'Install componer','Migrate DB']);
        $names->each(function($name ) use($faker) {
                     Todo::factory()->create([
             'name' => $name,
             'user_id' =>  1,
             'project_id' => 1,
             'description' => $faker->paragraph
         ]);
    });
    }
}

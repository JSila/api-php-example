<?php

use App\Lesson;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            Lesson::create([
                'title' => $faker->sentence(5),
                'some_bool' => $faker->boolean(),
                'body' => $faker->paragraph(3)
            ]);
        }
    }

}
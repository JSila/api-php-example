<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class LessonTagTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            DB::table('lesson_tag')->insert([
                'lesson_id' => $index,
                'tag_id' => $faker->randomElement(range(1, 10))
            ]);
        }
    }

}

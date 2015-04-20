<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    protected $tables = [
        'lessons',
        'users',
        'tags',
        'lesson_tag'
    ];

    protected $seeders = [
        'LessonsTableSeeder',
        'UsersTableSeeder',
        'TagsTableSeeder',
        'LessonTagTableSeeder'
    ];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        foreach($this->tables as $table) {
            DB::table($table)->truncate();
        }

        Model::unguard();
        
        foreach($this->seeders as $seeder) {
            $this->call($seeder);
        }

    }

}

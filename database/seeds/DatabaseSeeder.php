<?php

use Illuminate\Database\Seeder;
use Illuminate\Notifications\Notifiable;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      $this->call(ArticlesTableSeeder::class);
      $this->call(CommentsTableSeeder::class);
    }
}

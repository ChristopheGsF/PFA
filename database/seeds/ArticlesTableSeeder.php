<?php

use Illuminate\Database\Seeder;
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Article::class, 4)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Article;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\User::class, 2)->create();
    }
}

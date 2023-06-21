<?php

namespace Database\Seeders;

use App\Models\Groupe;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$admin['name'] = 'admin';
        $admin['email'] = "admin@gmail.com";
        $admin['password'] = Hash::make('admin');
        $admin['email_verified_at'] = now();
        $admin['remember_token'] = Str::random(10);
        User::create($admin);

        $groups = Groupe::factory()->count(6)->create();
        $users = User::factory()->count(26)->create();

        foreach ($users as $user) {
            $randomGroup = $groups->random();
            $user->profile()->save(Profile::factory()->make());
            $user->groupe()->associate($randomGroup);
            $user->save();
        }
    }
}

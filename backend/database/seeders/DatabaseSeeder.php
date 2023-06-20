<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Create fake user and group linked
 * 
 * @category Seedeer
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin['name'] = 'admin';
        $admin['email'] = "admin@gmail.com";
        $admin['password'] = Hash::make('admin');
        $admin['email_verified_at'] = now();
        $admin['remember_token'] = Str::random(10);
        User::create($admin);

        $groups = Group::factory()->count(6)->create();
        $users = User::factory()->count(20)->create();

        foreach ($users as $user) {
            $randomGroup = $groups->random();

            $user->profile()->save(Profile::factory()->make());
            $user->group()->associate($randomGroup);
            $user->save();
        }
    }
}

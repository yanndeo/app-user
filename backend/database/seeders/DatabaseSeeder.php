<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $groups = Group::factory()->count(5)->create();
        $users = User::factory()->count(15)->create();

        foreach ($users as $user) {
            $randomGroup = $groups->random();

            $user->profile()->save(Profile::factory()->make());
            $user->group()->associate($randomGroup);
            $user->save();
        }
    }
}

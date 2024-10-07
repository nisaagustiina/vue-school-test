<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use App\Models\User;
class UpdateUserCommand extends Command
{
    protected $signature = 'user:update';
    protected $description = 'Update user details with random values';

    public function handle()
    {
        $faker = Faker::create();

        $timezones = ['CET', 'CST', 'GMT+1'];

        $users = User::all();

        if ($users->isEmpty()) {
            $this->info('No users found to update.');
            return;
        }

        $users->each(function ($user) use ($timezones, $faker) {
            $oldFirstname = $user->firstname;
            $oldLastname = $user->lastname;
            $oldTimezone = $user->timezone;

            $user->firstname = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->timezone = $timezones[array_rand($timezones)];

            $user->save();

            $this->info("Updated user {$user->id}: {$oldFirstname} {$oldLastname} to {$user->firstname} {$user->lastname} (Timezone: {$oldTimezone} to {$user->timezone})");
        });

        $this->info('User details updated successfully.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Shift;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Device;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Fingerprint;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Device::factory(1)->create();
        User::factory(20)->create()->each(function (User $user) {
            $user->employee()->save(Employee::factory()->make());
            $user->employee->shifts()->saveMany(Shift::factory(2)->make()->each(function (Shift $shift) {
                $shift->device()->associate(Device::first());
            }));
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(TypeUsersSeeder::class);
        $this->call(FunctionSeeder::class);
        $this->call(FunctionHasUsersSeeder::class);
        $this->call(DaysWeekSeeder::class);
        $this->call(TypeServiceSeeder::class);
    }
}

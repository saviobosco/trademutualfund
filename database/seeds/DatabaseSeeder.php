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
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');
        $this->call('InvestmentRulesSeeder');
        $this->command->info('Seeded the Investment Rules!');
        $this->call('InvestmentPlansSeeder');
        $this->command->info('Seeded the Investment Plans!');
        $this->call('PermissionsSeeder');

        // $this->call(UsersTableSeeder::class);
    }
}

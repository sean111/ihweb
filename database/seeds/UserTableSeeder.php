<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Test',
            'last_name' => 'Account',
            'email' => 'test@8thwonder.io',
            'role' => 'dev',
            'firebase_uid' => 'GQraO46Ho4PmCbGlGYXuYZUJQyF3',
            'organization_id' => 1
        ]);
    }
}

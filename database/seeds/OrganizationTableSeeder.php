<?php

use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends  Seeder
{
    public function run()
    {
        DB::table('organizations')->insert([
            'name' => '8thwonder',
            'email' => 'support@8thwonder.io',
            'domain' => '8w',
            'primary_color' => '#0000FF',
            'secondary_color' => '#FFFFFF'
        ]);
    }
}
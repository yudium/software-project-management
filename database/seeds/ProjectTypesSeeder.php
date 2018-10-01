<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_types')->insert([
            'icon' => 'fa fa-television',
            'name' => 'Desktop',
        ]);
        DB::table('project_types')->insert([
            'icon' => 'fa fa-globe',
            'name' => 'Desktop',
        ]);
        DB::table('project_types')->insert([
            'icon' => 'fa fa-television',
            'name' => 'Desktop',
        ]);
        DB::table('project_types')->insert([
            'icon' => 'fe fe-smartphone',
            'name' => 'Desktop',
        ]);
    }
}

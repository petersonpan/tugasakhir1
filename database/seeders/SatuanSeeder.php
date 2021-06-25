<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $now = date_create('now')->format('Y-m-d H:i:s');
        //
        DB::table('satuan')->insert(
        	[
        	'name'=>'pcs',
        	'created_at'=>date("Y/m/d"),
        	'updated_at'=>date("Y/m/d")
        	]
        );
        DB::table('satuan')->insert(
            [
            'name'=>'box',
            'created_at'=>date_create('now')->format('Y-m-d H:i:s'),
            'updated_at'=>date_create('now')->format('Y-m-d H:i:s')
            ],
        );
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatasetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('datasets')->insert([
            [
                'name' => 'National',
                'first_table' => 'national',
                'first_keyword' => 'ridingname',
                'second_table' => 'parliamentlist',
                'second_keyword' => 'ConstituencyName',
                'created_at' => today(),
                'updated_at' => today(),
            ],[
                'name' => 'Ottawa2019',
                'first_table' => 'ottawa2019',
                'first_keyword' => 'ridingname',
                'second_table' => 'ottawalist2019',
                'second_keyword' => 'ConstituencyName',
                'created_at' => today(),
                'updated_at' => today(),
            ],[
                'name' => 'Qbridings2018',
                'first_table' => 'qbridings2018',
                'first_keyword' => 'ridingname',
                'second_table' => 'quebeclist',
                'second_keyword' => 'ConstituencyName',
                'created_at' => today(),
                'updated_at' => today(),
            ]
        ]);
    }
}

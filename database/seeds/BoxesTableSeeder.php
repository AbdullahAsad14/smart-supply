<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxes')->insert([
            [
                'delivery_date' => Carbon::now()->addDays(2)->toDate(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'delivery_date' => Carbon::now()->addDays(5)->toDate(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

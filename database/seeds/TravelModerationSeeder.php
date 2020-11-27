<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelModerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travels')->update([
            'moderation' => '1',
            'sitemap' => '1'
        ]);
    }
}

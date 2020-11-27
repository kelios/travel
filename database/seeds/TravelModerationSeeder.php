<?php

use Illuminate\Database\Seeder;

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

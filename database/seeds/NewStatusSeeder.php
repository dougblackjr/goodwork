<?php

use App\Base\Models\Status;
use Illuminate\Database\Seeder;

class NewStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name'  => 'Blocked',
            'color' => '#000000',
        ]);

        Status::create([
            'name'  => 'On Hold',
            'color' => '#AF0101',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
			[
				'day'=> 'Domingo',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'day'=> 'Segunda-Feira',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'day'=> 'Terça-Feira',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'day'=> 'Quarta-Feira',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'day'=> 'Quinta-Feira',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'day'=> 'Sexta-Feira',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'day'=> 'Sabádo',
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		DB::table('days_weeks')->insert($dados);
    }
}

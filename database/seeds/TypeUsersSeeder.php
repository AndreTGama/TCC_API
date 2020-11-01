<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeUsersSeeder extends Seeder
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
				'type_user'=> 'SUPERVISOR',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'type_user'=> 'COMPANHIA',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'type_user'=> 'CLIENTE',
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		DB::table('type_users')->insert($dados);
    }
}

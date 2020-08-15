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
				'type_user'=> 'ADMIN',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'type_user'=> 'EMPRESA',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
				'type_user'=> 'USUARIO',
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		DB::table('type_users')->insert($dados);
    }
}

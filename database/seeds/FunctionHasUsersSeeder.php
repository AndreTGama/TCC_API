<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionHasUsersSeeder extends Seeder
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
                'type_users_id_type_user'=> 1,
                'functions_id_function' => 5,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
                'type_users_id_type_user'=> 1,
                'functions_id_function' => 6,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_users_id_type_user'=> 1,
                'functions_id_function' => 7,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_users_id_type_user'=> 1,
                'functions_id_function' => 8,
				'created_at' => now(),
				'updated_at' => now(),
            ],
		];
        DB::table('functions_has_type_users')->insert($dados);
    }
}

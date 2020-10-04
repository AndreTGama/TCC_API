<?php

use Illuminate\Database\Seeder;

class FunctionSeeder extends Seeder
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
                'function'=> 'CREATE',
                'functions_id_function' => null,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
                'function'=> 'UPDATE',
                'functions_id_function' => null,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'DELETE',
                'functions_id_function' => null,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'VIEW',
                'functions_id_function' => null,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Cadastro Empresa',
                'functions_id_function' => 1,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Cadastro Cliente',
                'functions_id_function' => 1,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Cadastro Supervisor',
                'functions_id_function' => 1,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Atualizar Empresa',
                'functions_id_function' => 2,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Atualizar Cliente',
                'functions_id_function' => 2,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Atualizar Supervisor',
                'functions_id_function' => 2,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Deletar Empresa',
                'functions_id_function' => 3,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Deletar Cliente',
                'functions_id_function' => 3,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Deletar Supervisor',
                'functions_id_function' => 3,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Visualizar Empresa',
                'functions_id_function' => 4,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Visualizar Cliente',
                'functions_id_function' => 4,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Visualizar Supervisor',
                'functions_id_function' => 4,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Cadastrar Horários',
                'functions_id_function' => 1,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Atualizar Horários',
                'functions_id_function' => 2,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Atualizar Horários',
                'functions_id_function' => 3,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'function'=> 'Ver Horários',
                'functions_id_function' => 4,
				'created_at' => now(),
				'updated_at' => now(),
            ],
		];

		DB::table('functions')->insert($dados);
    }
}

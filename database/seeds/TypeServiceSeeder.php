<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeServiceSeeder extends Seeder
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
                'type_service' => 'Administração de Imóveis',
                'description' => 'Administração de Imóveis',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Decoração',
                'description' => 'Decoração',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Programação e comunicação visual',
                'description' => 'Programação e comunicação visual',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Ensino',
                'description' => 'Ensino',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Engenharia, agronomia, arquitetura, urbanismo e congêneres',
                'description' => 'Engenharia, agronomia, arquitetura, urbanismo e congêneres',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Barbearia e cabeleireiros',
                'description' => 'Barbearia e cabeleireiros',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Centros de emagrecimento e spa',
                'description' => 'Centros de emagrecimento e spa',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Informática',
                'description' => 'Informática',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Jurídicos, Econômicos e Técnicos',
                'description' => 'Jurídicos, Econômicos e Técnicos',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Saúde',
                'description' => 'Saúde',
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'type_service' => 'Veterinária',
                'description' => 'Veterinária',
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		DB::table('types_services')->insert($dados);
    }
}

<?php

namespace App\DAO;

use App\Model\services_company;
use Illuminate\Support\Facades\DB;

class ServicesDAO
{
    /**
     * createServicesCompany
     *
     * @param  array $dados
     * @return object
     */
    public function createServicesCompany(array $dados) : object
    {
        $queryServices = services_company::create($dados);
        return $queryServices;
    }
    /**
     * consultServices
     *
     * @param  array $dados
     * @return object
     */
    public function consultServices(array $dados) : ?object
    {
        $queryServices = DB::table('services_companies')
                        ->join('users', 'users.id_user', 'services_companies.users_id_user');
        if(isset($dados['service'])) $queryServices = $queryServices->where('services_companies.service', $dados['service']);
        if(isset($dados['description'])) $queryServices = $queryServices->where('services_companies.description', $dados['description']);
        if(isset($dados['time'])) $queryServices = $queryServices->where('services_companies.time', $dados['time']);
        if(isset($dados['price'])) $queryServices = $queryServices->where('services_companies.price', $dados['price']);
        if(isset($dados['users_id_user'])) $queryServices = $queryServices->where('services_companies.users_id_user', $dados['users_id_user']);
        if(isset($dados['id_services_company'])) $queryServices = $queryServices->where('services_companies.id_services_company', $dados['id_services_company']);

        $queryServices = $queryServices->get()->first();

        return $queryServices;
    }
    /**
     * updateServices
     *
     * @param  int $idService
     * @param  array $data
     * @return int
     */
    public function updateServices(int $idService, array $data) : ?int
    {
        $queryService = services_company::where('id_services_company', $idService)->update($data);
        return $queryService;
    }
}

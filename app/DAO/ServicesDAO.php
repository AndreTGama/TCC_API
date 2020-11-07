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
    /**
     * listOfServiceOfferedByCompany
     *
     * @param  array $filter
     * @return array
     */
    public function listOfServiceOfferedByCompany(array $filter) : array
    {
        $queryListServices = DB::table('services_companies')
                ->join('types_services', 'types_services.id_type_service', 'services_companies.types_services_id_type_service')
                ->join('users', 'users.id_user', 'services_companies.users_id_user')
                ->select('users.name_user','users.id_user', 'users.e-mail', 'services_companies.id_services_company',
                'services_companies.service', 'services_companies.description', 'services_companies.time',
                'services_companies.price', 'types_services.id_type_service', 'types_services.type_service',
                'types_services.description')
                ->where('services_companies.active', '=', true)
                ->where('types_services.active', '=', true)
                ->where('users.active', '=', true);

        if(isset($filter['price'])) $queryListServices = $queryListServices->where('services_companies.price', '=', $filter['price']);
        if(isset($filter['time'])) $queryListServices = $queryListServices->where('services_companies.time', '=', $filter['time']);
        if(isset($filter['service'])) $queryListServices = $queryListServices->where('services_companies.service', '=', $filter['service']);
        if(isset($filter['types_services_id_type_service'])) $queryListServices = $queryListServices->where('types_services.id_type_service', '=', $filter['types_services_id_type_service']);
        if(isset($filter['usersId'])) $queryListServices = $queryListServices->where('users.id_user', '=', $filter['usersId']);

        $queryListServices = $queryListServices->get()->toArray();

        return $queryListServices;
    }
    /**
     * listOfServiceOfferedToCustomers
     *
     * @param  array $filter
     * @return array
     */
    public function listOfServiceOfferedToCustomers(array $filter) : array
    {
        $queryListServices = DB::table('services_companies')
                ->join('types_services', 'types_services.id_type_service', 'services_companies.types_services_id_type_service')
                ->join('users', 'users.id_user', 'services_companies.users_id_user')
                ->select('users.name_user','users.id_user', 'users.e-mail as email', 'services_companies.id_services_company',
                'services_companies.service', 'services_companies.description', 'services_companies.time',
                'services_companies.price', 'types_services.id_type_service', 'types_services.type_service',
                'types_services.description')
                ->where('services_companies.active', '=', true)
                ->where('types_services.active', '=', true)
                ->where('users.active', '=', true);

        if(isset($filter['price'])) $queryListServices = $queryListServices->where('services_companies.price', '=', $filter['price']);
        if(isset($filter['time'])) $queryListServices = $queryListServices->where('services_companies.time', '=', $filter['time']);
        if(isset($filter['service'])) $queryListServices = $queryListServices->where('services_companies.service', '=', $filter['service']);
        if(isset($filter['types_services_id_type_service'])) $queryListServices = $queryListServices->where('types_services.id_type_service', '=', $filter['types_services_id_type_service']);
        if(isset($filter['users_id_user'])) $queryListServices = $queryListServices->where('users.id_user', '=', $filter['users_id_user']);

        $queryListServices = $queryListServices->get()->toArray();

        return $queryListServices;
    }
    /**
     * viewServiceById
     *
     * @param  int $idService
     * @return object
     */
    public function viewServiceById(int $idService) : ?object
    {
        $queryListServices = DB::table('services_companies')
                ->join('types_services', 'types_services.id_type_service', 'services_companies.types_services_id_type_service')
                ->join('users', 'users.id_user', 'services_companies.users_id_user')
                ->select('users.name_user', 'users.id_user', 'users.e-mail', 'services_companies.id_services_company',
                'services_companies.service', 'services_companies.description', 'services_companies.time',
                'services_companies.price', 'types_services.id_type_service', 'types_services.type_service',
                'types_services.description')
                ->where('services_companies.id_services_company', '=', $idService)
                ->where('services_companies.active', '=', true)->get()->first();

        return $queryListServices;

    }
}

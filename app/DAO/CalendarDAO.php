<?php

namespace App\DAO;

use App\Model\calendar;
use Illuminate\Support\Facades\DB;

class CalendarDAO
{
    /**
     * createCalendar
     *
     * @param  array $datas
     * @return object
     */
    public function createCalendar(array $datas) : object
    {
        $queryCalendar = calendar::create($datas);
        return $queryCalendar;
    }
    /**
     * verifyCalendar
     *
     * @param  array $filter
     * @return object
     */
    public function verifyCalendar(array $filter) : ?object
    {
        $queryCalendar = DB::table('calendars');
        if(isset($filter['day_commitment'])) $queryCalendar = $queryCalendar->where('calendars.day_commitment', $filter['day_commitment']);
        if(isset($filter['hour_commitment'])) $queryCalendar = $queryCalendar->where('calendars.hour_commitment', $filter['hour_commitment']);
        if(isset($filter['note'])) $queryCalendar = $queryCalendar->where('calendars.note', $filter['note']);
        if(isset($filter['services_companies_id_services_company'])) $queryCalendar = $queryCalendar->where('calendars.services_companies_id_services_company', $filter['services_companies_id_services_company']);
        if(isset($filter['users_id_user'])) $queryCalendar = $queryCalendar->where('calendars.users_id_user', $filter['users_id_user']);

        $queryCalendar = $queryCalendar->get()->first();
        return $queryCalendar;
    }
    /**
     * verifyCalendarUserById
     *
     * @param  int $idUser
     * @return array
     */
    public function verifyCalendarUserById(int $idUser) : array
    {
        $queryListCalendar = DB::table('calendars')
                            ->join('services_companies', 'services_companies.id_services_company', 'calendars.services_companies_id_services_company')
                            ->join('users', 'users.id_user', 'services_companies.users_id_user')
                            ->join('types_services', 'types_services.id_type_service', 'services_companies.types_services_id_type_service')
                            ->join('addresses', 'addresses.id_address', 'users.addresses_id_address')
                            ->where('calendars.active', '=', true)
                            ->where('services_companies.active', '=', true)
                            ->where('calendars.users_id_user', '=', $idUser)
                            ->select('calendars.id_calendar', 'calendars.day_commitment', 'calendars.hour_commitment', 'calendars.note','services_companies.id_services_company','services_companies.service', 'services_companies.description','services_companies.time', 'services_companies.price', 'users.id_user', 'users.name_user', 'users.e-mail', 'addresses.id_address',
                            'addresses.postcode', 'addresses.street', 'addresses.number', 'addresses.district', 'addresses.city', 'addresses.state', 'addresses.country')
                            ->get()->toArray();

        return $queryListCalendar;
    }
    /**
     * listCalendarCompany
     *
     * @param  int $idUser
     * @return array
     */
    public function listCalendarCompany(int $idUser) : array
    {
        $queryListCalendar = DB::table('services_companies')
                            ->join('users', 'users.id_user', 'services_companies.users_id_user')
                            ->join('calendars', 'calendars.services_companies_id_services_company', 'services_companies.id_services_company')
                            ->join('users as clients', 'clients.id_user', 'calendars.users_id_user')
                            ->where('users.id_user', '=', $idUser)
                            ->select('calendars.id_calendar', 'calendars.day_commitment', 'calendars.hour_commitment', 'calendars.note','services_companies.id_services_company','services_companies.service', 'services_companies.description','services_companies.time', 'services_companies.price', 'users.id_user', 'clients.name_user', 'clients.e-mail')
                            ->get()->toArray();

        return $queryListCalendar;
    }

}

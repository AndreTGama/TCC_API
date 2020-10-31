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
        $queryCalendar = DB::table('calendar');
        if(isset($filter['day_commitment'])) $queryCalendar = $queryCalendar->where('calendar.day_commitment', $filter['day_commitment']);
        if(isset($filter['hour_commitment'])) $queryCalendar = $queryCalendar->where('calendar.hour_commitment', $filter['hour_commitment']);
        if(isset($filter['note'])) $queryCalendar = $queryCalendar->where('calendar.note', $filter['note']);
        if(isset($filter['services_companies_id_services_company'])) $queryCalendar = $queryCalendar->where('calendar.services_companies_id_services_company', $filter['services_companies_id_services_company']);
        if(isset($filter['users_id_user'])) $queryCalendar = $queryCalendar->where('calendar.users_id_user', $filter['users_id_user']);

        $queryCalendar = $queryCalendar->get()->first();
        return $queryCalendar;
    }

}

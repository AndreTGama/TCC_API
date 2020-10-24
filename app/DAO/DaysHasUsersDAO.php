<?php

namespace App\DAO;

use App\Model\days_weeks_has_users;
use Illuminate\Support\Facades\DB;

class DaysHasUsersDAO
{
    /**
     * createDaysWeeksHasUsers
     *
     * @param  array $data
     * @return object
     */
    public function createDaysWeeksHasUsers(array $data) : object
    {
        $queryDays = days_weeks_has_users::create($data);
        return $queryDays;
    }
    /**
     * consultDaysWeeksHasUsers
     *
     * @param  array $filter
     * @return object
     */
    public function consultDaysWeeksHasUsers(array $filter) : array
    {
        $queryHoursCompany = DB::table('days_weeks_has_users')
                ->join('users', 'users.id_user', 'days_weeks_has_users.users_id_user')
                ->join('days_weeks', 'days_weeks.id_days_week', 'days_weeks_has_users.days_weeks_id_days_week')
                ->join('opening_hours', 'opening_hours.id_opening_hour','days_weeks_has_users.opening_hours_id_opening_hour')
                ->select('days_weeks_has_users.id_days_weeks_has_users','users.id_user','days_weeks.id_days_week',
                'opening_hours_id_opening_hour','days_weeks_has_users.active', 'users.name_user', 'days_weeks.day',
                'opening_hours.open', 'opening_hours.close', 'opening_hours.lunch_time_out',
                'opening_hours.lunch_time_in');

        if(isset($filter['idUser'])) $queryHoursCompany = $queryHoursCompany->where('users.id_user', $filter['idUser']);
        if(isset($filter['idHours'])) $queryHoursCompany = $queryHoursCompany->where('opening_hours.id_opening_hour', $filter['idHours']);
        if(isset($filter['idDays'])) $queryHoursCompany = $queryHoursCompany->where('days_weeks.id_days_week', $filter['idDays']);

        $queryHoursCompany = $queryHoursCompany->get()->toArray();

        return $queryHoursCompany;
    }
    /**
     * viewHoursCompany
     *
     * @param  int $idUser
     * @return array
     */
    public function viewHoursCompany(int $idUser) : array
    {
        $queryHoursCompany = DB::table('days_weeks_has_users')
                            ->join('users', 'users.id_user', 'days_weeks_has_users.users_id_user')
                            ->join('days_weeks', 'days_weeks.id_days_week', 'days_weeks_has_users.days_weeks_id_days_week')
                            ->join('opening_hours', 'opening_hours.id_opening_hour','days_weeks_has_users.opening_hours_id_opening_hour')
                            ->where('users.id_user', $idUser)
                            ->select('days_weeks_has_users.id_days_weeks_has_users','users.id_user','days_weeks.id_days_week',
                            'opening_hours_id_opening_hour','days_weeks_has_users.active', 'users.name_user', 'days_weeks.day',
                            'opening_hours.open', 'opening_hours.close', 'opening_hours.lunch_time_out',
                            'opening_hours.lunch_time_in')
                            ->get()->toArray();
        return $queryHoursCompany;
    }
    /**
     * updateDaysHoursCompany
     *
     * @param  int $idDayUser
     * @param  array $data
     * @return int
     */
    public function updateDaysHoursCompany(int $idDayUser, array $data) : int
    {
        $queryDays = days_weeks_has_users::where('days_weeks_has_users.id_days_weeks_has_users', $idDayUser)
                    ->update($data);
        return $queryDays;
    }
}

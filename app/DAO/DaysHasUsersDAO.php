<?php

namespace App\DAO;

use App\Model\days_weeks_has_users;

class DaysHasUsersDAO
{
    /**
     * createDaysWeeksHasUsers
     *
     * @param  array $dados
     * @return object
     */
    public function createDaysWeeksHasUsers(array $dados) : object
    {
        $queryDays = days_weeks_has_users::create($dados);
        return $queryDays;
    }
}

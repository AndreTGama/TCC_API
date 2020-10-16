<?php

namespace App\DAO;

use App\Model\opening_hours;

class OpenHoursDAO
{
    /**
     * createOpenHours
     *
     * @param  array $dados
     * @return object
     */
    public function createOpenHours(array $dados) : object
    {
        $queryHours = opening_hours::create($dados);
        return $queryHours;
    }
}

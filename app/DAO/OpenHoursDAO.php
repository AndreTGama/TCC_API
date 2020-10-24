<?php

namespace App\DAO;

use App\Model\opening_hours;
use Illuminate\Support\Facades\DB;

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
    /**
     * verifyHours
     *
     * @param  mixed $dados
     * @return object
     */
    public function verifyHours(array $dados) : ?object
    {
        $queryHours = DB::table('opening_hours')
                        ->where($dados)->get()->first();
        return $queryHours;
    }
}

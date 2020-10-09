<?php

namespace App\DAO;

use App\Model\functions;
use Illuminate\Support\Facades\DB;

class FunctionsDAO
{
    public function listFunctions() : object
    {
        $queryListFuntions = functions::all();

        return $queryListFuntions;
    }
}

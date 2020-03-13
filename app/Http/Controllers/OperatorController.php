<?php

namespace App\Http\Controllers;

use ResponseHelper;
use App\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
 	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$operator = Operator::get();
			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $operator, "operators");
    }
}

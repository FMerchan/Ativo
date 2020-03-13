<?php

namespace App\Http\Controllers;

use ResponseHelper;
use App\OperatorPlan;
use Illuminate\Http\Request;

class OperatorPlanController extends Controller
{
 	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$operatorPlans = OperatorPlan::get();
            foreach ($operatorPlans as $key => $operatorPlan) {
                $operatorPlan->operator;
            }

			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $operatorPlans, "operatorPlan");
    }
}

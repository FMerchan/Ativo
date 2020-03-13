<?php

namespace App\Http\Controllers;

use ResponseHelper;
use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
 	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$country = Country::get();
			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $country, "countries");
    }
}

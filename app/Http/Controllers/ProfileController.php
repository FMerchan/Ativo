<?php

namespace App\Http\Controllers;

use ResponseHelper;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   	/**
	 * Busca todos los entrenamientos.
	 **/
    public function create(Request $request)
    {
    	try {
			// Cargo los entrenamientos.
			$data = json_decode($request->json()->all());
			var_dump($data);

			$profile = [];
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $profile, "profile");
    }

}

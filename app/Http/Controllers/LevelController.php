<?php

namespace App\Http\Controllers;
use App\Level;

use ResponseHelper;
use Illuminate\Http\Request;

class LevelController extends Controller
{
	/**
	 * Busca todos los entrenamientos.
	 **/
    public function getAll()
    {
    	try {
			// Cargo los entrenamientos.
			$levels = Level::get();
			
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse(true, 200, $levels, "levels");
    }


    /**
	 * Pregunta si existe o no un level.
	 **/
    public function exist( Request $request )
    {
    	$status = false;
		try {
			$parametros = $request->only(['name', 'value']);

			if ( isset($parametros['name']) && $parametros['name'] != '' &&
				 isset($parametros['value']) && $parametros['value'] != ''
			){
				$parametros['value'] = str_replace(',', '.', $parametros['value']);

				$status = $this->existLevel($parametros['name'], $parametros['value']);
			}
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse($status, 200);
    }

    /**
	 * Crea un level.
	 **/
    public function crear( Request $request )
    {
    	$status = false;
    	$message = "";
		try {
			$parametros = $request->only(['name', 'value']);

			if ( isset($parametros['name']) && $parametros['name'] != '' &&
				 isset($parametros['value']) && $parametros['value'] != '' 
			){
				$parametros['value'] = str_replace(',', '.', $parametros['value']);
				// SI no existe lo creo.
				if ( !$this->existLevel($parametros['name'], $parametros['value']))
				{
					$level = new Level();
					// Cargo los valores.
					$level->name = $parametros['name'];
					$level->value = $parametros['value'];
					// Creo el level
					$level->save();
    				$status = true;
				}else{
					$message = "El level ya existe";
				}
			}else{
				$message = "Parametros Invalidos";
			}
    	} catch (\Exception $e) {
    		return ResponseHelper::armyResponse(false, 400, "Internal Error", "Error: " . $e->getMessage()) ;
    	}

		return ResponseHelper::armyResponse($status, 200, $message);
    }

    /**
     * Verifica si existe o no el objeto.
     **/
    private function existLevel( $name, $value )
    {
    	$return = false;
		if ( isset($name) && $name != '' &&
				isset($value) && $value != ''
		){
			// Cargo las modality.
			$where = [
				'name' => $name,
				'value' => $value,
			];
			$level = Level::where( $where )->orWhere('name', $name)->get();

			if (count($level) > 0) {

				$return = true;
			}
		}

		return $return;
    }
}

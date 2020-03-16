<?php

namespace App;

use App\Country;
use App\Helper\ValidatorHelper;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phone_number';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_phone_number';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_country', 'area_code', 'number',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillableType = [
    	'id_country' => 'int',
        'area_code' => 'int',
        'number' => 'int',
    ];

    /**
     * Funcion para crear un nuevo objeto.
     */
    public function newPhoneNumber($data)
    {
		$phoneNumber = new PhoneNumber();
		$phoneNumber["id_country"] 	= $data["id_country"];
		$phoneNumber["area_code"] 	= $data["area_code"];
		$phoneNumber["number"] 		= $data["number"];
		$phoneNumber->save();
		return $phoneNumber;
    }

    /**
     * Funcion que verifica que la informacion pasada sea correcta.
     */
    public function checkData(array $dataPhone)
    {
    	// Chequeo que esten todos los datos.
    	$result = ValidatorHelper::ifExistKeys($dataPhone, $this->fillableType);
		if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => $result["message"],
    		];
		}
		// Chequeo los parametros.
    	$result = ValidatorHelper::checkDataType($dataPhone, $this->fillableType);
    	if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => $result["message"],
    		];
		}

		// Chequeo el country
		$countryModel = new Country();
		$country = $countryModel->exist($dataPhone['id_country']);
		// Chequeo los parametros.
    	if ($country == false) {
			return [
	    		"status" => false,
	    		"message" => "El Country enviado no existe",
    		];
		}

    	// Retorno el resultado.
    	return ["status" => true, "message" => ''];
    }
}

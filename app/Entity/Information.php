<?php

namespace App;

use App\PhoneNumber;
use App\Helper\ValidatorHelper;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'information';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_information';

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
        'name_last_name', 'city', 'email', 'notification_available', 
        'gender', 'weight', 'height', 'photo', 'id_country', 
        'id_phone_number', 'id_profile'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillableType = [
        'name_last_name' => 'varchar',
        'city' => 'varchar',
        'email' => 'varchar',
        'notification_available'  => 'bool',
        'gender' => 'varchar',
        'weight' => 'double',
        'height' => 'double',
        'id_country' => 'int',
    ];

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function country()
    {
        return $this->belongsTo(Country::class, 'id_country');
    }

    /**
     * Creo la relacion con la tabla Information.
     **/
    public function phoneNumber()
    {
        return $this->belongsTo(PhoneNumber::class, 'id_phone_number');
    }



    /**
     * Funcion para crear un nuevo objeto.
     */
    public function newInformation(array $data)
    {
    	// Creo un phoneNumber model.
		$phoneNumberModel = new PhoneNumber();
		$phoneNumber = $phoneNumberModel->newPhoneNumber($data["phoneNumber"]);

    	// Creo el Information
		$information = new Information();
		// Seteo los valores del inforamtion.
		$information->name_last_name 			= $data["name_last_name"];
		$information->city 						= $data["city"];
		$information->email 					= $data["email"];
		$information->notification_available 	= $data["notification_available"];
		$information->gender 					= $data["gender"];
		$information->weight 					= $data["weight"];
		$information->height 					= $data["height"];
		$information->photo 					= $data["photo"];
		$information->id_country 				= $data["id_country"];
		$information->id_profile 				= $data["id_profile"];
		$information->id_phone_number 			= $phoneNumber->getKey();

		// Gurdo el information.
		$information->save();
		return $information;
    }

    /**
     * Funcion para actualizar un nuevo objeto.
     */
    public function updateAll(int $idProfile, array $data)
    {
        // Creo el Information
        $information = Information::where('id_profile' , '=', $idProfile)->first();
        // Seteo los valores del inforamtion.
        $information->name_last_name            = $data["name_last_name"];
        $information->city                      = $data["city"];
        $information->email                     = $data["email"];
        $information->notification_available    = $data["notification_available"];
        $information->gender                    = $data["gender"];
        $information->weight                    = $data["weight"];
        $information->height                    = $data["height"];
        $information->photo                     = $data["photo"];
        $information->id_country                = $data["id_country"];

        // Gurdo el information.
        $information->save();
        return $information;
    }

    /**
     * Funcion que verifica que la informacion pasada sea correcta.
     */
    public function checkData(array $dataInformation)
    {
    	// Verfico que exista el phoneNumber.
    	if (!isset($dataInformation["phoneNumber"]))
    	{
    		return [
	    		"status" => false,
	    		"message" => "No se encontro el parametro 'phoneNumber'",
    		];
    	}

    	// Chequeo que esten todos los datos.
    	$result = ValidatorHelper::ifExistKeys($dataInformation, $this->fillableType);
		if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => $result["message"],
    		];
		}
		// Chequeo los parametros.
    	$result = ValidatorHelper::checkDataType($dataInformation, $this->fillableType);
    	if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => $result["message"],
    		];
		}

		// Creo un phoneNumber model y verifico la informacion.
		$phoneNumberModel = new PhoneNumber();
		$result = $phoneNumberModel->checkData($dataInformation["phoneNumber"]);
		// Verifico el resultado.
		if ($result["status"] == false) {
			return [
	    		"status" => false,
	    		"message" => "phoneNumber: " . $result["message"],
    		];
		}

		// Chequeo el country
		$countryModel = new Country();
		$country = $countryModel->exist($dataInformation['id_country']);
		// Chequeo los parametros.
    	if ($country == false) {
			return [
	    		"status" => false,
	    		"message" => "El Country pasado no existe",
    		];
		}

    	// Retorno el resultado.
    	return ["status" => true, "message" => ''];
    }

    /**
     * Funcion que devuelve la la informacion de un Information en forma de array.
     */
    static function getArrayInfoByIdProfile($id, $removeId = false)
    {   
        // Cargo Information.
        $information = Information::where('id_profile' , '=', $id)->first();
        $information->country;
        $information->phoneNumber;
        // Quito los ID de la informacion.
        if ($removeId)
        {
            unset($information["id_country"]);
            unset($information["id_information"]);
            unset($information["id_phone_number"]);
            unset($information["id_profile"]);
        }
        return $information;
    }
}

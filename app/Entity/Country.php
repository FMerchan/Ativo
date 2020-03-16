<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country';

    /**
     * The table id.
     *
     * @var string
     */
    protected $primaryKey = 'id_country';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Verifica que existe el country
     * @var int id, el id del country a verificar la existencia.
     * @return retorna false en caso de no existir o el objeto en caso de existir.
     **/
    public function exist( int $id )
    {
        if ($id != '' && $id > 0) {
            // Cargo las modality.
            $level = Country::where( ["id_country" => $id] )->get();

            if (count($level) > 0) {
                return $level;
            }
        }

        return false;
    }
}

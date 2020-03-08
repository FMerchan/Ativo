<?php

namespace App\Providers;
use App\Training;
use App\Level;
use App\Duration;
use App\Distance;
use App\Stage;
use App\Checkpoint;

use Illuminate\Support\ServiceProvider;

class TrainingService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function loadCompletedObject(Training $training, $removeId = false)
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

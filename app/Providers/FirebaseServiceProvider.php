<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;


class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase.database', function ($app) {
            $serviceAccount = base_path('storage/app/firebase/firebase_credentials.json');
            $factory = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri('https://hydrocabin-56d6f-default-rtdb.asia-southeast1.firebasedatabase.app'); 
            return $factory->createDatabase();
        });
    }
}
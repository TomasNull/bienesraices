<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**función para establecer el idioma de la aplicación. 
     * Si existe la configuación que se selecciona se crea una sessión 'applocale' 
     * con la configuración seleccionada 
    */
    public function setLanguage($language) {
        if (array_key_exists($language, config('languages')) ) {
            session()->put('applocale', $language);
        }

        return back();
    }
}

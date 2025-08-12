<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class FichaIndividualController
{

    public function mostraFichaIndividual()
    {
        $id = $_GET['id'];
        $treino = App::get('database')->selectTreino($id); 
        return view('site/pvificha', compact('treino'));
    }
}
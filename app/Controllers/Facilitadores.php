<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacilitadorModel;

class Facilitadores extends BaseController
{
    public function index()
    {
        $facilitador  = new FacilitadorModel();
        $data = [
            'title' => 'Facilitadores',
            'facilitador' => $facilitador->paginate(5),
            'pager' => $facilitador->pager
        ];
        return $this->templater->view('facilitador/index', $data);
    }
    public function new()
    {
        return $this->templater->view('facilitador/new', ['title' => 'Nuevo facilitador']);
    }
    public function create(){
        // var_dump($_REQUEST);
        echo'hola';
    }
}

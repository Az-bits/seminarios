<?php

namespace App\Controllers\Seminarios;

use App\Controllers\BaseController;
use App\Models\FacilitadorModel;

class FacilitadoresController extends BaseController
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
}

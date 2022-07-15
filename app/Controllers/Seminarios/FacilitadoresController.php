<?php

namespace App\Controllers\Seminarios;

use App\Controllers\BaseController;
use App\Models\FacilitadorModel;
use PHPUnit\Util\Xml\Validator;

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
session();
        $validation =  \Config\Services::validation();
        return $this->templater->view('facilitador/new', ['validation'=>$validation,'title' => 'Nuevo facilitador']);
    }
    public function create()
    {
        // var_dump($_REQUEST);
        $validation =  \Config\Services::validation();
        $newFacilitador = new FacilitadorModel();
        if($this->validate('facilitadores')){
           $newFacilitador->insert([
                'ci' => $this->request->getPost('ci'),
                'nombres' => $this->request->getPost('nombres'),
                'paterno' => $this->request->getPost('paterno'),
                'materno' => $this->request->getPost('materno'),
                'genero' => $this->request->getPost('genero'),
                'celular' => $this->request->getPost('celular'),
                'correo' => $this->request->getPost('correo')
            ]);
            return redirect()->to('/facilitadores')->with('success','Facilitador creado correctamente.');
        }
        return redirect()->back()->withInput();
       
    }
}

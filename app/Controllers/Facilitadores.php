<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacilitadorModel;
use \CodeIgniter\Exceptions\PageNotFoundException;

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
        session(); //para que aparescan la lista de errores de validacion esto es un bug
        $validation =  \Config\Services::validation();
        return $this->templater->view('facilitador/new', ['validation' => $validation, 'title' => 'Nuevo facilitador']);
    }
    public function create()
    {
        // var_dump($_REQUEST);
        $newFacilitador = new FacilitadorModel();
        if ($this->validate('facilitadores')) {
            $newFacilitador->insert([
                'ci' => $this->request->getPost('ci'),
                'nombres' => $this->request->getPost('nombres'),
                'paterno' => $this->request->getPost('paterno'),
                'materno' => $this->request->getPost('materno'),
                'genero' => $this->request->getPost('genero'),
                'celular' => $this->request->getPost('celular'),
                'correo' => $this->request->getPost('correo')
            ]);
            return redirect()->to('/facilitadores')->with('message', 'Facilitador creado correctamente.');
        }
        return redirect()->back()->withInput();
    }
    public function edit($id)
    {
        $validation =  \Config\Services::validation();

        $facilitador = new FacilitadorModel();
        if ($facilitador->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Editar facilitador',
            'validation' => $validation,
            'facilitador' =>  $facilitador->find($id)
        ];
        return $this->templater->view('facilitador/edit', $data);
    }
    public function update($id)
    {
        echo 'update';
    }
    public function show()
    {
        echo 'show';
    }
    public function delete($id)
    {
        echo 'delete' . $id;
    }
}

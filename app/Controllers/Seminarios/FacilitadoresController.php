<?php

namespace App\Controllers\Seminarios;

use App\Models\FacilitadorModel;
use \CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\Templater;
use CodeIgniter\RESTful\ResourcePresenter;

class FacilitadoresController extends ResourcePresenter
{
    protected $templater;
    public function __construct()
    {
        $this->templater = new Templater(\Config\Services::request());
    }
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
        $facilitador  = [
            'id_facilitador' => null,
            'ci' => '',
            'nombres' => '',
            'paterno' => '',
            'materno' => '',
            'genero' => '',
            'celular' => '',
            'correo' => '',
            'comple' => ''
        ];
        $validation =  \Config\Services::validation();
        $data = [
            'title' => 'Nuevo facilitador',
            'facilitador' => $facilitador,
            'validation' => $validation
        ];
        return $this->templater->view('facilitador/new', $data);
    }
    public function edit($id = null)
    {
        $validation =  \Config\Services::validation();
        session();
        $facilitador = new FacilitadorModel();
        if ($facilitador->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $dataFacilitador = $facilitador->find($id);
        $posChar = strpos($dataFacilitador['ci'], '-');
        $dataFacilitador['comple'] = $posChar ? substr($dataFacilitador['ci'], $posChar + 1) : '';
        $dataFacilitador['ci'] = $posChar ? substr($dataFacilitador['ci'], 0, strpos($dataFacilitador['ci'], '-')) : $dataFacilitador['ci'];
        $data = [
            'title' => 'Editar facilitador',
            'validation' => $validation,
            'facilitador' =>  $dataFacilitador
        ];
        return $this->templater->view('facilitador/edit', $data);
    }
    public function create()
    {
        // $_REQUEST['genero'] = '';
        // var_dump($_REQUEST);
        $newFacilitador = new FacilitadorModel();
        $ci = $this->request->getPost('ci');
        $posChar = trim(strpos($ci, '-'));
        if ($this->validate('facilitadores')) {
            $newFacilitador->insert([
                'ci' => $posChar ? $ci . '-' . trim($this->request->getPost('comple')) : $ci,
                'nombres' => trim($this->request->getPost('nombres')),
                'paterno' => trim($this->request->getPost('paterno')),
                'materno' => trim($this->request->getPost('materno')),
                'genero' => $this->request->getPost('genero'),
                'celular' => trim($this->request->getPost('celular')),
                'correo' => trim($this->request->getPost('correo'))
            ]);
            return redirect()->to('/facilitadores')->with('message', 'Facilitador creado correctamente.');
        }
        return redirect()->back()->withInput();
    }

    public function update($id = null)
    {
        // var_dump($id);
        // var_dump($_REQUEST);
        $newFacilitador = new FacilitadorModel();
        if (!$newFacilitador->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('facilitadores')) {
            $comple = trim($this->request->getPost('comple'));
            $ci = trim($this->request->getPost('ci'));
            $newFacilitador->update($id, [
                'ci' => $comple ? trim($this->request->getPost('ci')) . '-' . trim($this->request->getPost('comple')) : $ci,
                'nombres' => trim($this->request->getPost('nombres')),
                'paterno' => trim($this->request->getPost('paterno')),
                'materno' => trim($this->request->getPost('materno')),
                'genero' => $this->request->getPost('genero'),
                'celular' => trim($this->request->getPost('celular')),
                'correo' => trim($this->request->getPost('correo'))
            ]);
            return redirect()->to('/facilitadores')->with('message', 'Facilitador editado correctamente.');
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $facilitador = new FacilitadorModel();
        if ($facilitador->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $facilitadorName = $facilitador->find($id);
        $facilitadorName = $facilitadorName['nombres'] . '' . $facilitadorName['paterno'] . ' ' . $facilitadorName['materno'];
        $facilitador->delete($id);
        return redirect()->to('/facilitadores')->with('message', 'Facilitador ' . $facilitadorName . ' eliminado correctamente.');
    }
}

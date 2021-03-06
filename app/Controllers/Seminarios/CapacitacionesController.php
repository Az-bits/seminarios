<?php

namespace App\Controllers\Seminarios;

use App\Models\CursosModel;
use \CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\Templater;
use App\Models\FacilitadorModel;
use App\Models\MaestroCapacitacionesModel;
use CodeIgniter\RESTful\ResourcePresenter;

class CapacitacionesController extends ResourcePresenter
{
    protected $templater;
    public function __construct()
    {
        $this->templater = new Templater(\Config\Services::request());
    }
    public function index()
    {
        $capacitacion  = new MaestroCapacitacionesModel();
        $capacitacionData = $capacitacion->select('mae_capacitaciones.*,nombre_curso')
            ->join('cursos as c', 'c.id_curso= mae_capacitaciones.id_curso')
            ->join('det_capacitaciones as d', 'd.id_mae_capacitacion = mae_capacitaciones.id_mae_capacitacion', 'left')
            ->paginate(5);
        $data = [
            'title' => 'Capacitaciones',
            'capacitaciones' => $capacitacionData,
            'pager' => $capacitacion->pager
        ];
        // var_dump($data['cursos']);
        return $this->templater->view('capacitaciones/ListCapacitaciones', $data);
    }
    public function new()
    {
        session(); //para que aparescan la lista de errores de validacion esto es un bug
        $validation =  \Config\Services::validation();
        $facilitadores = new FacilitadorModel();
        $facilitadoresData = $facilitadores->select('id_facilitador,ci,concat(nombres," ",paterno," ",materno) as nombre_facilitador')
            ->findAll();
        $curso  = [
            'id_curso' => null,
            'nombre_curso' => '',
            'modalidad' => '',
            'precio' => '',
            'id_facilitador' => null
        ];
        $data = [
            'title' => 'Nuevo Curso',
            'curso' => $curso,
            'facilitadores' => $facilitadoresData,
            'validation' => $validation
        ];
        return $this->templater->view('cursos/new', $data);
    }
    public function edit($id = null)
    {
        session();
        $validation =  \Config\Services::validation();
        $curso = new CursosModel();
        $facilitadores = new FacilitadorModel();
        $facilitadoresData = $facilitadores->select('id_facilitador,ci,concat(nombres," ",paterno," ",materno) as nombre_facilitador')
            ->findAll();
        if ($curso->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $dataCurso = $curso->find($id);
        $data = [
            'title' => 'Editar facilitador',
            'validation' => $validation,
            'curso' =>  $dataCurso,
            'facilitadores' => $facilitadoresData
        ];
        return $this->templater->view('cursos/edit', $data);
    }
    public function create()
    {
        $newCurso = new CursosModel();
        if ($this->validate('cursos')) {
            $newCurso->insert([
                'nombre_curso' => trim($this->request->getPost('nombre_curso')),
                'modalidad' => $this->request->getPost('modalidad'),
                'precio' => trim($this->request->getPost('precio')),
                'id_facilitador' => $this->request->getPost('id_facilitador'),
            ]);
            return redirect()->to('/cursos')->with('message', 'Curso creado correctamente.');
        }
        return redirect()->back()->withInput();
    }

    public function update($id = null)
    {
        $_REQUEST['id'] = $id;
        $newFacilitador = new CursosModel();
        if (!$newFacilitador->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('cursos')) {
            $newFacilitador->update($id, [
                'nombre_curso' => trim($this->request->getPost('nombre_curso')),
                'modalidad' => $this->request->getPost('modalidad'),
                'precio' => trim($this->request->getPost('precio')),
                'id_facilitador' => $this->request->getPost('id_facilitador'),
            ]);
            return redirect()->to('/cursos')->with('message', 'Curso editado correctamente.');
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $curso = new CursosModel();
        if ($curso->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $cursoName = $curso->select('nombre_curso')->find($id);
        $curso->delete($id);
        return redirect()->to('/cursos')->with('message', 'Curso ' . $cursoName['nombre_curso'] . ' eliminado correctamente.');
    }
}

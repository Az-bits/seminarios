<?php

namespace App\Controllers\Seminarios\Capacitaciones;

use App\Models\CursosModel;
use \CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\Templater;
use App\Models\FacilitadorModel;
use App\Models\MaestroCapacitacionesModel;
use CodeIgniter\RESTful\ResourcePresenter;

class ListadoController extends ResourcePresenter
{
    protected $templater;
    public function __construct()
    {
        $this->templater = new Templater(\Config\Services::request());
    }
    public function index()
    {
        $capacitacion  = new MaestroCapacitacionesModel();
        $capacitacionData = $capacitacion->select('mae_capacitaciones.id_mae_capacitacion,fecha_ini,fecha_fin ,c.nombre_curso,count(nombre_curso) as cantidad')
            ->join('cursos as c', 'c.id_curso= mae_capacitaciones.id_curso')
            ->join('det_capacitaciones as d', 'd.id_mae_capacitacion = mae_capacitaciones.id_mae_capacitacion')
            ->groupBy('mae_capacitaciones.id_mae_capacitacion , c.nombre_curso')
            ->paginate(5);
        $data = [
            'title' => 'Capacitaciones',
            'capacitaciones' => $capacitacionData,
            'pager' => $capacitacion->pager
        ];
        // var_dump($data['cursos']);
        return $this->templater->view('capacitaciones/listado/ListCapacitaciones', $data);
    }
    public function new()
    {
        session(); //para que aparescan la lista de errores de validacion esto es un bug
        $validation =  \Config\Services::validation();
        $cursos = new CursosModel();
        $capacitaciones = [
            'id_mae_capacitacion' => null,
            'fecha_ini' => '',
            'fecha_fin' => '',
            'id_curso' => '',
        ];
        $data = [
            'title' => 'Nueva Capacitacion',
            'cursos' => $cursos->findAll(),
            'capacitaciones' => $capacitaciones,
            'validation' => $validation
        ];
        return $this->templater->view('capacitaciones/listado/new', $data);
    }
    public function edit($id = null)
    {
        session();
        $validation =  \Config\Services::validation();
        $curso = new CursosModel();
        $capacitaciones = new FacilitadorModel();
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
        var_dump($_REQUEST);
        $newCapacitacion = new MaestroCapacitacionesModel();
        if ($this->validate('listado')) {
            $newCapacitacion->insert([
                'id_curso' => trim($this->request->getPost('id_curso')),
                'fecha_ini' => $this->request->getPost('fecha_ini'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
            ]);
            return redirect()->to('/capacitaciones/listado')->with('message', 'Capacitacion creada correctamente.');
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

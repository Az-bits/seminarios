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
        $capacitacionData = $capacitacion->select('mae_capacitaciones.id_mae_capacitacion,fecha_ini,fecha_fin ,nombre_curso,ifnull(count(d.id_mae_capacitacion),0) as cantidad')
            ->join('cursos as c', 'c.id_curso= mae_capacitaciones.id_curso')
            ->join('det_capacitaciones as d', 'd.id_mae_capacitacion = mae_capacitaciones.id_mae_capacitacion', 'left')
            ->groupBy('mae_capacitaciones.id_mae_capacitacion , d.id_mae_capacitacion')
            ->paginate(5);
        $data = [
            'title' => 'Lista de capacitaciones',
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
        $capacitaciones = new MaestroCapacitacionesModel();
        if ($capacitaciones->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $dataCapacitaciones = $capacitaciones->find($id);
        $data = [
            'title' => 'Editar capacitacion',
            'validation' => $validation,
            'capacitaciones' =>  $dataCapacitaciones,
            'cursos' => $curso->findAll()
        ];
        return $this->templater->view('capacitaciones/listado/edit', $data);
    }
    public function create()
    {
        $newCapacitacion = new MaestroCapacitacionesModel();
        if ($this->validate('listadoCapacitaciones')) {
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
        $capacitacion = new MaestroCapacitacionesModel();
        if (!$capacitacion->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('listadoCapacitaciones')) {
            $capacitacion->update($id, [
                'id_curso' => trim($this->request->getPost('id_curso')),
                'fecha_ini' => $this->request->getPost('fecha_ini'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
            ]);
            return redirect()->to('/capacitaciones/listado')->with('message', 'Capacitacion editado correctamente.');
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $capacitacion = new MaestroCapacitacionesModel();
        if ($capacitacion->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $capacitacion->delete($id);
        return redirect()->to('/capacitaciones/listado')->with('message', 'Capacitacion eliminada correctamente.');
    }
}

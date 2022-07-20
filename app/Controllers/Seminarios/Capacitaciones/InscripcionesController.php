<?php

namespace App\Controllers\Seminarios\Capacitaciones;

use App\Models\CursosModel;
use \CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\Templater;
use App\Models\DetalleCapacitacionesModel;
use App\Models\FacilitadorModel;
use App\Models\MaestroCapacitacionesModel;
use App\Models\ParticipantesModel;
use CodeIgniter\RESTful\ResourcePresenter;

class InscripcionesController extends ResourcePresenter
{
    protected $templater;
    public function __construct()
    {
        $this->templater = new Templater(\Config\Services::request());
    }
    public function index()
    {
        $capacitacion  = new DetalleCapacitacionesModel();
        $capacitacionData = $capacitacion->select('id_det_capacitacion,  concat(nombres," ",paterno," ",materno) as nombre_participante ,nombre_curso')
            ->join('mae_capacitaciones m', 'det_capacitaciones.id_mae_capacitacion = m.id_mae_capacitacion')
            ->join('participantes p', 'det_capacitaciones.id_participante = p.id_participante ')
            ->join('cursos c', 'c.id_curso = m.id_curso')
            ->paginate(5);
        $data = [
            'title' => 'Inscripciones a capacitaciones',
            'capacitaciones' => $capacitacionData,
            'pager' => $capacitacion->pager
        ];
        return $this->templater->view('capacitaciones/inscripciones/ListInscritos', $data);
    }
    public function new()
    {
        session(); //para que aparescan la lista de errores de validacion esto es un bug
        $validation =  \Config\Services::validation();
        $participantes =  new ParticipantesModel();
        $capacitacion = new MaestroCapacitacionesModel();
        $capacitacionesData = $capacitacion->select('id_mae_capacitacion ,nombre_curso ')
            ->join('cursos c', 'mae_capacitaciones.id_curso = c.id_curso')
            ->findAll();
        $detCapacitaciones  = [
            'id_det_capacitacion' => null,
            'id_participante' => null,
            'id_mae_capacitacion' => null,
        ];
        $data = [
            'title' => 'Nueva inscripcion',
            'participantes' => $participantes->select('id_participante,concat(nombres," ",paterno," ",materno) as nombre_participante,ci')->findAll(),
            'capacitaciones' => $capacitacionesData,
            'detCapacitaciones' => $detCapacitaciones,
            'validation' => $validation
        ];
        return $this->templater->view('capacitaciones/inscripciones/new', $data);
    }
    public function edit($id = null)
    {
        session();
        $validation =  \Config\Services::validation();
        $capacitacion = new MaestroCapacitacionesModel();
        $participantes =  new ParticipantesModel();
        $detCapacitaciones = new DetalleCapacitacionesModel();
        $capacitacionesData = $capacitacion->select('id_mae_capacitacion ,nombre_curso ')
            ->join('cursos c', 'mae_capacitaciones.id_curso = c.id_curso')
            ->findAll();
        if ($detCapacitaciones->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Editar Inscripcion',
            'validation' => $validation,
            'participantes' => $participantes->select('id_participante,concat(nombres," ",paterno," ",materno) as nombre_participante,ci')->findAll(),
            'detCapacitaciones' =>  $detCapacitaciones->find($id),
            'capacitaciones' => $capacitacionesData
        ];
        return $this->templater->view('capacitaciones/inscripciones/edit', $data);
    }
    public function create()
    {
        $newInscripcion = new DetalleCapacitacionesModel();
        if ($this->validate('inscricionesCapacitaciones')) {
            $newInscripcion->insert([
                'id_mae_capacitacion' => $this->request->getPost('id_mae_capacitacion'),
                'id_participante' => $this->request->getPost('id_participante')
            ]);
            return redirect()->to('/capacitaciones/inscripciones')->with('message', 'Participante inscrito correctamente.');
        }
        return redirect()->back()->withInput();
    }

    public function update($id = null)
    {
        $inscripcion = new DetalleCapacitacionesModel();
        if (!$inscripcion->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('inscricionesCapacitaciones')) {
            $inscripcion->update($id, [
                'id_mae_capacitacion' => $this->request->getPost('id_mae_capacitacion'),
                'id_participante' => $this->request->getPost('id_participante')
            ]);
            return redirect()->to('/capacitaciones/inscripciones')->with('message', 'Inscripcion editada correctamente.');
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $inscripcion = new DetalleCapacitacionesModel();
        if ($inscripcion->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $inscripcion->delete($id);
        return redirect()->to('/capacitaciones/inscripciones')->with('message', 'Inscripcion eliminada correctamente.');
    }
}

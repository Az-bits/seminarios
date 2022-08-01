<?php

namespace App\Controllers\Seminarios;

use App\Models\ParticipantesModel;
use \CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\Templater;
use CodeIgniter\RESTful\ResourcePresenter;

class ParticipantesController extends ResourcePresenter
{
    protected $templater;
    public function __construct()
    {
        $this->templater = new Templater(\Config\Services::request());
    }
    public function index()
    {
        $participantes  = new ParticipantesModel();
        $data = [
            'title' => 'Participantes',
            'participantes' => $participantes->select('participantes.*,ifnull(count(d.id_det_capacitacion),0) as cantidad')
                ->join('det_capacitaciones d', 'participantes.id_participante = d.id_participante', 'left')
                ->groupBy('participantes.id_participante, d.id_det_capacitacion')
                ->paginate(5),
            'pager' => $participantes->pager
        ];
        return $this->templater->view('participantes/participantesList', $data);
    }
    public function new()
    {
        session(); //para que aparescan la lista de errores de validacion esto es un bug
        $participante  = [
            'id_participante' => null,
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
            'title' => 'Nuevo participante',
            'participante' => $participante,
            'validation' => $validation
        ];
        return $this->templater->view('participantes/new', $data);
    }
    public function edit($id = null)
    {
        $validation =  \Config\Services::validation();
        session();
        $participante = new ParticipantesModel();
        if ($participante->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $dataParticipante = $participante->find($id);
        $posChar = strpos($dataParticipante['ci'], '-');
        $dataParticipante['comple'] = $posChar ? substr($dataParticipante['ci'], $posChar + 1) : '';
        $dataParticipante['ci'] = $posChar ? substr($dataParticipante['ci'], 0, strpos($dataParticipante['ci'], '-')) : $dataParticipante['ci'];
        $data = [
            'title' => 'Editar participante',
            'validation' => $validation,
            'participante' =>  $dataParticipante
        ];
        return $this->templater->view('participantes/edit', $data);
    }
    public function create()
    {
        // $_REQUEST['genero'] = '';
        // var_dump($_REQUEST);
        $newParticipante = new ParticipantesModel();
        $ci = $this->request->getPost('ci');
        $posChar = trim(strpos($ci, '-'));
        if ($this->validate('participantes')) {
            $newParticipante->insert([
                'ci' => $posChar ? $ci . '-' . trim($this->request->getPost('comple')) : $ci,
                'nombres' => trim($this->request->getPost('nombres')),
                'paterno' => trim($this->request->getPost('paterno')),
                'materno' => trim($this->request->getPost('materno')),
                'genero' => $this->request->getPost('genero'),
                'celular' => trim($this->request->getPost('celular')),
                'correo' => trim($this->request->getPost('correo'))
            ]);
            return redirect()->to('/participantes')->with('message', 'Participante creado correctamente.');
        }
        return redirect()->back()->withInput();
    }

    public function update($id = null)
    {
        $_REQUEST['id'] = $id;
        // var_dump($id);
        // var_dump($_REQUEST);
        $Participante = new ParticipantesModel();
        if (!$Participante->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('facilitadores')) {
            $comple = trim($this->request->getPost('comple'));
            $ci = trim($this->request->getPost('ci'));
            $Participante->update($id, [
                'ci' => $comple ? trim($this->request->getPost('ci')) . '-' . trim($this->request->getPost('comple')) : $ci,
                'nombres' => trim($this->request->getPost('nombres')),
                'paterno' => trim($this->request->getPost('paterno')),
                'materno' => trim($this->request->getPost('materno')),
                'genero' => $this->request->getPost('genero'),
                'celular' => trim($this->request->getPost('celular')),
                'correo' => trim($this->request->getPost('correo'))
            ]);
            return redirect()->to('/participantes')->with('message', 'Participante editado correctamente.');
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $participante = new ParticipantesModel();
        if ($participante->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $participanteName = $participante->find($id);
        $participanteName = $participanteName['nombres'] . ' ' . $participanteName['paterno'] . ' ' . $participanteName['materno'];
        $participante->delete($id);
        return redirect()->to('/participantes')->with('message', 'Participante ' . $participanteName . ' eliminado correctamente.');
    }
}

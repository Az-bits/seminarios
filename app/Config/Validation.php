<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        // 'list'   => 'CodeIgniter\Validation\Views\list',
        'list'   => 'App\Views\Validations\list_bootstrap',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];
    public $facilitadores = [
        'ci' => ['label' => 'cedula identidad', 'rules' => 'required|is_natural_no_zero|min_length[7]|max_length[9]|is_unique[facilitadores.ci,id_facilitador,{id}]'],
        'nombres' => 'required|min_length[3]',
        'paterno' => 'required|min_length[3]',
        'celular' => 'required|min_length[8]|max_length[8]|is_natural_no_zero',
        'genero' => 'required',
        'correo' => 'required|min_length[3]|max_length[20]|is_unique[facilitadores.correo,id_facilitador,{id}]|valid_email',
        'comple' => ['label' => 'complemento', 'rules' => 'max_length[3]'],
    ];
    public $cursos = [
        'nombre_curso' => ['label' => 'nombre del curso', 'rules' => 'required|min_length[3]|max_length[90]|alpha_space|is_unique[cursos.nombre_curso,id_curso,{id}]'],
        'modalidad' => 'required',
        'precio' => 'required|is_natural_no_zero',
        'id_facilitador' => ['label' => 'facilitador', 'rules' => 'required'],
    ];
    public $participantes = [
        'ci' => ['label' => 'cedula identidad', 'rules' => 'required|is_natural_no_zero|min_length[7]|max_length[9]|is_unique[participantes.ci,id_participante,{id}]'],
        'nombres' => 'required|min_length[3]',
        'paterno' => 'required|min_length[3]',
        'celular' => 'required|min_length[8]|max_length[8]|is_natural_no_zero',
        'genero' => 'required',
        'correo' => 'required|min_length[3]|max_length[20]|is_unique[participantes.correo,id_participante,{id}]|valid_email',
        'comple' => ['label' => 'complemento', 'rules' => 'max_length[3]'],
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
}

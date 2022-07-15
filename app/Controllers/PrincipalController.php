<?php

namespace App\Controllers;

class PrincipalController extends BaseController
{
    public function index()
    {
        return $this->templater->view('principal', []);
    }
}

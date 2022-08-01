<?php

namespace App\Controllers;

class PrincipalController extends BaseController
{
    public function index()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            echo $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            echo $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            echo $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $this->templater->view('principal', ['title' => '']);
    }
}

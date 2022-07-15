<?php

namespace App\Libraries;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;

class Templater extends BaseController
{
    public $request = null;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    function view($content, $data = [], $base = "base")
    {
        // if ($this->request->isAJAX()) {
        //     $ajax = view($content, $data);
        //     return css_tag($content) . $ajax . script_tag($content);
        // } else {
        //     $data['menu'] = view('menu', $data);
        //     $data['header'] = view('header', $data);
        //     $data['content'] = view($content, $data);
        //     $data['footer'] = view('footer', $data);
        //     return view($base, $data);
        // }
        $data['header'] = view('dashboard/templater/header', $data);
        $data['content'] = view('dashboard/' . $content, $data);
        $data['footer'] = view('dashboard/templater/footer', $data);
        return view($base, $data);
    }
}

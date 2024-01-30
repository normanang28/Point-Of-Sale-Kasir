<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;

class Dashboard extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/menu');
        echo view('view/dashboard/dashboard');
        echo view('layout/footer');
    }
}

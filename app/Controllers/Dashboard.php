<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/menu');
        echo view('dashboard/dashboard');
        echo view('layout/footer');
    }
}

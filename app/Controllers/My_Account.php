<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class My_Account extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/menu');
        echo view('My_Account/account');
        echo view('layout/footer');
    }
}

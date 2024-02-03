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
        $model=new M_model();
        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $data['foto']=$model->getRow('user',$where);
        $data['barang']=$model->tampil('barang');
        $data['pendataan_barang']=$model->tampil('barang_masuk');
        $data['kasir']=$model->tampil('barang_keluar');

        echo view('layout/header', $data);
        echo view('layout/menu');
        echo view('dashboard/dashboard');
        echo view('layout/footer');
    }
}

<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('level') > 0) {
            return redirect()->to('/Dashboard'); 
        } else {
            $model = new M_model();
            return view('login/login');
        }
    }

    public function aksi_login()
    {
        $n=$this->request->getPost('username'); 
        $p=$this->request->getPost('password');

        $model= new M_model();
        $data=array(
            'username'=>$n, 
            'password'=>md5($p)
        );
        $cek=$model->getarray('user', $data);
        if ($cek>0) {
            $where=array('id_user_petugas'=>$cek['id_user']);
            $petugas=$model->getarray('petugas', $where);

                if ($petugas) { 
                if ($petugas['status'] == '1') {
                session()->set('id', $cek['id_user']);
                session()->set('username', $cek['username']);
                session()->set('nama_petugas', $petugas['nama_petugas']);
                session()->set('level', $cek['level']);

                return redirect()->to('/Dashboard');
                }
            } else {         
            }
        }
        return redirect()->to('/');
    }
}

<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Data_Master extends BaseController
{
    public function petugas()
    {
        $model=new M_model();
        $on='petugas.maker_petugas=user.id_user';
        $data['data']=$model->fusionOderBy('petugas', 'user', $on, 'tanggal_petugas');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('data_master/petugas');
        echo view('layout/footer'); 
    }

    public function tambah_petugas()
    {
        $nama_petugas=$this->request->getPost('nama_petugas');
        $no_telp=$this->request->getPost('no_telp');
        $username=$this->request->getPost('username');
        $level=$this->request->getPost('level');
        $maker_petugas=session()->get('id');

        $user=array(
            'username'=>$username,
            'password'=>md5('@dmin123'),
            'level'=>$level,
        );

        $model=new M_model();
        $model->simpan('user', $user);
        $where=array('username'=>$username);
        $id=$model->getarray('user', $where);
        $iduser = $id['id_user'];

        $petugas = array(
            'nama_petugas' => $nama_petugas,
            'no_telp' => $no_telp,
            'status' => '1',
            'id_user_petugas' => $iduser,
            'maker_petugas' => $maker_petugas,
        );

        $model->simpan('petugas', $petugas);
        return redirect()->to('/Data_master/petugas');
    }   

    public function aktif($id)
    {
        $model=new M_model();
        $where=array('id_user_petugas'=>$id);
        $data=array(
            'status'=>"1"
        );

        $model->edit('petugas', $data, $where);
        return redirect()->to('/Data_Master/petugas');
    }

    public function tidak_aktif($id)
    {
        $model=new M_model();
        $where=array('id_user_petugas'=>$id);
        $data=array(
            'status'=>"0"
        );

        $model->edit('petugas', $data, $where);
        return redirect()->to('/Data_Master/petugas');
    }

    public function edit_petugas($id)
    {
        $model=new M_model();
        $where2=array('petugas.id_user_petugas'=>$id);

        $on='petugas.id_user_petugas=user.id_user';
        $data['data']=$model->edit_user('petugas', 'user', $on, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('data_master/edit_petugas');
        echo view('layout/footer');
    }

    public function aksi_edit_petugas()
    {
        $id= $this->request->getPost('id');    
        $username= $this->request->getPost('username');
        $level= $this->request->getPost('level');
        $nama_petugas= $this->request->getPost('nama_petugas');
        $no_telp= $this->request->getPost('no_telp');
        $maker_petugas=session()->get('id');

        $where=array('id_user'=>$id);    
        $where2=array('id_user_petugas'=>$id);
        if ($password !='') {
            $user=array(
                'username'=>$username,
                'level'=>$level,
            );
        }else{
            $user=array(
                'username'=>$username,
                'level'=>$level,
            );
        }

        $model=new M_model();
        $model->edit('user', $user,$where);

        $petugas=array(
            'nama_petugas'=>$nama_petugas,
            'no_telp'=>$no_telp,
            'maker_petugas' => $maker_petugas
        );

        $model->edit('petugas', $petugas, $where2);
        return redirect()->to('/Data_Master/petugas');
    }

    public function hapus_petugas($id)
    {
        $model=new M_model();
        $where2=array('id_user'=>$id);
        $where=array('id_user_petugas'=>$id);

        $model->hapus('petugas',$where);
        $model->hapus('user',$where2);

        return redirect()->to('/Data_Master/petugas');
    }
}
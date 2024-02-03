<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class POS extends BaseController
{
    public function barang()
    {
        $model=new M_model();
        $on='barang.maker_barang=user.id_user';
        $data['data']=$model->fusionOderBy('barang', 'user', $on, 'tanggal_barang');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('POS/barang/barang');
        echo view('layout/footer'); 
    }

    public function tambah_barang()
    {
        $model=new M_model();
        $kode_barang=$this->request->getPost('kode_barang');
        $nama_barang=$this->request->getPost('nama_barang');
        $harga_barang=$this->request->getPost('harga_barang');
        $maker_barang=session()->get('id');
        $data=array(

            'kode_barang'=>$kode_barang,
            'nama_barang'=>$nama_barang,
            'jumlah'=>'0',
            'harga_barang'=>$harga_barang,
            'maker_barang'=>$maker_barang
        );
        
        $model->simpan('barang',$data);
        return redirect()->to('/POS/barang');
    }

    public function edit_barang($id)
    {
        $model=new M_model();
        $where2=array('barang.id_barang'=>$id);

        $on='barang.maker_barang=user.id_user';
        $data['data']=$model->edit_user('barang', 'user', $on, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('POS/barang/edit_barang');
        echo view('layout/footer');
    }

    public function aksi_edit_barang()
    {
        $model=new M_model();
        $id=$this->request->getPost('id');
        $kode_barang=$this->request->getPost('kode_barang');
        $nama_barang=$this->request->getPost('nama_barang');
        $harga_barang=$this->request->getPost('harga_barang');
        $maker_barang=session()->get('id');

        $data=array(
            'kode_barang'=>$kode_barang,
            'nama_barang'=>$nama_barang,
            'harga_barang'=>$harga_barang,
            'maker_barang'=>$maker_barang
        );

        $where=array('id_barang'=>$id);
        $model->edit('barang',$data,$where);
        return redirect()->to('/POS/barang');
    }

    public function hapus_barang($id)
    {
        $model=new M_model();
        $where=array('id_barang'=>$id);
        $model->hapus('barang',$where);
        return redirect()->to('/POS/barang');
    }


    public function pendataan_barang()
    {
        $model=new M_model();
        $on='barang_masuk.id_barang_barang=barang.id_barang';
        $on2='barang_masuk.maker_bm=user.id_user';
        $data['data']=$model->superOderBy('barang_masuk', 'barang', 'user', $on, $on2, 'tanggal_bm');

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        $data['p']=$model->tampil('barang'); 

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('POS/pendataan_barang/pendataan_barang');
        echo view('layout/footer'); 
    }

    public function tambah_barang_masuk()
    {
        $model=new M_model();
        $id_barang=$this->request->getPost('id_barang');
        $stok=$this->request->getPost('stok');
        $nama_supplier=$this->request->getPost('nama_supplier');
        $maker_bm=session()->get('id');
        $data=array(

            'id_barang_barang'=>$id_barang,
            'stok'=>$stok,
            'nama_supplier'=>$nama_supplier,
            'maker_bm'=>$maker_bm
        );
        
        $model->simpan('barang_masuk',$data);
        return redirect()->to('/POS/pendataan_barang');
    }

    public function hapus_barang_masuk($id)
    {
        $model=new M_model();
        $where=array('id_barang_masuk'=>$id);
        $model->hapus('barang_masuk',$where);
        return redirect()->to('/POS/pendataan_barang');
    }

    public function kasir()
    {
        $model=new M_model();
        $where2=array('username'=>session()->get('username'));

        $on='barang_keluar.id_barang_barang=barang.id_barang';
        $on2='barang_keluar.maker_bk=user.id_user';
        $data['data']=$model->superOderByWhere('barang_keluar', 'barang', 'user', $on, $on2, 'tanggal_bk', $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        $data['p']=$model->tampil('barang'); 

        echo view('layout/header', $data);
        echo view('layout/menu');
        echo view('POS/kasir/kasir');
        echo view('layout/footer'); 
    }

    public function tambah_kasir()
    {
        $model = new M_model();
        $id_barang = $this->request->getPost('id_barang');
        $stok = $this->request->getPost('stok');
        $cash = $this->request->getPost('cash');
        $kembalian = $this->request->getPost('kembalian');
        
        $total = $cash - $kembalian;

        $maker_bk = session()->get('id');
        $data = array(
            'id_barang_barang' => $id_barang,
            'stok' => $stok,
            'cash' => $cash,
            'kembalian' => $kembalian,
            'total' => $total,
            'maker_bk' => $maker_bk
        );

        $data1 = array(
            'id_barang_barang' => $id_barang,
            'stok' => $stok,
            'cash' => $cash,
            'kembalian' => $kembalian,
            'total' => $total,
            'maker_bk' => $maker_bk
        );

        $model->simpan('barang_keluar', $data);
        $model->simpan('bk', $data1);
        return redirect()->to('/POS/kasir');
    }

    public function hapus_kasir($id)
    {
        $model=new M_model();
        $model_1=new M_model();

        $where=array('id_barang_keluar'=>$id);
        $model->hapus('barang_keluar',$where);

        $where=array('id_barang_keluar'=>$id);
        $model_1->hapus('bk',$where);
        return redirect()->to('/POS/kasir');
    }

    public function print_invoice()
    {
        $model=new M_model();
        $username = session()->get('username');
        $data['data'] = $model->print_invoice('barang_keluar', $username);

        echo view('POS/kasir/print_invoice',$data);
    }
}

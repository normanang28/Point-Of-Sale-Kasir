<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Laporan extends BaseController
{
    public function pendataan_barang()
    {
        $model=new M_model();
        $data['kunci']='view_pendataan_barang';

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu',$data);
        echo view('laporan/filter',$data);
        echo view('layout/footer');
    }

    public function print_pendataan_barang()
    {
        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $data['data']=$model->filter_pendataan_barang('barang_masuk',$awal,$akhir);
        echo view('laporan/pendataan_barang',$data);
    }

    public function pdf_pendataan_barang()
    {
        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $data['data']=$model->filter_pendataan_barang('barang_masuk',$awal,$akhir);

        $dompdf = new\Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan/pendataan_barang',$data));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('my.pdf', array('Attachment'=>false));
        exit();    
    }

    public function excel_pendataan_barang()
    {
        $model = new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $data = $model->filter_pendataan_barang('barang_masuk', $awal, $akhir);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kode Barang')
            ->setCellValue('C1', 'Nama Barang')
            ->setCellValue('D1', 'Stok Masuk')
            ->setCellValue('E1', 'Nama Supplier');

        $styleArrayHeader = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'C0C0C0'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArrayHeader);

        $column = 2;

        foreach ($data as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, ucwords(strtolower($item->tgl_bm)))
                ->setCellValue('B' . $column, strtoupper($item->kode_barang))
                ->setCellValue('C' . $column, ucwords(strtolower($item->nama_barang)))
                ->setCellValue('D' . $column, ucwords(strtolower($item->stok)));

            $color = new Color();
            $color->setARGB('0000FF');
            $spreadsheet->getActiveSheet()->getStyle('D' . $column)->getFont()->setColor($color);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $column, ucwords(strtolower($item->nama_supplier)));

            $styleArrayData = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            $spreadsheet->getActiveSheet()->getStyle('A' . $column . ':E' . $column)->applyFromArray($styleArrayData);

            $column++;
        }

        foreach (range('A', 'E') as $col) {
            $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Pendataan Barang ~ POS';

        header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function pengeluaran_barang()
    {
        $model=new M_model();
        $data['kunci']='view_pengeluaran_barang';

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu',$data);
        echo view('laporan/filter',$data);
        echo view('layout/footer');
    }

    public function print_pengeluaran_barang()
    {
        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $data['data']=$model->filter_pengeluaran_barang('barang_keluar',$awal,$akhir);
        echo view('laporan/pengeluaran_barang',$data);
    }

    public function pdf_pengeluaran_barang()
    {
        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $data['data']=$model->filter_pengeluaran_barang('barang_keluar',$awal,$akhir);

        $dompdf = new\Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan/pengeluaran_barang',$data));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('my.pdf', array('Attachment'=>false));
        exit();    
    }

    public function excel_pengeluaran_barang()
    {
        $model = new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $data = $model->filter_pengeluaran_barang('barang_keluar', $awal, $akhir);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kode Barang')
            ->setCellValue('C1', 'Nama Barang')
            ->setCellValue('D1', 'Stok Penjualan')
            ->setCellValue('E1', 'Total Penjualan')
            ->setCellValue('F1', 'Dibayar')
            ->setCellValue('G1', 'Kembalian');

        $styleArrayHeader = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'C0C0C0'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArrayHeader);

        $column = 2;

        foreach ($data as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, ucwords(strtolower($item->tgl_bk)))
                ->setCellValue('B' . $column, strtoupper($item->kode_barang))
                ->setCellValue('C' . $column, ucwords(strtolower($item->nama_barang)))
                ->setCellValue('D' . $column, ucwords(strtolower($item->stok)));
                
            $color = new Color();
            $color->setARGB('0000FF');
            $spreadsheet->getActiveSheet()->getStyle('D' . $column)->getFont()->setColor($color);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('E' . $column, 'Rp ' . number_format($item->total, 2, ',', '.'))
                ->setCellValue('F' . $column, 'Rp ' . number_format($item->cash, 2, ',', '.'))
                ->setCellValue('G' . $column, 'Rp ' . number_format($item->kembalian, 2, ',', '.'));

            $styleArrayData = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            $spreadsheet->getActiveSheet()->getStyle('A' . $column . ':G' . $column)->applyFromArray($styleArrayData);

            $column++;
        }

        foreach (range('A', 'G') as $col) {
            $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Pengeluaran Barang ~ POS';

        header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}

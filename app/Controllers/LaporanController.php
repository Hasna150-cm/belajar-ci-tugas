<?php
namespace App\Controllers;

use App\Models\TransactionModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;

class LaporanController extends BaseController
{
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
    }

    public function pendapatan()
    {
        // Hanya admin yang bisa akses
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('failed', 'Akses ditolak!');
        }

        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        $builder = $this->transaction->where('status !=', 0);
        if ($start && $end) {
            $builder = $builder->where('DATE(created_at) >=', $start)
                               ->where('DATE(created_at) <=', $end);
        }
        $data['laporan'] = $builder->orderBy('created_at', 'ASC')->findAll();
        $data['start'] = $start;
        $data['end'] = $end;
        return view('v_laporan_pendapatan', $data);
    }

    // Export Excel
    public function exportExcel()
    {
        helper('export');
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        $builder = $this->transaction->where('status !=', 0);
        if ($start && $end) {
            $builder = $builder->where('DATE(created_at) >=', $start)
                               ->where('DATE(created_at) <=', $end);
        }
        $data = $builder->orderBy('created_at', 'ASC')->findAll();
        export_to_excel($data, 'laporan_pendapatan.xlsx');
    }

    public function exportPDF()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        $builder = $this->transaction->where('status !=', 0);
        if ($start && $end) {
            $builder = $builder->where('DATE(created_at) >=', $start)
                               ->where('DATE(created_at) <=', $end);
        }
        $data['laporan'] = $builder->orderBy('created_at', 'ASC')->findAll();
        $data['start'] = $start;
        $data['end'] = $end;
        $html = view('v_laporan_pendapatan_pdf', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_pendapatan.pdf', ['Attachment' => true]);
        exit;
    }
}

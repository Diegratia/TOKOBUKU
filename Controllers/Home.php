<?php

namespace App\Controllers;

use App\Models\BerandaModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->beranda = new BerandaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda'
        ];
        return view('beranda', $data);
    }

    public function indexContainer()
    {
        $data = [
            'title' => 'Tugas Container'
        ];
        return view('tugas1/container', $data);
    }

    public function showChartTransaksi()
    {
        $tahun = $this->request->getVar('tahun');
        $reportTrans = $this->beranda->reportTransaksi($tahun);
        $response = [
            'status' => false,
            'data' => $reportTrans
        ];
        echo json_encode($response);
    }
    public function showChartTransaksiPembelian()
    {
        $tahun = $this->request->getVar('tahun');
        $reportTrans = $this->beranda->reportTransaksiPembelian($tahun);
        $response = [
            'status' => false,
            'data' => $reportTrans
        ];
        echo json_encode($response);
    }

    public function showChartCustomer()
    {
        $tahun = $this->request->getVar('tahun');
        $reportCust = $this->beranda->reportCustomer($tahun);
        $response = [
            'status' => false,
            'data' => $reportCust
        ];
        echo json_encode($response);
    }

    public function showChartSupplier()
    {
        $tahun = $this->request->getVar('tahun');
        $reportCust = $this->beranda->reportSupplier($tahun);
        $response = [
            'status' => false,
            'data' => $reportCust
        ];
        echo json_encode($response);
    }
}

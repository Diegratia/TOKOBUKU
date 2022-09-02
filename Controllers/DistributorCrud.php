<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;

class DistributorCrud extends BaseController
{
    public function index()
    {
        $crud = new GroceryCrud();
        $crud->setTable('distributor');
        $crud->setLanguage('indonesian');

        $crud->displayAs(array(
            'name' => 'Nama',
            'gender' => 'L/P',
            'address' => 'Alamat',
            'phone' => 'Telp',
        ));


        $crud->setRule('name', 'Nama', 'required', [
            'required' => '{field} harus diisi!'
        ]);

        // $crud->where('deleted_at', null);
        // $crud->columns(['name', 'no_DistributorCrud', 'gender', 'address', 'email', 'phone']);
        // $crud->unsetColumns(['created_at', 'updated_at']);

        // $crud->unsetAdd(); // Menonaktifkan tombol Tambah Data
        // $crud->unsetEdit(); // Menonaktifkan tombol Ubah Data
        // $crud->unsetDelete(); // Menonaktifkan tombol Hapus Data
        // $crud->unsetExport(); // Menonaktifkan tombol Export Data
        // $crud->unsetPrint(); // Menonaktifkan tombol Print Data



        $crud->unsetAddFields(['created_at', 'updated_at']);
        $crud->unsetEditFields(['created_at', 'updated_at']);

        // $crud->setTheme('datatables');

        // $crud->setRelation('officeCode', 'offices', 'city')

        $output = $crud->render();

        $data = [
            'title' => 'Data distributorcrud',
            'result' => $output
        ];
        return view('distributorcrud/index', $data);
    }
}

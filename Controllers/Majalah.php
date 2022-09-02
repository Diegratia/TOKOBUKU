<?php

namespace App\Controllers;

use \App\Models\MajalahModel;
use \App\Models\MajalahCategoryModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Doctrine\Common\Annotations\Reader;

class Majalah extends BaseController
{

    private $majalahModel, $catModel;
    public function __construct()
    {
        $this->majalahModel = new MajalahModel();
        $this->catModel = new MajalahCategoryModel();
    }

    public function index()
    {

        $dataMajalah = $this->majalahModel->getMajalah();
        $data = [
            'title' => 'Data Majalah',
            'result' => $dataMajalah
        ];
        return view('majalah/index', $data);
    }

    public function detail($slug)
    {
        $dataMajalah = $this->majalahModel->getMajalah($slug);
        $data = [
            'title' => 'Detail Majalah',
            'result' => $dataMajalah
        ];
        return view('majalah/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Tambah Majalah',
            'category' => $this->catModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('majalah/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[majalah.judul]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_unique[majalah.penerbit]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'tahun' => [
                'rules' => 'required|integer[majalah.tahun]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'integer' => '{field} hanya sudah ada'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric[majalah.harga]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} hanya sudah ada'
                ]
            ],
            'diskon' => 'permit_empty|decimal',
            'stok' => [
                'rules' => 'required|integer[majalah.stok]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'integer' => '{field} hanya sudah ada'
                ]
            ],
            'sampul' =>
            [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in' => 'Yang anda pilih bukan gambar!',
                ]
            ],
        ])) {
            return redirect()->to('/majalah/create')->withInput();
        }


        // mengambil file sampul
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaFile = $this->defaultImage;
        } else {
            // Generate Nama File
            $namaFile = $fileSampul->getRandomName();
            // Pindahkan file ke folder img dipublic
            $fileSampul->move('img', $namaFile);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->majalahModel->save([
            'judul' => $this->request->getVar('judul'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun' => $this->request->getVar('tahun'),
            'harga' => $this->request->getVar('harga'),
            'diskon' => $this->request->getVar('diskon'),
            'stok' => $this->request->getVar('stok'),
            'majalah_category_id' => $this->request->getVar('id_kategori'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan!");

        return redirect()->to('/majalah');
    }

    public function edit($slug)
    {
        $dataMajalah = $this->majalahModel->getMajalah($slug);
        // jika data majalahnya kosong
        if (empty($dataMajalah)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul Majalah $slug tidak ditemukan !");
        }
        $data = [
            'title' => 'Ubah Majalah',
            'category' => $this->catModel->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataMajalah
        ];
        return view('majalah/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $dataOld = $this->majalahModel->getMajalah($this->request->getVar('slug'));
        if ($dataOld['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[majalah.judul]';
        }

        // validasi data
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'penerbit' => 'required',
            'tahun' => 'required|integer',
            'harga' => 'required|numeric',
            'diskon' => 'permit_empty|decimal',
            'stok' => 'required|integer',
            'sampul' =>
            [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in' => 'Yang anda pilih bukan gambar!',
                ]
            ],
        ])) {
            return redirect()->to('/majalah/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $namaFileLama = $this->request->getVar('sampullama');
        // mengambil file sampul
        $fileSampul = $this->request->getFile('sampul');
        // cek gambar, apakah masih gambar lama
        if ($fileSampul->getError() == 4) {
            $namaFile = $namaFileLama;
        } else {
            // Generate Nama File
            $namaFile = $fileSampul->getRandomName();
            // Pindahkan file ke folder img dipublic
            $fileSampul->move('img', $namaFile);

            // jika sampulnya default
            if ($namaFileLama != $this->defaultImage && $namaFileLama != "") {
                // hapus gambar
                unlink('img/' . $namaFileLama);
            }
        }
        //Membuat string menjadi huruf kecil semuda dan spasinya diganti
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->majalahModel->save([
            'majalah_id' => $id,
            'judul' => $this->request->getVar('judul'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun' => $this->request->getVar('tahun'),
            'harga' => $this->request->getVar('harga'),
            'diskon' => $this->request->getVar('diskon'),
            'stok' => $this->request->getVar('stok'),
            'majalah_category_id' => $this->request->getVar('id_kategori'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/majalah');
    }

    public function delete($id)
    {
        //Cari gambar by ID
        $dataMajalah = $this->majalahModel->find($id);
        $this->majalahModel->delete($id);

        // Jika sampulnya default
        if ($dataMajalah['cover'] != $this->defaultImage) {
            // hapus gambar
            unlink('img/' . $dataMajalah['cover']);
        }

        session()->setFlashdata("msg", "Data berhasil dihapus!");
        return redirect()->to('/majalah');
    }

    public function importData()
    {
        $file = $this->request->getFile("file");
        $ext = $file->getExtension();
        if ($ext == "xls")
            $reader = new Xls();
        else
            $reader = new Xlsx();

        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $key => $value) {
            if ($key == 0) continue;

            $namaFile = $this->defaultImage;
            $slug = url_title($value[1], '-', true);

            // Cek judul
            $dataOld = $this->majalahModel->getMajalah($slug);
            if ($dataOld['judul'] = $value[1]) {
                $this->majalahModel->save([
                    'judul' => $value[1],
                    'penerbit' => $value[2],
                    'tahun' => $value[3],
                    'harga' => $value[4],
                    'diskon' => $value[5] ?? 0,
                    'stok' => $value[6],
                    'majalah_category_id' => $value[7],
                    'slug' => $slug,
                    'cover' => $namaFile
                ]);
            }
        }
        session()->setFlashdata("msg", "Data berhasil diimport!");

        return redirect()->to('/majalah');
    }
}

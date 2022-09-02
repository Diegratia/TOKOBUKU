<?php

namespace App\Controllers;

use \App\Models\BookModel;
use \App\Models\CategoryModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Doctrine\Common\Annotations\Reader;


class Book extends BaseController
{
    private $bookModel, $catModel;
    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->catModel = new CategoryModel();
    }

    public function index()
    {
        // $bookModel = new BookModel();
        $dataBook = $this->bookModel->getBook();
        $data = [
            'title' => 'Data Buku',
            'result' => $dataBook
        ];
        return view('book/index', $data);
    }

    public function detail($slug)
    {
        $dataBook = $this->bookModel->getBook($slug);
        $data = [
            'title' => 'Detail Buku',
            'result' => $dataBook
        ];
        return view('book/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Tambah Buku',
            'category' => $this->catModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('book/create', $data);
    }

    public function save()
    {

        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[book.title]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'penulis' => 'required',
            'tahun' => [
                'rules' => 'required|integer[book.releaseyear]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'integer' => '{field} hanya sudah ada'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric[book.price]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} hanya sudah ada'
                ]
            ],
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
            return redirect()->to('/book/create')->withInput();
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
        $this->bookModel->save([
            'title' => $this->request->getVar('judul'),
            'author' => $this->request->getVar('penulis'),
            'release_year' => $this->request->getVar('tahun'),
            'price' => $this->request->getVar('harga'),
            'discount' => $this->request->getVar('diskon'),
            'stock' => $this->request->getVar('stok'),
            'book_category_id' => $this->request->getVar('id_kategori'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan!");

        return redirect()->to('/book');
    }

    public function edit($slug)
    {
        $dataBook = $this->bookModel->getBook($slug);
        // jika data bukunya kosong
        if (empty($dataBook)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul buku $slug tidak ditemukan !");
        }
        $data = [
            'title' => 'Ubah Buku',
            'category' => $this->catModel->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataBook
        ];
        return view('book/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $dataOld = $this->bookModel->getBook($this->request->getVar('slug'));
        if ($dataOld['title'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[book.title]';
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
            'penulis' => 'required',
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
            return redirect()->to('/book/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $namaFileLama = $this->request->getVar('sampullama');
        // mengambil file sampul
        $fileSampul = $this->request->getFile('sampul');
        // cek gambar, apakah masih gambar lama
        if ($fileSampul->getError() == 4) {
            $namaFile = $this->defaultImage;
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
        $this->bookModel->save([
            'book_id' => $id,
            'title' => $this->request->getVar('judul'),
            'author' => $this->request->getVar('penulis'),
            'release_year' => $this->request->getVar('tahun'),
            'price' => $this->request->getVar('harga'),
            'discount' => $this->request->getVar('diskon'),
            'stock' => $this->request->getVar('stok'),
            'book_category_id' => $this->request->getVar('id_kategori'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/book');
    }

    public function delete($id)
    {
        //Cari gambar by ID
        $dataBook = $this->bookModel->find($id);
        $this->bookModel->delete($id);

        // Jika sampulnya default
        if ($dataBook['cover'] != $this->defaultImage) {
            // hapus gambar
            unlink('img/' . $dataBook['cover']);
        }
        session()->setFlashdata("msg", "Data berhasil dihapus!");
        return redirect()->to('/book');
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
            $dataOld = $this->bookModel->getBook($slug);
            if ($dataOld['title'] = $value[1]) {
                $this->bookModel->save([
                    'title' => $value[1],
                    'author' => $value[2],
                    'release_year' => $value[3],
                    'price' => $value[4],
                    'discount' => $value[5] ?? 0,
                    'stock' => $value[6],
                    'book_category_id' => $value[7],
                    'slug' => $slug,
                    'cover' => $namaFile
                ]);
            }
        }
        session()->setFlashdata("msg", "Data berhasil diimport!");

        return redirect()->to('/book');
    }
}

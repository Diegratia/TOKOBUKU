<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Container </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
            </li>
        </ol>
        <div class="container-fluid">
            <div class="row">
                <div class="bg-warning col-sm-12" style="text-align: center">
                        <p class="fw-bold">Container 1 - Gambar</p>                
                </div>
                <div class="bg-primary col-sm-4">
                    <div style="text-align:center; ">
                        <img src="<?= base_url('assets/img/logo_uajy.png'); ?>" width="220" height="300" alt="uajy">
                    </div>
                    <b>
                        <p style="text-align: center"> FOTO UAJY</p>
                    </b>
                </div>
                <div class="bg-secondary col-sm-4">
                    <div style="text-align:center; ">
                        <img src="<?= base_url('assets/img/Foto_Dionesius Diegrtaia Febrian.jpg'); ?>" class="center" width="220" height="300" alt="uajy">
                    </div>
                    <b>
                        <p style="text-align: center">FOTO DIRI</p>
                    </b>
                </div>
                <div class="bg-success col-sm-4">
                    <div style="text-align:center; ">
                        <img src="<?= base_url('assets/img/bonaventura.jpg'); ?>" class="responsive" width="220" height="300" alt="bonaventura">
                    </div>
                    <p style="text-align:center; ">
                        <b>
                            GEDUNG BONAVENTURA
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="container-fluid">
            <div class="row">
                <div class="bg-success col-sm-12" style="text-align: center">
                
                        <p class="fw-bold">Container 2 - Pesan dan Kesan-</p>
                </div>
                <div class="bg-info col-sm-4">
                    <h3 class="text-center">Pengalaman Belajar SIWEB</h3>
                    <td>
                        <p class="text-left">Pengalaman saya belajar siweb, Saya belajar
                            tentang elemen - elemen
                            yang terdapat di HTML serta
                            penggunaan framework
                            Bootstrap, untuk kesusahan yang ada,
                            mungkin karena awal penyesuaian</p>
                    </td>
                </div>
                <div class="bg-warning col-sm-8">
                    <h3 class="text-center">Pesan dan Kesan Kepada Asdos</h3>
                    <p> Untuk Asdos sudah sangat bagus, kesusahan yang saya alami selalu
                        dibantu dan dijelaskan,
                        pesan dari saya tetap di pertahankan</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?= $this->endSection() ?>.
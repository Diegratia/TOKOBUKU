<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">LAPORAN PEMBELIAN</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Laporan Pembelian</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- isi Report -->
                <a target="_blank" class="btn btn-primary mb-3" type="button" href="/beli/exportpdf">Export PDF</a>
                <a class="btn btn-dark mb-3" type="button" href="/beli/exportexcel">Export Excel</a>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota</th>
                            <th>Tanggal Transaksi</th>
                            <th>User</th>
                            <th>Supplier</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($result as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['buy_id'] ?></td>
                                <td><?= date("d/m/Y H:i:s", strtotime($value['tgl_transaksi'])) ?></td>
                                <td><?= $value['firstname'] ?> <?= $value['lastname'] ?></td>
                                <td><?= $value['name_supp'] ?></td>
                                <td><?= number_to_currency($value['total'], 'IDR', 'id_ID', 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


</main>
<?= $this->endSection() ?>
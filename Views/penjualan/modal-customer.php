<!--Modul 12 halaman 29-->
<div class="modal fade" id="modalCust" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">DATA Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modul 12 halaman 30 Tabel Customer-->
                <table id="datatablesSimple2">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="30%">No Customer</th>
                            <th width="15%">Email</th>
                            <th width="15%">Telp</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataCust as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['no_customer'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['phone'] ?></td>
                                <td>
                                    <!-- Modul 12 halaman 35 sebelumnya itu <button class="btn btn-success">
                                        <i class="fa fa-plus"></i> Pilih
                                    </button> -->
                                    <button onclick="selectCustomer('<?= $value['customer_id'] ?>','<?= $value['name'] ?>')" class="btn btn-success"><i class="fa fa-plus"></i>PILIH</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Modul 12 halaman 30 -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Penambahan script di Modul 12 halaman 34-->
<script>
    function selectCustomer(id, name) {
        $("#id-cust").val(id);
        $("#nama-cust").val(name);
        $("#modalCust").modal('hide');
    }
</script>
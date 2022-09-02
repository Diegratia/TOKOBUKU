<div class="modal fade" id="modalCust" role="dialog" aria-hidden="true" aria-labelledby="exampleModalToogleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eaxmpleModalToggleLabel">DATA SUPPLIER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Supplier -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="30%">Alamat</th>
                            <th width="15">Email</th>
                            <th width="15%">Telp</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataCust as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->address ?></td>
                                <td><?= $value->email ?></td>
                                <td><?= $value->phone ?></td>
                                <td>
                                    <button onclick="selectSupplier('<?= $value->supplier_id ?>', '<?= $value->name ?>')" class="btn btn-success"><i class="fa fa-plus"></i> Pilih</button>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--  -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    function selectSupplier(id, name) {
        $('#id-cust').val(id);
        $('#nama-cust').val(name);
        $('#modalCust').modal('hide');
    }
</script>
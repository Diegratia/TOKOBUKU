<div class="modal fade" id="modalProduk" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">DATA PRODUK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Buku  Modul 12 halaman 12-->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Sampuk</th>
                            <th width="30%">Judul</th>
                            <th width="15%">Tahun Terbit</th>
                            <th width="15%">Harga</th>
                            <th width="10%">Stok</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataBuku as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img src="img/<?= $value['cover'] ?>" alt="" width="100">
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= $value['release_year'] ?></td>
                                <td><?= $value['price'] ?></td>
                                <td><?= $value['stock'] ?></td>
                                <td>
                                    <!-- Modul 12 halaman 20 sebelumnya itu <button class = "btn btn-success">< class ="fa fa-cart-plus"></i> Tambahkan</button> -->
                                    <button onclick="add_cart('<?= $value['book_id'] ?>','<?= $value['title'] ?>','<?= $value['price'] ?>','<?= $value['discount'] ?>' )" class="btn btn-success"><i class="fa fa-cart-plus"></i>Tambahkan</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Modul 12 halaman 12 -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modul 12 halaman 38-->
<div class="modal fade" id="modalUbah" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-x1">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Ubah Jumlah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-7">
                        <input type="hidden" id="rowid">
                        <input type="number" id="qty" class="form-control" placeholder="Masukan Jumlah Produk" min="1" value="1">
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" onclick="update_cart()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modul 12 halaman 38-->
<!-- Penambahan script di Modul 12 halaman 22-->
<script>
    function add_cart(id, name, price, discount) {
        $.ajax({
            url: "/jual",
            method: "POST",
            data: {
                id: id,
                name: name,
                qty: 1,
                price: price,
                discount: discount,
            },
            success: function(data) {
                load()
            }
        });
    }




    function update_cart() {
        var rowid = $('#rowid').val();
        var qty = $('#qty').val();

        $.ajax({
            url: "/jual/update",
            method: "POST",
            data: {
                rowid: rowid,
                qty: qty,
            },
            success: function(data) {
                load();
                $('#modalUbah').modal('hide');
            }
        });
    }
</script>

<script>
    function load() {

        $('#detail_cart').load('/jual/load');
        $('#spanTotal').load('/jual/gettotal');
    }

    $(document).ready(function() {
        load();
    });

    $(document).on('click', '.ubah_cart', function() {
        var row_id = $(this).attr("id");
        var qty = $(this).attr("qty");
        $('#rowid').val(row_id);
        $('#qty').val(qty);
        $('#modalUbah').modal('show');
    });

    $(document).on('click', '.hapus_cart', function() {
        var row_id = $(this).attr("id");
        $.ajax({
            url: "jual/" + row_id,
            method: "DELETE",
            success: function(data) {
                load();
            }
        });
    });

    function bayar() {
        var nominal = $('#nominal').val();
        var idcust = $('#id-cust').val();
        $.ajax({
            url: "/jual/bayar",
            method: "POST",
            data: {
                'nominal': nominal,
                'id-cust': idcust
            },
            success: function(response) {
                var result = JSON.parse(response);
                console.log(result)
                swal({
                    title: result.msg,
                    icon: result.status ? "success" : "error",
                });
                load();
                $('#nominal').val("");
                $('#kembalian').val(result.data.kembalian);
            }
        });
    }
</script>
<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>



<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA BUKU </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengolaan Data Buku </li>
        </ol>


    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <?= $title ?>

        </div>
        <div class="card-body">
            <!--- GROCERY CRUD ----->
            <div style="padding : 10px">
                <?php echo $result->output ?>
            </div>

            <!--- GROCERY CRUD ----->

        </div>
    </div>
    </div>
</main>
<?= $this->endSection() ?>
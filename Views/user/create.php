<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA USER</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data USER</li>
        </ol>

    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <?= $title ?>
        </div>
        <div class="card-body">
            <!-- form tambah Data -->
            <?= view('Myth\Auth\Views\_message_block') ?>
            <form action="<?= route_to('register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control <?php if (session('errors.firstname')) : ?>is-invalid<?php endif ?>" type="text" name="firstname" placeholder="Enter your first name" value="<?= old('firstname') ?>" />
                            <label for="inputFirstname">First name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input class="form-control <?php if (session('errors.lastname')) : ?>is-invalid<?php endif ?>" type="text" name="lastname" placeholder="Enter your last name" value="<?= old('lastname') ?>" />
                            <label for="inputLastname">Last name</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" type="email" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" />
                    <label for="inputEmail"><?= lang('Auth.email') ?></label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" />
                    <label for="inputEmail"><?= lang('Auth.username') ?></label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" />
                            <label for="inputPassword"><?= lang('Auth.password') ?></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" />
                            <label for="inputPasswordConfirm"><?= lang('Auth.repeatPassword') ?></label>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" href="login.html"><?= lang('Auth.register') ?></button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</main>
<?= $this->endSection() ?>.
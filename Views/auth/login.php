<?= $this->extend('auth/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><?= lang('Auth.loginTitle') ?></h3>
                    </div>
                    <div class="card-body">
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <form action="<?= route_to('login') ?>" method="post">
                            <?= csrf_field() ?>
                            <form>
                                <?php if ($config->validFields === ['email']) : ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" type="email" name="login" placeholder="<?= lang('Auth.email') ?>" />
                                        <label for="inputEmail"><?= lang('Auth.email') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" type="text" />
                                        <label for="inputEmail"><?= lang('Auth.emailOrUsername') ?></label>
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-floating mb-3">
                                    <input class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" type="password" name="password" placeholder="<?= lang('Auth.password') ?>" />
                                    <label for="inputPassword"><?= lang('Auth.password') ?></label>
                                    <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="remember" type="checkbox" <?php if (old('remember')) : ?> checked <?php endif ?> />
                                    <label class="form-check-label" for="inputRememberPassword"><?= lang('Auth.rememberMe') ?></label>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                    <a class="small" href=" <?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>

                                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
                                    <!-- dibawah ini mungkin hapus -->

                                </div>
                            </form>
                    </div>
                    <div class="card-footer text-center py-3">

                        <div class="small">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
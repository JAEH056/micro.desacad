<?php
use App\Controllers\Login;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin Pro</title>

        <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('css/desacad.css') ?>" rel="stylesheet" />

        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                                <!-- Social login form-->
                                <div class="card my-5">
                                    <div class="card-body p-5 text-center">
                                        <div class="h3 fw-light mb-0">Inicio de Sesión</div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body p-5">
                                        <!-- Login form-->
                                        
                                        <?= validation_list_errors() ?>

                                        <?= form_open(url_to('\\' . Login::class .'::login')) ?>
                                            <!-- Form Group (email address)-->
                                            <?= csrf_field() ?>

                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="user">Usuario</label>
                                                <input class="form-control form-control-solid" type="text" name="user" placeholder="" aria-label="Email Address" aria-describedby="emailExample" />
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="password">Contraseña</label>
                                                <input class="form-control form-control-solid" type="password" name="password" aria-label="Password" aria-describedby="passwordExample" />
                                            </div>
                                            <!-- Form Group (forgot password link)-->
                                            <!-- Form Group (login box)-->
                                            <div class="d-flex align-items-center justify-content-center mb-0">
                                                <div class="form-check">
                                                </div>
                                                <input class="btn btn-outline-blue" type="submit" name="submit" value="Login">
                                            </div>
                                        <?= form_close() ?>
                                    </div>
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer-admin mt-auto footer-dark">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Algunos derechos reservados &copy; ITSH 2025</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Política de privacidad</a>
                                &middot;
                                <a href="#!">Términos y Condiones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('js/scripts.js') ?>"></script>
    </body>
</html>
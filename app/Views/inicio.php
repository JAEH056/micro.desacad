<?php

use App\Controllers\Actualizacion\Curso;
$ID = session()->get('usuario')->Id
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Menú Principal</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base64_encode(file_get_contents('/var/www/proyecto/public/logos/TecNM_logo.png')) ?>" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-2">
                    <div class="row justify-content-center">
                        <?php if (session()->getFlashdata('mensaje')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('mensaje') ?>
                            </div>
                        <?php endif; ?>
                        <!-- Create Organization-->
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                            <div class="card text-center h-100">
                                <div class="card-body px-5 pt-5 d-flex flex-column">
                                    <div>
                                        <div class="h3 text-primary">Menu Administrador</div>
                                        <p class="text-muted mb-4">Admnistración del sitio</p>
                                    </div>
                                    <div class="icons-org-create align-items-center mx-auto mt-auto">
                                        <i class="icon-users" data-feather="user"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent px-5 py-4">
                                    <div class="small text-center"><a class="btn btn-block btn-primary" href="<?= url_to('\\' . Curso::class . '::showAll') ?>">Acceder</a></div>
                                </div>
                            </div>
                        </div>
                        <!-- Join Organization-->
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                            <div class="card text-center h-100">
                                <div class="card-body px-5 pt-5 d-flex flex-column align-items-between">
                                    <div>
                                        <div class="h3 text-secondary">Menu Docentes</div>
                                        <p class="text-muted mb-4">Encuesta y cursos de docentes</p>
                                    </div>
                                    <div class="icons-org-join align-items-center mx-auto">
                                        <i class="icon-user" data-feather="user"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent px-5 py-4">
                                    <div class="small text-center"><a class="btn btn-block btn-secondary" href="<?= base_url('da/rol/curso/visualizar/'. $ID ) ?>">Acceder</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                            <div class="card text-center h-100">
                                <div class="card-body px-5 pt-5 d-flex flex-column align-items-between">
                                    <div>
                                        <div class="h3 text-success">Menú Instructores</div>
                                        <p class="text-muted mb-4">Planeación de cursos por isntructores</p>
                                    </div>
                                    <div class="icons-org-join align-items-center mx-auto">
                                        <i class="icon-user text-success" data-feather="user"></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent px-5 py-4">
                                    <div class="small text-center"><a class="btn btn-block btn-success" href="<?= base_url('da/rol/curso/imparte/'. $ID ) ?>">Acceder</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Footer -->
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-dark">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            &middot;
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
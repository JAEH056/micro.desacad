<?php $project = get_project_prefix() ?>
<?php

use App\Controllers\Login;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,  initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= esc($title) ?></title>
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('css/desacad.css') ?>" rel="stylesheet" />

    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
    </link>

    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/LogoITSH.png') ?>" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
</head>
<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="">DESACAD-ITSH</a>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->

    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- Documentation Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-md-block me-3">
            <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= base_url('assets/img/illustrations/profiles/profile-1.png') ?>" /></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="<?= base_url('assets/img/illustrations/profiles/profile-1.png') ?>" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">
                            <?php
                            $usuario = session_get('usuario');
                            echo "$usuario->Nombre $usuario->Primer_Apellido $usuario->Segundo_Apellido";
                            ?>
                        </div>
                        <div class="dropdown-user-details-email"><?= esc($usuario->Email) ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= url_to('\\' . Login::class . '::logout') ?>">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Cerrar sesión
                </a>
            </div>
        </li>
        </li>
        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
            <!-- Dropdown - Search-->
            <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </form>
            </div>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <?= require('sidemenu_' . $project . '.php')  ?>
</div>

<body class="nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <!-- <main> -->
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container-fluid px-4">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="layers"></i></div>
                                        Departamento de Desarrollo Académico
                                    </h1>
                                    <div class="page-header-subtitle">Programa de Formación y Actualización Docente<div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </header>
                <!-- Main page content-->
                <div class="container-fluid px-4">
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= SITE_NOME ?> - Painel Administrativo</title>
    <meta content="Painel por gerenciar o sistema do <?= SITE_NOME ?>" name="description" />

    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?= BASE_URL; ?>assets/custom/img/favico.png">

    <!-- Morris Chart CSS -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/theme/painel/plugins/morris/morris.css">

    <!-- Summernote css -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/summernote/summernote-bs4.css" rel="stylesheet" />

    <!-- Colorpicker -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


    <!-- Template CSS -->
    <link href="<?= BASE_URL; ?>assets/theme/painel/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/painel/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/painel/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/painel/css/style.css" rel="stylesheet" type="text/css">

    <!-- Css Autoload -->
    <?php $this->view("autoload/css"); ?>

    <link href="<?= BASE_URL; ?>assets/custom/css/estilo-painel.css" rel="stylesheet" type="text/css">
</head>

<body>

<!-- Inicio da Pagina -->
<div id="wrapper">

    <!-- ========== INICIO >> Menu Topo ========== -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
           <a href="<?= BASE_URL ?>painel" class="logo">
                <span class="logo-light">
                    <img src="<?= BASE_URL ?>assets/custom/img/logo-branca.png" style="width: 190px;" alt="<?= SITE_NOME ?>" />
                </span>
                <span class="logo-sm">
                    <img src="<?= BASE_URL ?>assets/custom/img/favico.png" style="width: 100%;" alt="<?= SITE_NOME ?>" />
                </span>
            </a>
        </div>
        <!-- FIM LOGO -->

        <!-- NAVBAR -->
        <nav class="navbar-custom">
            <ul class="navbar-right list-inline float-right mb-0">

                <!-- TELA CHEIA -->
                <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                    <a class="nav-link waves-effect" href="<?= BASE_URL ?>">
                        Ver catálogo
                    </a>
                </li>
                <!-- FIM TELA CHEIA -->

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>

        </nav>
        <!-- FIM NAVBAR -->

    </div>
    <!-- ========== FIM >> Menu Topo ========== -->


    <!-- ========== INICIO >> Menu Lateral ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- MENU -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">

                    <li class="menu-title">Menu</li>

                    <!-- DASHBOARD -->
                    <li>
                        <a href="<?= BASE_URL ?>painel" class="waves-effect">
                            <i class="icon-accelerator"></i><span> Dashboard </span>
                        </a>
                    </li>
                    <!-- FIM >> DASHBOARD -->


                    <!-- USUÁRIOS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-shield"></i><span> Usuários <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/usuario/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/usuarios">Listar Todos</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> USUÁRIOS -->


                    <!-- MARCAS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-star"></i><span> Marcas <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/marca/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/marcas">Listar Todas</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> MARCAS -->


                    <!-- CATEGORIAS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-medal"></i><span> Categorias <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/categoria/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/categorias">Listar Todas</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> CATEGORIAS -->

                    <!-- TIPOS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-medal"></i><span> Linhas <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/tipo/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/tipos">Listar Todas</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> TIPOS -->

                    <!-- Índices -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-medal"></i><span> Índices <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/indice/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/indices">Listar Todos</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> Índices -->


                    <!-- ATRIBUTOS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-gem"></i><span> Atributos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/atributo/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/atributos">Listar Todos</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> ATRIBUTOS -->

                    <!-- PRODUTOS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-boxes"></i><span> Produtos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/produto/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/produtos">Listar Todos</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> PRODUTOS -->


                    <!-- PRODUTOS -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fas fa-dollar-sign"></i>
                            <span>
                                Reajustes
                                <span class="float-right menu-arrow">
                                    <i class="mdi mdi-chevron-right"></i>
                                </span>
                            </span>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/reajuste/valor-pago">Alterar Valor Pago</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/reajuste/lucro">Alterar Lucro (%)</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/reajuste/desconto">Alterar Desconto (%)</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> PRODUTOS -->



                    <!-- SAIR -->
                    <li>
                        <a href="<?= BASE_URL; ?>sair" class="waves-effect"><i class="fas fa-running"></i><span> Sair </span></a>
                    </li>
                    <!-- FIM >> SAIR -->
                </ul>

            </div>
            <!-- FIM MENU -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->
    </div>
    <!-- ========== FIM >> Menu Lateral ========== -->




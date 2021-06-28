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
                    <svg fill="#fff" width="85%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 417.83 42.44"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M417.83,12.37a3.73,3.73,0,1,1-3.74-3.7A3.69,3.69,0,0,1,417.83,12.37Zm-.45,0a3.29,3.29,0,1,0-3.29,3.25A3.22,3.22,0,0,0,417.38,12.37Zm-3-2.07c1.1,0,1.65.6,1.65,1.33a1.33,1.33,0,0,1-1.3,1.31l1.25,1.5v0h-.62L414.15,13h-.87v1.48h-.57V10.3Zm-1.12,2.16h1.08c.77,0,1.12-.34,1.12-.83s-.35-.83-1.12-.83h-1.08Z"/><path d="M292,31.5c5.7-1.18,9.65-5.27,9.65-11,0-6.85-4.8-11.85-13.55-11.85H272.27V42.44h6.26a2.06,2.06,0,0,0,2.06-2.06V32.65H281a2.78,2.78,0,0,1,2.18,1.05l6.09,7.78a2.49,2.49,0,0,0,2,1h9.22l-8.81-9.7A.77.77,0,0,1,292,31.5Zm-5.19-6.18h-3.5a2.86,2.86,0,0,1-2.87-2.87V16.28h6.37c4.66,0,6.56,1.76,6.56,4.48S291.48,25.32,286.82,25.32Z"/><path d="M147.79,42.44a3.32,3.32,0,0,1-3.12-2.18L133.18,8.74h0v0h7.59a2.28,2.28,0,0,1,2.14,1.49L149.46,28a1,1,0,0,0,1.89,0L158,10.21a2.27,2.27,0,0,1,2.13-1.49h7.59v0h0L156.25,40.25a3.3,3.3,0,0,1-3.12,2.19Z"/><path d="M208.22,25.2V42.44H200V8.67h6.17a3.58,3.58,0,0,1,2.93,1.54l11.32,16.3a1,1,0,0,0,1.88-.59V8.67h8.23V42.44h-6.22a3.57,3.57,0,0,1-2.93-1.53L210.1,24.61A1,1,0,0,0,208.22,25.2Z"/><path d="M250.16,8.67c10.18,0,17.6,7.47,17.6,16.89s-7.42,16.88-17.6,16.88H238.88a2.56,2.56,0,0,1-2.56-2.56V8.67Zm-5.52,8V31.94a2.56,2.56,0,0,0,2.56,2.56h2.67c5.38,0,9.42-3.66,9.42-8.94s-4-8.94-9.42-8.94Z"/><path d="M350.59,23.82V40.51a1.93,1.93,0,0,1-1.93,1.93h-6.35V8.67h6.48A3,3,0,0,1,351.26,10l7.09,9.87a1.44,1.44,0,0,0,2.35,0l7-9.86a3,3,0,0,1,2.49-1.29h6.46V42.44h-6.39a1.92,1.92,0,0,1-1.93-1.93V23.86a1,1,0,0,0-1.72-.59l-7.15,9.28-7.15-9.31A1,1,0,0,0,350.59,23.82Z"/><path d="M180.9,34.93a1.41,1.41,0,0,1-1.4-1.41V28.89h13.55V22H180.9a1.41,1.41,0,0,1-1.4-1.41V16.09h13.63a1.92,1.92,0,0,0,1.92-1.92V8.67h-22a1.92,1.92,0,0,0-1.93,1.93V39.47a3,3,0,0,0,3,3h21.09V34.93Z"/><path d="M392.18,34.93a1.41,1.41,0,0,1-1.41-1.41V28.89h13.55V22H392.18a1.41,1.41,0,0,1-1.41-1.41V16.09H404.4a1.92,1.92,0,0,0,1.92-1.92V8.67H384.37a1.92,1.92,0,0,0-1.92,1.93V39.47a3,3,0,0,0,3,3h21.09V34.93Z"/><path d="M327,10.3a2.48,2.48,0,0,0-2.32-1.63H316.4L304,42.35v.09h7.13a2.47,2.47,0,0,0,2.36-1.72l1.68-5.17h12.55l1.23,3.83.45,1.36a2.5,2.5,0,0,0,2.36,1.7h7.14v-.09Zm-9.5,17.87,3.81-11.89h.19l2.93,9.12.88,2.77Z"/><path d="M17.18,8.72a16.86,16.86,0,1,0,0,33.71,16.86,16.86,0,1,0,0-33.71Zm14.2,16.85a14.08,14.08,0,0,1-14.2,13.92A14.08,14.08,0,0,1,3,25.57a14.07,14.07,0,0,1,14.2-13.91A14.07,14.07,0,0,1,31.38,25.57Z"/><path d="M19.47,6.19,23.77,1l.78-1H22.17A2.79,2.79,0,0,0,20,1.1L16.07,6.25l-.68,1h1.94A2.77,2.77,0,0,0,19.47,6.19Z"/><path d="M35.64,11.6h10a1.25,1.25,0,0,1,1.25,1.26V42.43h3V12.86a1.25,1.25,0,0,1,1.26-1.26h10V8.72H35.64Z"/><path d="M66,10.75V42.43H67a2,2,0,0,0,2-2V8.72H68A2,2,0,0,0,66,10.75Z"/><path d="M98.53,38.48a16.66,16.66,0,0,1-5.75,1c-8.39,0-14.71-6-14.71-13.92s6.3-13.91,14.66-13.91a17,17,0,0,1,5.76,1l.78.31v-1.8a1.73,1.73,0,0,0-1.18-1.63,17.48,17.48,0,0,0-5.5-.82c-10,0-17.5,7.24-17.5,16.85s7.55,16.86,17.55,16.86A16.77,16.77,0,0,0,99,41.3l.36-.14v-3l-.76.26Z"/><path d="M119.17,8.72H116L102.37,41.64l-.34.8h1.81A2.33,2.33,0,0,0,106,41l3.26-8.09h16.62L129.14,41a2.33,2.33,0,0,0,2.16,1.45h1.87l-.33-.74Zm4.93,20.84a1,1,0,0,1-.83.44h-11.4a1,1,0,0,1-.84-.44,1,1,0,0,1-.1-.94l6.62-16.19,6.65,16.19A1,1,0,0,1,124.1,29.56Z"/></g></g></svg>
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
                        <a href="javascript:void(0);" class="waves-effect"><i class="far fa-images"></i><span> Banner <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/banner/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/banners">Listar Todos</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> USUÁRIOS -->


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

                    <!-- Tratamento -->
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-medal"></i><span> Tratamentos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/tratamento/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/tratamentos">Listar Todos</a></li>
                        </ul>
                    </li>
                    <!-- FIM >> Tratamento -->


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
                        <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-hammer"></i><span> Serviços <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="<?= BASE_URL; ?>painel/servico/adicionar">Adicionar</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/servicos">Listar Todos</a></li>
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
                            <li><a href="<?= BASE_URL; ?>painel/reajuste/valor-pago">Alterar Valor de Custo (%)</a></li>
                            <li><a href="<?= BASE_URL; ?>painel/reajuste/lucro">Alterar Margem (%)</a></li>
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




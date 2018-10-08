<?php
    if ($_SESSION['cod_personas'] != null && $_SESSION["rol"] == 1) {
    }else{
      header("location: ".URL."Login");
    }
?>
<!DOCTYPE html>
<html lang="en">
<div class="table-responsive">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Cursos - SENA</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/main.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= URL ?>Public/img/favicon-16x16.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?= URL?>css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Poppins" rel="stylesheet">
  </head>
  <style>
  .app-menu__item{
    border-radius:20px;
  }
  .treeview-item{
    border-radius:20px;
  }
  </style>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Cursos</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- Menú de reportes -->
        <li class="dropdown"><a class="app-nav__item" href="" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fas fa-file-contract"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?php echo URL ;?>Home/vistaReporte"><i class="fas fa-file-download"></i> Generar reporte</a></li>
          </ul>
        </li>
        <!-- Notification Menu--> 
<!--         
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fas fa-bell"></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">Usted tiene nuevas notificaciones.</li>
            
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                
                    <p class="app-notification__message app-notification__meta"></p>
               
                  </div></a></li>
              </div>
            </div>
            <li class="app-notification__footer"><a href="<?= URL?>Preguntas/fromAprendiz">Ver todas las notificaciones.</a></li>
          </ul>
        </li> -->
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?= URL?>Configuraciones/index"><i class="fa fa-cog fa-lg"></i> Configuraciones</a></li>
            <li><a class="dropdown-item" href="<?=URL?>Login/passwordChangeAdmin"><i class="fas fa-key"></i> Nueva Contraseña</a></li>
            <li><a class="dropdown-item" href="<?=URL?>Login/cerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo URL; ?>public/img/logo2.png" style= "width: 35px; heigth: 50px" alt="User Image">
        <div>        
          <p class="app-sidebar__user-designation"><?=$_SESSION['nombrePersona']?></p>
          <p class="app-sidebar__user-name"><?=$_SESSION['nameRol']?></p>        
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?php echo URL; ?>home/index"><i class="app-menu__icon fa fa-home" ></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon fas fa-user-circle"></i><span class="app-menu__label">Usuario</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo URL; ?>Interesados/indexRegistrar"><i class="icon fas fa-plus-circle"></i> Registrar usuario</a></li>
            <li><a class="treeview-item" href="<?php echo URL ;?>Personas/cargarlistar" rel="noopener"><i class="icon fas fa-search"></i> Consultar usuario</a></li>
            <li><a class="treeview-item" href="<?php echo URL ;?>Personas/listarSanciones" rel="noopener"><i class="icon fas fa-search"></i> Sanciones</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon fas fa-graduation-cap"></i><span class="app-menu__label">Cursos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo URL; ?>cursos/create"><i class="icon fas fa-plus-circle"></i> Registrar cursos</a></li>
            <li><a class="treeview-item" href="<?php echo URL ;?>cursos/index" rel="noopener"><i class="icon fas fa-search"></i> Consultar cursos</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon fas fa-cog"></i><span class="app-menu__label">Configuraciones</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= URL?>Configuraciones/index"><i class="app-menu__icon fas fa-cog"></i> Configuraciones</a></li>
            <li><a class="treeview-item" href="<?php echo URL ;?>categories/create" rel="noopener"><i class="icon fas fa-plus-circle"></i> Registrar categorías</a></li>
            <li><a class="treeview-item" href="<?php echo URL; ?>categories/index"><i class="icon fas fa-list-ul"></i> Consultar categorías</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="" data-toggle="treeview"><i class="app-menu__icon fas fa-question"></i><span class="app-menu__label">Preguntas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo URL; ?>Preguntas/index"><i class="icon fas fa-plus-circle"></i> Registrar preguntas</a></li>
            <li><a class="treeview-item" href="<?php echo URL ?>Preguntas/fromAprendiz" rel="noopener"><i class="icon fas fa-user-graduate"></i> Preguntas Aprendiz</a></li>
          </ul>
        </li>
      </ul>
      
        <div class="treeview-item" style="color:#009688; margin-top:163%">
          © <a style="color:#009688;" class="treeview-item" href="https://github.com/pratikborsadiya/vali-admin" target="_blank">Vali admin</a>
        </div>
      
    </aside>
    
    

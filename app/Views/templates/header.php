<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Projeto de novo site">
    <meta name="author" content="GIlbert Sampaio">
    <title>Novo Site</title>
    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.1/examples/carousel/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url('../public/css/estilo.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="icon" href="<?php echo base_url('../public/favicon.ico') ?>">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container-fluid">
                <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <svg style="width:24px;height:24px;" viewBox="0 0 24 24">
                        <path fill="#6F6F6F" ng-attr-d="{{icon.data}}" d="M3,15H21V13H3V15M3,19H21V17H3V19M3,11H21V9H3V11M3,5V7H21V5H3Z"></path>
                    </svg>
                </div>
                <a class="logo" href="#"><img src="../public/img/logo.png" /></a>
                <a onclick="buscar()" class="navbar-toggler">
                    <svg style="width:24px;height:24px;" viewBox="0 0 24 24">
                        <path fill="#6F6F6F" ng-attr-d="{{icon.data}}" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
                    </svg>
                </a>
                <div class="collapse navbar-collapse pl" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre <i style="font-size:22px" class="mdi mdi-home-account iconMenu"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Preço <i style="font-size:22px" class="mdi mdi-cash-multiple iconMenu"></i></a>
                        </li>
                        <li class="nav-item pr-200">
                            <a class="nav-link" href="#">Desenvolvedores <i style="font-size:22px" class="mdi mdi-xml iconMenu"></i></a>
                        </li>
                        <li class="nav-item liSearch">
                            <a style="cursor:pointer" class="nav-link" onclick="buscar()">
                                <svg style="position:relative; top: -2px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
                                    <circle cx="10.5" cy="10.5" r="7.5"></circle>
                                    <path d="M21 21l-5.2-5.2"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ajuda <i style="font-size:22px" class="mdi mdi-help-rhombus iconMenu"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contato <i style="font-size:22px" class="mdi mdi-account-box iconMenu"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link borderRadius" href="#">Começar <i style="font-size:22px" class="mdi mdi-coffee-to-go-outline iconMenu"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
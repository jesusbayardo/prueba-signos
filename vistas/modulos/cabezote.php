<header class="main-header" >

    <a href="inicio" class="logo" style="background-color: white;">
        <!-- logo mini -->

        <span class="logo-mini  hidden-xs">

             <img src="vistas/img/plantilla/logoCircular.png" class="img-responsive" style="padding: 10px;">

        </span>

        <!-- logo normal -->

        <span class="logo-lg hidden-xs"  >

             <img src="vistas/img/plantilla/logoCuadrado.png" class="img-responsive" style="padding: 10px 0px;">

        </span>
    </a>

    <!-- barra de navegacion -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #2B3335;">
        <!-- Botón de navegación -->

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

            <span class="sr-only">Toggle navigation</span>

        </a>
        <!-- perfil de usuario-->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="vistas/img/usuarios/default/anonymous.png" class="user-image">
                        <span class="hidden-xs">Bienvenido <?php echo $_SESSION["nombre"] ?></span>
                    </a>

                    <!--drop donw-->

                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <div class="pull-right">
                                <a href="salir" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>


    </nav>


    


</header>
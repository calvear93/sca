<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" sizes="256x256" href="images/icon-app.png">
    
    <link rel="stylesheet" href="styles/css/bootstrap3/bootstrap-3.3.6.min.css">
    <link rel="stylesheet" href="styles/css/bootstrap3/jasny-bootstrap-3.1.3.min.css">
    <link rel="stylesheet" href="styles/css/bootflat2/bootflat-2.0.4.min.css">
    <link rel="stylesheet" href="styles/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="styles/css/animate.min.css">

    <script src="styles/js/jquery/jquery-1.11.3.min.js"></script>
    <script src="styles/js/angular-1.4.8.min.js"></script>
    <script src="styles/js/bootstrap3/bootstrap-3.3.6.min.js"></script>
    <script src="styles/js/bootstrap3/jasny-bootstrap-3.1.3.min.js"></script>
    <script src="styles/js/bootflat2/icheck.min.js"></script>
    <script src="styles/js/bootstrap-select.min.js"></script>
    <script src="styles/js/bootstrap-table.min.js"></script>
    <script src="styles/js/locale/bootstrap-table-es-ES.min.js"></script>
    <script src="styles/js/bootflat2/jquery.fs.stepper.min.js"></script>
    <script src="styles/js/wow.min.js"></script>
    <script src="styles/js/validator.js"></script>
    <script src="styles/js/jquery.mask.min.js"></script>
    <script src="styles/js/bootstrap-notify.min.js"></script>
    <script src="styles/js/scripts/notifications.js"></script>
    <script src="styles/js/cookies.js"></script>

    <link rel="stylesheet" href="styles/css/views/general.css">

    <script>new WOW().init();</script>

    <?php
        require_once( '../cfg/constants.php' );
        if ( isset( $_COOKIE[ 'session_type' ] ) )
            switch ( $_COOKIE[ 'session_type' ] ) {
                case _ADM:
                header ("Location: ../views/main_admin.php");
                exit;

                case _STUDENT:
                header ("Location: ../views/main_student.php");
                exit;

                case _TEACHER:
                header ("Location: ../views/main_teacher.php");
                exit;
            }
    ?>
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main_admin.php">SCA</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active wow zoomIn"><a href="#">Iniciar Sesión</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="active wow zoomIn"><a href="#">Sistema de Comunicación Académica</a></li>
            </ul>

        </div>
    </nav>

    <div class="container">
        <div class="row">

            <form id="data_student" action="../services/sign_in.php" method="POST" role="sign_in" data-toggle="validator">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <h3 class="animated pulse">Iniciar Sesión.</h3>
                    <div class="form-group">
                        <label for="sign_in-user" class="control-label text-info">Usuario</label>
                        <span class="label label-info animated fadeInDown">Puede ingresar con su RUN o Usuario.</span>
                        <div class="input-group">
                            <label for="sign_in-user" class="input-group-addon glyphicon glyphicon-user"></label>
                            <input type="text" class="form-control" id="sign_in-user" name="sign_in-user" placeholder="Ingrese usuario"
                        pattern="([0-9]{2})[.]{0,1}([0-9]{3})[.]{0,1}([0-9]{3})-{0,1}([0-9Kk])|user" required>
                        </div>
                    
                        <div class="help-block with-errors" delay="1000"></div>
                        <label for="sign_in-key" class="control-label text-warning">Contraseña</label>
                        <div class="input-group">
                            <label for="pass" class="input-group-addon glyphicon glyphicon-lock"></label>
                            <input type="password" class="form-control" id="sign_in-key" name="sign_in-key" placeholder="Escriba su contraseña" required>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block animated bounceInUp">Iniciar Sesión</button>
                </div>
            </form>

        </div>
    </div>

    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left">© 2015 - Crawis Software.</p>
            <ul class="nav navbar-nav navbar-right">
                <li class="wow tada"><a href="about.html"><span class="glyphicon glyphicon-heart"></span> Acerca de nosotros.</a></li>
            </ul>
        </div>
    </div>

    <script>
        if ( get_cookie( 'session_state' ) != "invalid_sign_in" )
            info_notification( 'Bienvenido a SCA',
                '<br><strong>Ingeniería de Software.</strong><br>Ingeniería Civil en Informática. Universidad del Bío-Bío, Chillán.' + 
                '<br><strong>Integrantes:</strong> Cristopher Alvear, Analeda Casanova, Norma Contreras, Valentina Díaz, Nicole Quezada.' +
                '<br><strong>VERSION: alpha 0.52</strong>' );
        switch( get_cookie( 'session_state' ) ) {
            case "invalid_sign_in" :
                danger_notification( 'Inicio de Sesión Fallido',
                    '¡Usuario o Contraseña Incorrectos!.' );
            break;
        };

        delete_cookie( 'session_state' );
    </script>
</body>
</html>
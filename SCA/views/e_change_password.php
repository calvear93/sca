<!DOCTYPE html>
<html lang="es">
<head>
    <title>Cambiar Constraseña</title>
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
    <script src="styles/js/bootstrap-table-contextmenu.js"></script>
    <script src="styles/js/bootflat2/jquery.fs.stepper.min.js"></script>
    <script src="styles/js/wow.min.js"></script>
    <script src="styles/js/validator.js"></script>
    <script src="styles/js/jquery.mask.min.js"></script>
    <script src="styles/js/bootstrap-notify.min.js"></script>
    <script src="styles/js/bootstrap-confirm.js"></script>
    <script src="styles/js/scripts/notifications.js"></script>
    <script src="styles/js/cookies.js"></script>

    <link rel="stylesheet" href="styles/css/views/general.css">

    <script src="styles/js/normalizer.js"></script>

    <script>new WOW().init();</script>
    
    <?php require_once( '../utilities/Normalizer.php' ); ?>
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
                <a class="navbar-brand" href="main_student.php">SCA</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active wow zoomIn"><a href="#">Cambiar Contraseña</a></li>

                <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu Estudiante  <span class="caret"></span></a>
                        <ul class="dropdown-menu animated pulse">
                            <li class="dropdown-header"><small>CALIFICACIONES</small></li>
                            <li><a href="e_show_performance_graph.php">Ver Gráfico Rendimiento</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>CERTIFICADOS</small></li>
                            <li><a href="../services/generate_scores_certificate.php">Obtener Certificado de Notas</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>EVALUACIONES</small></li>
                            <li><a href="e_list_exams.php">Ver Próximas Evaluaciones</a></li>
                        </ul>
                    </li>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración <span class="caret"></span></a>
                    <ul class="dropdown-menu animated pulse">
                        <li><a id="see_profile" href="e_see_profile.php"><span class="glyphicon glyphicon-user"></span>  Ver Perfil</a></li>
                        <li><a id="change_password" href="e_change_password.php"><span class="glyphicon glyphicon-lock"></span>  Cambiar Contraseña</a></li>
                        <li><a id="log_out" href="../services/log_out.php"><span class="glyphicon glyphicon-log-in"></span>  Cerrar Sesión</a></li>
                    </ul>
                </li>
                <li class="active wow zoomIn"><a href="#"><?=Normalizer::output_normalize_run( $_COOKIE[ 'session_user' ] )?></a></li>
            </ul>

        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h3 class="animated pulse">Cambiar contraseña.</h3>
        </div>
        <div class="row">

            <form id="change_password" action="../services/change_password.php" method="POST" role="change_password" data-toggle="validator">
                <div class="col-lg-6">
                <p class="text-success">Ingrese contraseña Actual.</p>
                    
                    <div class="form-group">
                        <label for="oldpassword" class="control-label text-info">Contraseña Actual*</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Escriba su actual contraseña" required>
                            <label for="oldpassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"><span class="label label-info"></span></div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block animated bounceInUp">Cambiar Contraseña</button>
                    <a href="main_admin.php" class="btn btn-danger btn-sm btn-block animated bounceInUp" role="button">Cancelar</a>
                </div>

                <div class="col-lg-6">
                <p class="text-success">Ingrese Nueva Contraseña.</p>

                    <div class="form-group">
                        <label for="newpassword" class="control-label text-success">Nueva Contraseña*</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Escriba la nueva contraseña"
                        data-minlength="6" data-minlength-error="Contraseña demasiado corta" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" required>
                            <label for="newpassword" class="input-group-addon glyphicon glyphicon-lock"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"><span class="label label-info">Mínimo 6 carácteres. Debe contener letra mayúscula, minúscula y al menos un carácter especial.</span></div>
                    </div>
                    <div class="form-group">
                        <label for="pass-confirm" class="control-label text-success">Repita Contraseña*</label>
                        <div class="input-group">
                            <input type="password" class="form-control success" id="pass-confirm" name="pass-confirm" placeholder="Escriba nuevamente la contraseña"
                        data-match-error="¡Contraseñas diferentes!" data-match="#newpassword" required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-lock"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    
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
    <script src="styles/js/scripts/confirm-dialogs.js"></script>
</body>
</html>
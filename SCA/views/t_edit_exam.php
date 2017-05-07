<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Evaluación</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" sizes="256x256" href="images/icon-app.png">
    
    <link rel="stylesheet" href="styles/css/bootstrap3/bootstrap-3.3.6.min.css">
    <link rel="stylesheet" href="styles/css/bootstrap3/jasny-bootstrap-3.1.3.min.css">
    <link rel="stylesheet" href="styles/css/bootflat2/bootflat-2.0.4.min.css">
    <link rel="stylesheet" href="styles/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="styles/css/animate.min.css">
    <link rel="stylesheet" href="styles/css/clockpicker.css">
    <link rel="stylesheet" href="styles/css/clockpicker-extend.css">
    <link rel="stylesheet" href="styles/css/bootstrap-datepicker.min.css">

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
    <script src="styles/js/bootstrap-confirm.js"></script>
    <script src="styles/js/clockpicker.js"></script>
    <script src="styles/js/bootstrap-datepicker.min.js"></script>
    <script src="styles/js/scripts/notifications.js"></script>
    <script src="styles/js/cookies.js"></script>

    <link rel="stylesheet" href="styles/css/views/general.css">
    
    <script>new WOW().init();</script>

    <?php
        require_once( '../cfg/constants.php' );
        require_once( '../utilities/Connector.php' );
        require_once( '../utilities/Normalizer.php' );
        require_once( '../services/DataGetter.php' );

        session_start();
        
        $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

        $_SESSION[ 'exam_data' ] = DataGetter::get_exam_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'exam_focused' ] );

        $description = Normalizer::output_normalize_paragraph( $_SESSION[ 'exam_data' ][ 'descripcion' ] );
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
                <a class="navbar-brand" href="main_teacher.php">SCA</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active wow zoomIn"><a href="#">Editar Evaluación</a></li>

                <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu Profesor  <span class="caret"></span></a>
                        <ul class="dropdown-menu animated pulse">
                            <li class="dropdown-header"><small>EVALUACION</small></li>
                            <li><a href="t_list_subjects.php">Registrar Evaluación</a></li>
                            <li><a href="t_list_exams.php">Ver Mis Evaluaciones</a></li>
                            <li><a href="t_list_previous_exams.php">Ver Mis Evaluaciones Anteriores</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>CALIFICACION</small></li>
                            <li><a href="t_list_subjects.php">Calificar</a></li>
                            <li><a href="t_list_subjects.php">Ver Calificaciones</a></li>
                        </ul>
                    </li>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración <span class="caret"></span></a>
                    <ul class="dropdown-menu animated pulse">
                        <li><a id="change_password" href="t_see_profile.php"><span class="glyphicon glyphicon-user"></span>  Ver Perfil</a></li>
                        <li><a id="change_password" href="t_change_password.php"><span class="glyphicon glyphicon-lock"></span>  Cambiar Contraseña</a></li>
                        <li><a id="log_out" href="../services/log_out.php"><span class="glyphicon glyphicon-log-in"></span>  Cerrar Sesión</a></li>
                    </ul>
                </li>
                <li class="active wow zoomIn"><a href="#"><?=Normalizer::output_normalize_run( $_COOKIE[ 'session_user' ] )?></a></li>
            </ul>

        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h3 class="animated pulse">Editar Evaluación.</h3>
        </div>
        <div class="row">

            <form id="data_student" action="../services/teacher/edit_exam.php" method="POST" role="register" data-toggle="validator">
                <div class="col-lg-6">
                <p class="text-success">Ingrese los datos la evaluación.</p>
                    
                    <div class="form-group">
                        <label for="description" class="control-label text-info">Descripción</label>
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="Ingrese descripción"><?=$description?></textarea>
                    </div>

                    <div class="col-lg-6">
                        <label for="time_start" class="control-label text-info">Hora Inicio*</label>
                        <div class="input-group clockpicker">
                            <input type="text" class="form-control" name="time_start" value=<?=$_SESSION[ 'exam_data' ][ 'inicio' ]?>></input>
                            <label for="time_start" class="input-group-addon glyphicon glyphicon-time"></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="time_end" class="control-label text-info">Hora Término*</label>
                        <div class="input-group clockpicker">
                            <input type="text" class="form-control" name="time_end" value=<?=$_SESSION[ 'exam_data' ][ 'termino' ]?>></input>
                            <label for="time_end" class="input-group-addon glyphicon glyphicon-time"></label>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                <p class="text-success">Ingrese Fecha.</p>
                    
                    <label for="description" class="control-label text-info">Fecha*</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="date" name="date" value=<?=$_SESSION[ 'exam_data' ][ 'fecha' ]?> required>
                        <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-lg btn-block animated bounceInUp">Guardar Cambios</button>
                    <a href="main_teacher.php" class="btn btn-danger btn-sm btn-block animated bounceInUp" role="button">Cancelar</a>
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
    
    <script>
        $('.clockpicker').clockpicker({
            autoclose: 'true'
        });

        $.fn.datepicker.dates['en'] = {
            days: ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],
            daysShort: ["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"],
            daysMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
            months: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            monthsShort: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],
            today: "Hoy",
            clear: "Borrar",
            format: "dd-mm-yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

        delete_cookie( 'session_state' );
    </script>
</body>
</html>
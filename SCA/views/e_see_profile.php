<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mi Perfil</title>
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
    
    <?php
        require_once( '../cfg/constants.php' );
        require_once( '../utilities/Connector.php' );
        require_once( '../utilities/Normalizer.php' );
        require_once( '../services/DataGetter.php' );

        session_start();
        
        $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

        $_SESSION[ 'student_data' ] = DataGetter::get_student_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'session_user' ] );

        $names = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres' ] );
        $first_name = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'apellido_paterno' ] );
        $last_name = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'apellido_materno' ] );
        $phone = $_SESSION[ 'student_data' ][ 'fono' ];
        $email = $_SESSION[ 'student_data' ][ 'email' ];
        $current_course = $_SESSION[ 'student_data' ][ 'curso_actual' ];

        if ( $current_course != NULL ) {
            $course = DataGetter::get_course_data( $_SESSION[ 'db_connection' ], $current_course );
            $level = $course[ 'grado' ] . "° " .  Normalizer::output_normalize_name( $course[ 'nivel' ] ) . " " . Normalizer::output_normalize_name( $course[ 'letra' ] );
        } else {
            $level = 'Estudiante sin matrícula';
        }

        $names_attorney = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres_apoderado' ] );
        $first_name_attorney = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres_apoderado' ] );
        $last_name_attorney = Normalizer::output_normalize_name( $_SESSION[ 'student_data' ][ 'nombres_apoderado' ] );
        $phone_attorney = $_SESSION[ 'student_data' ][ 'fono_apoderado' ];
        $email_attorney = $_SESSION[ 'student_data' ][ 'email_apoderado' ];

        $run = Normalizer::output_normalize_run( $_SESSION[ 'student_data' ][ 'run' ] );
        $run_attorney = Normalizer::output_normalize_run( $_SESSION[ 'student_data' ][ 'run_apoderado' ] );

        $average = DataGetter::get_student_average_score_from_current_course( $_SESSION[ 'db_connection' ], $_COOKIE[ 'session_user' ] );
        $average = $average == NULL ? 0 : $average;
        $email = $email == NULL ? 'No Registrado' : $email;
        $email_attorney = $email_attorney == NULL ? 'No Registrado' : $email_attorney;
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
                <a class="navbar-brand" href="main_student.php">SCA</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active wow zoomIn"><a href="#">Mi Perfil</a></li>

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
            <div class="col-lg-1"></div>
            <div class="col-lg-11">
                <h3 class="animated pulse"><text class="text-info"></textarea><strong><?=$names . " " . $first_name . " " . $last_name ?></strong></text></h3>
            </div>
        </div>

        <div class="panel panel-info animated zoomInUp">
            <div class="panel-heading">
                <h1 class="panel-title">Perfil del Estudiante</h1>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">RUN:</strong></span><?=$run?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Nombres:</strong></span><?=$names?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Apellido Paterno:</strong></span><?=$first_name?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Apellido Materno:</strong></span><?=$last_name?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Fono:</strong></span><?=$phone?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Correo Electrónico:</strong></span><?=$email?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Curso:</strong></span><?=$level?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Promedio acumulado:</strong></span><?=$average?></li>
                </ul>
            </div>
        </div>

        <div class="panel panel-primary animated zoomInUp">
            <div class="panel-heading">
                <h1 class="panel-title">Datos del Apoderado</h1>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item text-muted" contenteditable="false"><text class="text-info"></textarea><strong><?=$names_attorney . " " . $first_name_attorney . " " . $last_name_attorney ?></strong></text></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">RUN Apoderado:</strong></span><?=$run_attorney?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Nombres Apoderado:</strong></span><?=$names_attorney?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Apellido Paterno Apoderado:</strong></span><?=$first_name_attorney?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Apellido Materno Apoderado:</strong></span><?=$last_name_attorney?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Fono Apoderado:</strong></span><?=$phone_attorney?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Correo Electrónico Apoderado:</strong></span><?=$email_attorney?></li>
                </ul>
            </div>
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
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ver Profesor</title>
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

        $_SESSION[ 'teacher_data' ] = DataGetter::get_teacher_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'teacher_focused' ] );
        $_SESSION[ 'courses_list' ] = DataGetter::get_subject_list_by_teacher( $_SESSION[ 'db_connection' ], $_COOKIE[ 'teacher_focused' ] );

        $names = Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'nombres' ] );
        $first_name = Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'apellido_paterno' ] );
        $last_name = Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'apellido_materno' ] );
        $phone = $_SESSION[ 'teacher_data' ][ 'fono' ];
        $email = $_SESSION[ 'teacher_data' ][ 'email' ];
        $degree = Normalizer::output_normalize_paragraph( $_SESSION[ 'teacher_data' ][ 'titulo' ] );
        $enable = $_SESSION[ 'teacher_data' ][ 'habilitado' ];

        $run = Normalizer::output_normalize_run( $_SESSION[ 'teacher_data' ][ 'run' ] );
        $email = $email == NULL ? 'No Registrado' : $email;
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
                <li class="active wow zoomIn"><a href="#">Perfil de: <?=$run?></a></li>
                
                <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estudiante  <span class="caret"></span></a>
                        <ul class="dropdown-menu animated pulse">
                            <li class="dropdown-header"><small>MENÚ ESTUDIANTE</small></li>
                            <li><a id="m" href="register_student.php">Registrar</a></li>
                            <li><a id="undo_student" href="../services/admin/undo_student_register.php">Deshacer último registro</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>VISUALIZAR</small></li>
                            <li><a href="list_students.php">Ver Lista</a></li>
                            <li><a href="list_courses.php">Ver Lista por Curso</a></li>
                        </ul>
                    </li>
                </li>

                <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profesor  <span class="caret"></span></a>
                        <ul class="dropdown-menu animated pulse">
                            <li class="dropdown-header"><small>MENÚ PROFESOR</small></li>
                            <li><a href="register_teacher.php">Registrar</a></li>
                            <li><a id="undo_teacher" href="../services/admin/undo_teacher_register.php">Deshacer último registro</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>VISUALIZAR</small></li>
                            <li><a href="list_teachers.php">Ver Lista</a></li>
                            <li><a href="list_courses.php">Ver Lista por Curso</a></li>
                            <li><a href="list_teachers_disabled.php">Ver Lista Inhabilitados</a></li>
                        </ul>
                    </li>
                </li>

                <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Curso  <span class="caret"></span></a>
                        <ul class="dropdown-menu animated pulse">
                            <li class="dropdown-header"><small>MENÚ CURSO</small></li>
                            <li><a href="register_course.php">Registrar</a></li>
                            <li><a id="undo_course" href="../services/admin/undo_course_register.php">Deshacer último registro</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>VISUALIZAR</small></li>
                            <li><a href="list_courses.php">Ver Lista</a></li>
                        </ul>
                    </li>
                </li>

                <li class="dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle animated jello" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Asignatura  <span class="caret"></span></a>
                        <ul class="dropdown-menu animated pulse">
                            <li class="dropdown-header"><small>MENÚ ASIGNATURA</small></li>
                            <li><a href="register_subject.php">Registrar</a></li>
                            <li><a id="undo_subject" href="../services/admin/undo_subject_register.php">Deshacer último registro</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"><small>VISUALIZAR</small></li>
                            <li><a href="list_courses.php">Ver Lista por Curso</a></li>
                        </ul>
                    </li>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a id="log_out" href="../services/log_out.php"><span class="glyphicon glyphicon-log-in"></span>  Cerrar Sesión</a></li>
                <li class="active wow zoomIn"><a href="#">Funcionario</a></li>
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
                <h1 class="panel-title">Perfil del Profesor</h1>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">RUN:</strong></span><?=$run?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Nombres:</strong></span><?=$names?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Apellido Paterno:</strong></span><?=$first_name?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Apellido Materno:</strong></span><?=$last_name?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Fono:</strong></span><?=$phone?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Título:</strong></span><?=$degree?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Correo Electrónico:</strong></span><?=$email?></li>
                </ul>
            </div>
        </div>

        <div class="panel panel-primary animated zoomInUp">
            <div class="panel-heading">
                <h1 class="panel-title">Asignaturas que imparte</h1>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php 
                        foreach ( $_SESSION[ 'courses_list' ] as $subject ) {
                            $course = DataGetter::get_course_data( $_SESSION[ 'db_connection' ], $subject[ 'curso' ] );
                            $level = $course[ 'grado' ] . "° " .  Normalizer::output_normalize_name( $course[ 'nivel' ] ) . " " . Normalizer::output_normalize_name( $course[ 'letra' ] );
                            echo '<li class="list-group-item text-right"><span class="pull-left"><strong class="">' . Normalizer::output_normalize_paragraph( $subject[ 'nombre' ] ) . '</strong></span>' . $level . '</li>';
                        }
                    ?>
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
        
</body>
</html>
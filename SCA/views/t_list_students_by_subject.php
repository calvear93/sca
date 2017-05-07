<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista Estudiantes</title>
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
        require_once( '../utilities/Connector.php' ); 
        require_once( '../utilities/Normalizer.php' );
        require_once( '../services/TableGetter.php' );

        session_start();

        $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

        $_SESSION[ 'table_name' ] = ( new TableGetter() )->save_student_list_by_subject( $_COOKIE[ 'subject_focused' ] );
        $subject = DataGetter::get_subject_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'subject_focused' ] );
        $course =  DataGetter::get_course_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'subject_focused' ] );
        
        $subject_name = Normalizer::output_normalize_paragraph( $subject[ 'nombre' ] );
        $level = $course[ 'grado' ] . "° " .  Normalizer::output_normalize_name( $course[ 'nivel' ] ) . " " . Normalizer::output_normalize_name( $course[ 'letra' ] );
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
                <li class="active wow zoomIn"><a href="#" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content='<?=$subject_name?> (<?=$level?>)'>Lista Asignaturas</a></li>

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
        
            <div class="container animated bounceInUp">
                <div class="row">
                    <table id='students' data-pagination="true" data-page-size="12"
                    data-search="true" data-page-list="12,15" data-show-pagination-switch="true"
                    data-url=<?=$_SESSION[ 'table_name' ]?>>
                        <thead>
                            <tr>
                                <th data-field='run' data-formatter="run_normalizer">RUN</th>
                                <th data-field='nombres' data-formatter="string_normalizer">Nombre</th>
                                <th data-field='apellido_paterno' data-formatter="string_normalizer">Apellido Paterno</th>
                                <th data-field='apellido_materno' data-formatter="string_normalizer">Apellido Materno</th>
                                <th data-field='fono'>Fono</th>
                                <th data-field='email'>Correo Electrónico</th>
                            </tr>
                        </thead>
                    </table>
                </div>  
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
    
    <ul id="context-menu" class="dropdown-menu animated pulse">
        <li data-item="register_score"><a>Calificar</a></li>
        <li data-item="see_scores"><a>Ver Calificaciones</a></li>
        <li role="separator" class="divider"></li>
        <li data-item="see_profile"><a>Ver mas datos</a></li>
    </ul> 
    
    <script src="styles/js/scripts/confirm-dialogs.js"></script>
    
    <script src="styles/js/scripts/notify-cases-teacher.js"></script>
    <script>
        delete_cookie( 'session_state' );
        $('[data-toggle="popover"]').popover();
        $( function() {
            $( '#students' ).bootstrapTable( {
                contextMenu: '#context-menu',
                onContextMenuItem: function( row, $student ) {
                    switch( $student.data("item") ) {
                        case "register_score":
                            set_cookie( 'student_focused', row.run );
                            window.location.href = "t_register_score.php";
                        break;
                        case "see_scores":
                            set_cookie( 'student_focused', row.run );
                            window.location.href = "t_list_student_scores_by_subject.php";
                        break;
                        case "see_profile":
                            set_cookie( 'student_focused', row.run );
                            window.location.href = "t_show_student.php";
                        break;
                    }
                }
            });
        });
    </script>
</body>
</html>
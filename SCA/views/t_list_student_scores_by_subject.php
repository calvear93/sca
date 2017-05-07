<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista Calificaciones</title>
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
        require_once( '../utilities/Normalizer.php' );
        require_once( '../services/TableGetter.php' );

        session_start();

        $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

        $_SESSION[ 'table_name' ] = ( new TableGetter() )->save_score_list_of_student_by_subject( $_COOKIE[ 'student_focused' ], $_COOKIE[ 'subject_focused' ] );
        
        $subject = DataGetter::get_subject_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'subject_focused' ] );
        $course =  DataGetter::get_course_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'subject_focused' ] );
        
        $subject_name = Normalizer::output_normalize_paragraph( $subject[ 'nombre' ] );
        $level = $course[ 'grado' ] . "° " .  Normalizer::output_normalize_name( $course[ 'nivel' ] ) . " " . Normalizer::output_normalize_name( $course[ 'letra' ] );
        $student = Normalizer::output_normalize_run( $_COOKIE[ 'student_focused' ] );
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
                <li class="active wow zoomIn"><a href="#" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content='<?=$student?> <?=$subject_name?> (<?=$level?>)'>Lista Calificaciones</a></li>

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
                    <table id='scores' data-pagination="true" data-page-size="12"
                    data-search="true" data-page-list="12,15" data-show-pagination-switch="true"
                    data-url=<?=$_SESSION[ 'table_name' ]?>>
                        <thead>
                            <tr>
                                <th data-field='id' >ID</th>
                                <th data-field='valor'>Valor</th>
                                <th data-field='descripcion' data-formatter="string_normalizer">Descripción</th>
                                <th data-field='fecha'>Fecha</th>
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
        <li data-item="edit_score"><a>Editar</a></li>
        <li data-item="delete_score"><a>Eliminar</a></li>
    </ul> 
    
    <script src="styles/js/scripts/confirm-dialogs.js"></script>
    
    <script src="styles/js/scripts/notify-cases-teacher.js"></script>
    <script>
        delete_cookie( 'session_state' );
        $('[data-toggle="popover"]').popover();
        $( function() {
            $( '#scores' ).bootstrapTable( {
                contextMenu: '#context-menu',
                onContextMenuItem: function( row, $score ) {
                    switch( $score.data("item") ) {
                        case "edit_score":
                            set_cookie( 'score_focused', row.id );
                            window.location.href = "t_edit_score.php";
                        break;
                        case "delete_score":
                            set_cookie( 'score_focused', row.id );
                            window.location.href = "../services/teacher/delete_score.php";
                        break;
                    }
                }
            });
        });
    </script>
</body>
</html>
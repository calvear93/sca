<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista Evaluaciones</title>
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
        $_SESSION[ 'table_name' ] = ( new TableGetter() )->save_exams_list_by_teacher( $_COOKIE[ 'session_user' ] );
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
                <li class="active wow zoomIn"><a href="#">Lista Evaluaciones</a></li>

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
                    <table id='exams' data-pagination="true" data-page-size="12"
                    data-search="true" data-page-list="12,15" data-show-pagination-switch="true"
                    data-url=<?=$_SESSION[ 'table_name' ]?>>
                        <thead>
                            <tr>
                                <th data-field='id' >ID</th>
                                <th data-field='descripcion' data-formatter="string_normalizer">Descripción</th>
                                <th data-field='fecha'>Fecha</th>
                                <th data-field='inicio'>Hora Inicio</th>
                                <th data-field='termino'>Hora Término</th>
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
        <li data-item="edit_exam"><a>Editar</a></li>
        <li data-item="cancel_exam"><a>Cancelar</a></li>
    </ul> 
    
    <script src="styles/js/scripts/confirm-dialogs.js"></script>
    
    <script src="styles/js/scripts/notify-cases-teacher.js"></script>
    <script>
        delete_cookie( 'session_state' );
        $( function() {
            $( '#exams' ).bootstrapTable( {
                contextMenu: '#context-menu',
                onContextMenuItem: function( row, $exam ) {
                    switch( $exam.data("item") ) {
                        case "edit_exam":
                            set_cookie( 'exam_focused', row.id );
                            window.location.href = "t_edit_exam.php";
                        break;
                        case "cancel_exam":
                            set_cookie( 'exam_focused', row.id );
                            window.location.href = "../services/teacher/cancel_exam.php";
                        break;
                    }
                }
            });
        });
    </script>
</body>
</html>
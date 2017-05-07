<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Profesor</title>
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
    <script src="styles/js/bootstrap-confirm.js"></script>
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

        $_SESSION[ 'teacher_data' ] = DataGetter::get_teacher_data( $_SESSION[ 'db_connection' ], $_COOKIE[ 'teacher_focused' ] );

        $name = Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'nombres' ] ) . " " .
            Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'apellido_paterno' ] ) . " " .
            Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'apellido_materno' ] );
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
                <li class="active wow zoomIn"><a href="#">Editar Profesor</a></li>
                
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
            <h3 class="animated pulse">Editar Profesor. <text class="text-success"><?=$name?></h3>
        </div>
        <div class="row">

            <form id="data_teacher" action="../services/admin/edit_teacher.php" method="POST" role="edit" data-toggle="validator">
                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="names" class="control-label text-success">Nombres*</label>
                        <input type="text" class="form-control" id="names" name="names" value='<?=Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'nombres' ] )?>' required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="control-label text-success">Apellido Paterno*</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value='<?=Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'apellido_paterno' ] )?>' required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label text-success">Apellido Materno*</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value='<?=Normalizer::output_normalize_name( $_SESSION[ 'teacher_data' ][ 'apellido_materno' ] )?>' required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="degree" class="control-label text-success">Título*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="degree" name="degree" value='<?=Normalizer::output_normalize_paragraph( $_SESSION[ 'teacher_data' ][ 'titulo' ] )?>' required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-folder-close"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label text-info">Fono*</label>
                        <div class="input-group">
                            <input type="phone" class="form-control" id="phone" name="phone" value='<?=$_SESSION[ 'teacher_data' ][ 'fono' ]?>'
                        pattern="[0-9]{6,8}" required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-earphone"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label text-info">Correo Electrónico</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" value='<?=$_SESSION[ 'teacher_data' ][ 'email' ]?>'
                        pattern="[[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})">
                            <label for="pass" class="input-group-addon glyphicon glyphicon-envelope"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg btn-block animated bounceInUp">Guardar Cambios</button>
                    <a href="main_admin.php" class="btn btn-danger btn-sm btn-block animated bounceInUp" role="button">Cancelar</a>
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
        delete_cookie( 'session_state' );

        $( '#run' ).mask( '00.000.000-K', {
            translation: {
                'K': {
                    pattern: /[0-9kK]/
                }
            }
        });
        $( '#phone' ).mask( '00000099' );
    </script>
</body>
</html>
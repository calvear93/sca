<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrar Estudiante</title>
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
                <li class="active wow zoomIn"><a href="#">Registrar Estudiante</a></li>
                
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
            <h3 class="animated pulse">Registrar Estudiante.</h3>
        </div>
        <div class="row">

            <form id="data_student" action="../services/admin/register_student.php" method="POST" role="register" data-toggle="validator">
                <div class="col-lg-6">
                <p class="text-success">Ingrese los datos del Estudiante.</p>
                    <div class="form-group">
                        <label for="run" class="control-label text-info">Rol Único Nacional*</label>
                        <input type="text" class="form-control" id="run" name="run" placeholder="Ingrese RUN"
                        pattern="([0-9]{2})[.]{0,1}([0-9]{3})[.]{0,1}([0-9]{3})-{0,1}([0-9Kk])" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="names" class="control-label text-success">Nombres*</label>
                        <input type="text" class="form-control" id="names" name="names" placeholder="Ingrese sus nombres" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="control-label text-success">Apellido Paterno*</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ingrese apellido" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label text-success">Apellido Materno*</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese apellido" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label text-info">Fono*</label>
                        <div class="input-group">
                            <input type="phone" class="form-control" id="phone" name="phone" placeholder="Ingrese numero de contacto"
                        pattern="[0-9]{6,8}" required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-earphone"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label text-info">Correo Electrónico</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese e-mail"
                        pattern="[[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})">
                            <label for="pass" class="input-group-addon glyphicon glyphicon-envelope"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>

                    <div class="form-group">
                        <label for="pass" class="control-label text-warning">Contraseña*</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Escriba una contraseña"
                        data-minlength="6" data-minlength-error="Contraseña demasiado corta" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-lock"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"><span class="label label-info">Mínimo 6 carácteres. Debe contener letra mayúscula, minúscula y al menos un carácter especial.</span></div>
                    </div>
                    <div class="form-group">
                        <label for="pass-confirm" class="control-label text-warning">Repita Contraseña*</label>
                        <div class="input-group">
                            <input type="password" class="form-control success" id="pass-confirm" name="pass-confirm" placeholder="Escriba nuevamente la contraseña"
                        data-match-error="¡Contraseñas diferentes!" data-match="#pass" required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-lock"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>

                </div>

                <div class="col-lg-6">
                <p class="text-success">Ingrese los datos del Apoderado.</p>

                    <div class="form-group">
                        <label for="run_attorney" class="control-label text-info">Rol Único Nacional Apoderado*</label>
                        <input type="text" class="form-control" id="run_attorney" name="run_attorney" placeholder="Ingrese RUN"
                        pattern="([0-9]{2})[.]{0,1}([0-9]{3})[.]{0,1}([0-9]{3})-{0,1}([0-9Kk])" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="names_attorney" class="control-label text-success">Nombres Apoderado*</label>
                        <input type="text" class="form-control" id="names_attorney" name="names_attorney" placeholder="Ingrese nombres del apoderado" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="first_name_attorney" class="control-label text-success">Apellido Paterno Apoderado*</label>
                        <input type="text" class="form-control" id="first_name_attorney" name="first_name_attorney" placeholder="Ingrese apellido paterno del apoderado" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="last_name_attorney" class="control-label text-success">Apellido Materno Apoderado*</label>
                        <input type="text" class="form-control" id="last_name_attorney" name="last_name_attorney" placeholder="Ingrese apellido materno del apoderado" required>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone_attorney" class="control-label text-info">Fono Apoderado*</label>
                        <div class="input-group">
                            <input type="phone_attorney" class="form-control" id="phone_attorney" name="phone_attorney" placeholder="Ingrese telefono del apoderado"
                        pattern="[0-9]{6,8}" required>
                            <label for="pass" class="input-group-addon glyphicon glyphicon-earphone"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <div class="form-group">
                        <label for="email_attorney" class="control-label text-info">Correo Electrónico Apoderado</label>
                        <div class="input-group">
                            <input type="email_attorney" class="form-control" id="email_attorney" name="email_attorney" placeholder="Ingrese e-mail del apoderado"
                        pattern="[[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})">
                            <label for="pass" class="input-group-addon glyphicon glyphicon-envelope"></label>
                        </div>
                        <div class="help-block with-errors" delay="1000"></div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block animated bounceInUp">Registrar</button>
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
        $( '#run_attorney' ).mask( '00.000.000-K', {
            translation: {
                'K': {
                    pattern: /[0-9kK]/
                }
            }
        });
        $( '#phone' ).mask( '00000099' );
        $( '#phone_attorney' ).mask( '00000099' );
    </script>
</body>
</html>
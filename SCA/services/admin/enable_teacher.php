<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/TeacherDoesntExistsException.php' );
    require_once( '../../utilities/exceptions/TeacherEnabledException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    enable_teacher( $_COOKIE[ 'teacher_focused' ] );

    setcookie( 'session_state', 'teacher_enabled', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function enable_teacher( $run ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT habilitar_profesor( '$run' );" );
        } catch ( TeacherDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( TeacherEnabledException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'teacher_enabled_already', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
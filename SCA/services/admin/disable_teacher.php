<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/TeacherDoesntExistsException.php' );
    require_once( '../../utilities/exceptions/TeacherDisabledException.php' );
    require_once( '../../utilities/exceptions/TeacherBelongToSubjectException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    disable_teacher( $_COOKIE[ 'teacher_focused' ] );

    setcookie( 'session_state', 'teacher_disabled', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function disable_teacher( $run ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT deshabilitar_profesor( '$run' );" );
        } catch ( TeacherDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( TeacherDisabledException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'teacher_disabled_already', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( TeacherBelongToSubjectException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'teacher_belong_to_subject', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
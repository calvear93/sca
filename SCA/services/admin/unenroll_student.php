<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/StudentDoesntExistsException.php' );
    require_once( '../../utilities/exceptions/StudentCourseEnrolmentYetException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    unenroll_student( $_COOKIE[ 'student_focused' ] );

    setcookie( 'session_state', 'unenroll_student', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function unenroll_student( $run ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT desmatricular_estudiante_de_curso( '$run' );" );
        } catch ( StudentDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( StudentCourseEnrolmentYetException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'unenroll_student_yet', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
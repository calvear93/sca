<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/StudentDoesntExistsException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    if ( !isset( $_COOKIE[ 'last_student_registered' ] ) ) {
        setcookie( 'session_state', 'last_student_register_invalid', time() + (86400 * 30), '/' );
        header ( "Location: ../../views/main_admin.php" );
        exit;
    }

    undo_student_register( $_COOKIE[ 'last_student_registered' ] );
    setcookie( 'session_state', 'last_student_register_deleted', time() + (86400 * 30), '/' );
    setcookie( 'last_student_registered', NULL  );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function undo_student_register( $run ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT deshacer_registro_estudiante( '$run' );" );
        } catch ( StudentDoesntExistsException $e ) {
            echo $e->getMessage(); // Student already linked to a course.
            setcookie( 'session_state', 'last_student_register_invalid', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
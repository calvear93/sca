<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/TeacherDoesntExistsException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    if ( !isset( $_COOKIE[ 'last_teacher_registered' ] ) ) {
        setcookie( 'session_state', 'last_teacher_register_invalid', time() + (86400 * 30), '/' );
        header ( "Location: ../../views/main_admin.php" );
        exit;
    }

    undo_teacher_register( $_COOKIE[ 'last_teacher_registered' ] );
    setcookie( 'session_state', 'last_teacher_register_deleted', time() + (86400 * 30), '/' );
    setcookie( 'last_teacher_registered', NULL  );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function undo_teacher_register( $run ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT deshacer_registro_profesor( '$run' );" );
        } catch ( TeacherDoesntExistsException $e ) {
            //echo $e->getMessage(); // Teacher doesnt exists.
            setcookie( 'session_state', 'last_teacher_register_invalid', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
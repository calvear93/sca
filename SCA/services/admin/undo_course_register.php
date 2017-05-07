<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/CourseDoesntExistsException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    if ( !isset( $_COOKIE[ 'last_course_registered' ] ) ) {
        setcookie( 'session_state', 'last_course_register_invalid', time() + (86400 * 30), '/' );
        header ( "Location: ../../views/main_admin.php" );
        exit;
    }

    undo_course_register( $_COOKIE[ 'last_course_registered' ] );
    setcookie( 'session_state', 'last_course_register_deleted', time() + (86400 * 30), '/' );
    setcookie( 'last_course_registered', NULL  );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function undo_course_register( $id ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT deshacer_registro_curso( $id );" );
        } catch ( CourseDoesntExistsException $e ) {
            //echo $e->getMessage(); // Course doesnt exists.
            setcookie( 'session_state', 'last_course_register_invalid', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
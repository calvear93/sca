<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/SubjectDoesntExistsException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    if ( !isset( $_COOKIE[ 'last_subject_registered' ] ) ) {
        setcookie( 'session_state', 'last_subject_register_invalid', time() + (86400 * 30), '/' );
        header ( "Location: ../../views/main_admin.php" );
        exit;
    }

    undo_subject_register( $_COOKIE[ 'last_subject_registered' ] );
    setcookie( 'session_state', 'last_subject_register_deleted', time() + (86400 * 30), '/' );
    setcookie( 'last_subject_registered', NULL  );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function undo_subject_register( $id ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT deshacer_registro_asignatura( $id );" );
        } catch ( SubjectDoesntExistsException $e ) {
            //echo $e->getMessage(); // Subject doesnt exists.
            setcookie( 'session_state', 'last_subject_register_invalid', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
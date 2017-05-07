<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/SubjectDoesntExistsException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    unlink_teacher( $_COOKIE[ 'subject_focused' ] );

    setcookie( 'session_state', 'subject_unlinked', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function unlink_teacher( $subject ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT desvincular_profesor_asignatura( $subject );" );
        } catch ( SubjectDoesntExistsException $e ) {
            //echo $e->getMessage();
        }
    }
?>
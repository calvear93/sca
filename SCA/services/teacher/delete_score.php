<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/DuplicatedExamException.php' );
    require_once( '../../utilities/exceptions/ScoreDoesntExistsException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    delete_score( $_COOKIE[ 'score_focused' ] );

    setcookie( 'session_state', 'score_deleted', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/t_list_students_by_subject.php" );
    exit;


    function delete_score( $id ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT eliminar_calificacion( $id );" );
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ScoreDoesntExistsException $e ) {
            //echo $e->getMessage();
        }
    }
?>
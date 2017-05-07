<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/DuplicatedExamException.php' );
    require_once( '../../utilities/exceptions/ExamDoesntExistsException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    cancel_exam( $_COOKIE[ 'exam_focused' ] );

    setcookie( 'session_state', 'exam_canceled', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/t_list_student_scores_by_subject.php" );
    exit;

    function cancel_exam( $id ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT cancelar_evaluacion( $id );" );
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ExamDoesntExistsException $e ) {
            //echo $e->getMessage();
        }
    }
?>
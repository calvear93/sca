<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/DuplicatedExamException.php' );
    require_once( '../../utilities/exceptions/ExamDoesntExistsException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    edit_exam( $_COOKIE[ 'exam_focused' ], $_POST['description'], $_POST['date'], $_POST['time_start'], $_POST['time_end'] );

    setcookie( 'session_state', 'exam_edited', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/t_list_exam.php" );
    exit;

    function edit_exam( $id, $description, $date, $time_start, $time_end ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT editar_evaluacion( $id, '$description', '$date', '$time_start', '$time_end' );" );
        } catch ( DuplicatedExamException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'exam_duplicated', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/t_list_scores_by_subject.php" );
            exit;
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ExamDoesntExistsException $e ) {
            //echo $e->getMessage();
        }
    }
?>
<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/DuplicatedExamException.php' );
    require_once( '../../utilities/exceptions/ForeignKeyException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    register_exam( $_POST[ 'description' ], $_POST[ 'date' ], $_POST[ 'time_start' ], $_POST[ 'time_end' ], $_COOKIE[ 'subject_focused' ] );

    setcookie( 'session_state', 'exam_registered', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/t_list_exams.php" );
    exit;

    function register_exam( $description, $date, $time_start, $time_end, $subject ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT registrar_evaluacion( '$description', '$date', '$time_start', '$time_end', $subject );" );  
        } catch ( DuplicatedExamException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'exam_duplicated', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_teacher.php" );
            exit;
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ForeignKeyException $e ) {
            //echo $e->getMessage();
        }
    }
?>
<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
	require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/ForeignKeyException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    register_score( $_POST['score'], $_POST['description'], $_COOKIE[ 'student_focused' ], $_COOKIE[ 'subject_focused' ] );

    setcookie( 'session_state', 'score_registered', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/t_list_students_by_subject.php" );
    exit;

    function register_score( $score, $description, $run_student, $subject ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT registrar_calificacion( $score, '$description', '$run_student', $subject );" );
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ForeignKeyException $e ) {
            //echo $e->getMessage();
        }
    }
?>
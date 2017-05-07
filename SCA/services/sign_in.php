<?php
	require_once( '../cfg/constants.php' );
	require_once( '../utilities/Connector.php' );
	require_once( '../utilities/Normalizer.php' );

	session_start();

	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

	Normalizer::input_normalize_run( $_POST['sign_in-user'] );

	setcookie( 'session_user', $_POST['sign_in-user'], time() + (86400 * 30), '/' );

	switch( sign_in( $_POST['sign_in-user'], $_POST['sign_in-key'] ) ) {
		case -1 :
			setcookie( 'session_state', 'invalid_sign_in', time() + (86400 * 30), '/' );
			header ("Location: ../views/sign_in.php");
			exit;

		case 0:
			setcookie( 'session_type', _ADM, time() + (86400 * 30), '/' );
			header ("Location: ../views/main_admin.php");
			exit;

		case 1:
			setcookie( 'session_type', _STUDENT, time() + (86400 * 30), '/' );
			header ("Location: ../views/main_student.php");
			exit;

		case 2:
			setcookie( 'session_type', _TEACHER, time() + (86400 * 30), '/' );
			header ("Location: ../views/main_teacher.php");
			exit;
	}

	function sign_in( $user, $pass ) {
		return pg_fetch_result( $_SESSION[ 'db_connection' ]->inject_query(
			"SELECT iniciar_sesion( '$user', '$pass' );"
		), 0, 0 );
	}
?>
<?php
	require_once( '../cfg/constants.php' );
	require_once( '../utilities/Connector.php' );
    require_once( '../utilities/exceptions/WrongPasswordException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );
    $user = $_COOKIE[ 'session_user' ];
    $oldpass = $_POST[ 'oldpassword' ];
    $newpass = $_POST[ 'newpassword' ];

    switch ( $_COOKIE[ 'session_type' ] ) {
        case _TEACHER:
        try {
            $_SESSION[ 'db_connection' ]->execute( "SELECT cambiar_password_profesor( '$user', '$oldpass', '$newpass' );" );
            setcookie( 'session_state', 'password_changed', time() + (86400 * 30), '/' );
            header ( "Location: ../views/main_teacher.php" );
            exit;
        } catch ( WrongPasswordException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'wrong_password', time() + (86400 * 30), '/' );
            header ( "Location: ../views/main_teacher.php" );
            exit;
        }
          
        case _STUDENT:
        try {
            $_SESSION[ 'db_connection' ]->execute( "SELECT cambiar_password_estudiante( '$user', '$oldpass', '$newpass' );" );
            setcookie( 'session_state', 'password_changed', time() + (86400 * 30), '/' );
            header ( "Location: ../views/main_student.php" );
            exit;
        } catch ( WrongPasswordException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'wrong_password', time() + (86400 * 30), '/' );
            header ( "Location: ../views/main_student.php" );
            exit;
        }
    }
?>
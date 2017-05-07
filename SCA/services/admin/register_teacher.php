<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
	require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/DuplicatedKeyException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

	Normalizer::input_normalize_run( $_POST['run'] );
    Normalizer::input_normalize_name( $_POST['names'] );
    Normalizer::input_normalize_name( $_POST['first_name'] );
    Normalizer::input_normalize_name( $_POST['last_name'] );
    Normalizer::input_normalize_name( $_POST['degree'] );

    register_teacher( $_POST['run'], $_POST['names'], $_POST['first_name'],
		$_POST['last_name'], $_POST['phone'], $_POST['email'], $_POST['degree'], $_POST['pass'] );

    setcookie( 'session_state', 'teacher_registered', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function register_teacher( $run, $names, $first_name, $last_name, $phone, $email, $degree, $pass ) {
        try {
            setcookie( 'last_teacher_registered', pg_fetch_result( $_SESSION[ 'db_connection' ]->inject_smart_query(
                "SELECT registrar_profesor( '$run', '$names', '$first_name',
                '$last_name', $phone, '$email', '$degree', '$pass' );" ), 0, 0 ) );          
        } catch ( DuplicatedKeyException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'teacher_duplicated_key', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        }
    }
?>
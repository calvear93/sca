<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
	require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/DuplicatedKeyException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

	Normalizer::input_normalize_name( $_POST['name'] );

    register_subject( $_POST['name'], $_POST['description'], substr( $_POST['course'], 0, 1 ) );

    setcookie( 'session_state', 'subject_registered', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function register_subject( $name, $description, $course ) {
        try {
            setcookie( 'last_subject_registered', pg_fetch_result( $_SESSION[ 'db_connection' ]->inject_smart_query(
                "SELECT registrar_asignatura( '$name', '$description', $course );" ), 0, 0 ) );            
        } catch ( DuplicatedKeyException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'subject_duplicated_key', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        }
    }
?>
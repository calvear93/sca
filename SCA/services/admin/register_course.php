<?php
	require_once( '../../cfg/constants.php' );
	require_once( '../../utilities/Connector.php' );
	require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/DuplicatedKeyException.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/ForeignKeyException.php' );

	session_start();
	
	$_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );
    
    $level = trim( substr( $_POST['level'], 3 ) );
	Normalizer::input_normalize_name( $level );
    Normalizer::input_normalize_char( $_POST['digid'] );
    
    register_course( $_POST['digid'], substr( $_POST['level'], 0, 1 ), $level );

    setcookie( 'session_state', 'course_registered', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function register_course( $digid, $grade, $level ) {
        try {
            setcookie( 'last_course_registered', pg_fetch_result( $_SESSION[ 'db_connection' ]->inject_smart_query(
                "SELECT registrar_curso( '$digid', $grade, '$level' );" ), 0, 0 ) );
        } catch ( DuplicatedKeyException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'course_duplicated_key', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ForeignKeyException $e ) {
            //echo $e->getMessage();
        }
    }
?>
<?php
require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/StudentDoesntExistsException.php' );

    session_start();
    
    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    Normalizer::input_normalize_name( $_POST['names'] );
    Normalizer::input_normalize_name( $_POST['first_name'] );
    Normalizer::input_normalize_name( $_POST['last_name'] );
    Normalizer::input_normalize_run( $_POST['run_attorney'] );
    Normalizer::input_normalize_name( $_POST['names_attorney'] );
    Normalizer::input_normalize_name( $_POST['first_name_attorney'] );
    Normalizer::input_normalize_name( $_POST['last_name_attorney'] );

    edit_student( $_SESSION[ 'student_data' ]['run'], $_POST['names'], $_POST['first_name'],
        $_POST['last_name'], $_POST['phone'], $_POST['email'] );
            
    edit_attorney( $_SESSION[ 'student_data' ]['run'], $_POST['run_attorney'], $_POST['names_attorney'], $_POST['first_name_attorney'],
        $_POST['last_name_attorney'], $_POST['phone_attorney'], $_POST['email_attorney'] );
    
    setcookie( 'session_state', 'student_edited', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function edit_student( $run, $names, $first_name, $last_name, $phone, $email ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT editar_estudiante( '$run', '$names', '$first_name',
                '$last_name', $phone, '$email' );" );          
        } catch ( StudentDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        }
    }

    function edit_attorney( $run_student, $run, $names, $first_name,
        $last_name, $phone, $email ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT editar_apoderado( '$run_student', '$run', '$names', '$first_name',
                '$last_name', $phone, '$email' );" );
        } catch ( StudentDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        }
    }
?>
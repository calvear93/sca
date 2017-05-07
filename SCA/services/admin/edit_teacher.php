<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/TeacherDoesntExistsException.php' );

    session_start();
    
    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    Normalizer::input_normalize_name( $_POST['names'] );
    Normalizer::input_normalize_name( $_POST['first_name'] );
    Normalizer::input_normalize_name( $_POST['last_name'] );
    Normalizer::input_normalize_name( $_POST['degree'] );

    edit_teacher( $_SESSION[ 'teacher_data' ]['run'], $_POST['names'], $_POST['first_name'],
        $_POST['last_name'], $_POST['phone'], $_POST['email'], $_POST['degree'] );

    setcookie( 'session_state', 'teacher_edited', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function edit_teacher( $run, $names, $first_name, $last_name, $phone, $email, $degree ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT editar_profesor( '$run', '$names', '$first_name',
                '$last_name', $phone, '$email', '$degree' );" );          
        } catch ( TeacherDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        }
    }
?>
<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/DuplicatedKeyException.php' );
    require_once( '../../utilities/exceptions/ForeignKeyException.php' );
    require_once( '../../utilities/exceptions/SubjectDoesntExistsException.php' );

    session_start();
    
    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    Normalizer::input_normalize_name( $_POST['name'] );

    edit_subject( $_SESSION[ 'subject_data' ][ 'id' ], $_POST[ 'name' ], $_POST[ 'description' ] );

    setcookie( 'session_state', 'subject_edited', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function edit_subject( $id, $name, $description ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT editar_asignatura( $id, '$name', '$description' );" );            
        } catch ( DuplicatedKeyException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'subject_duplicated_key', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( ForeignKeyException $e ) {
            //echo $e->getMessage();
        } catch ( SubjectDoesntExistsException $e ) {
            //echo $e->getMessage();
        }
    }
?>
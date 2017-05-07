<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/DuplicatedKeyException.php' );
    require_once( '../../utilities/exceptions/AttributeFormatException.php' );
    require_once( '../../utilities/exceptions/ForeignKeyException.php' );
    require_once( '../../utilities/exceptions/CourseDoesntExistsException.php' );

    session_start();
    
    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );
    
    $level = trim( substr( $_POST['level'], 3 ) );
    Normalizer::input_normalize_name( $level );
    Normalizer::input_normalize_char( $_POST['digid'] );
    unlink( $_SESSION[ 'file' ] );

    edit_course( $_SESSION[ 'course_data' ][ 'id' ], $_POST['year'], $_POST['digid'], substr( $_POST['level'], 0, 1 ), $level );

    setcookie( 'session_state', 'course_edited', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function edit_course( $id, $year, $digid, $grade, $level ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT editar_curso( $id, $year, '$digid', $grade, '$level' );" );           
        } catch ( DuplicatedKeyException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'course_duplicated_key_on_edit', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( AttributeFormatException $e ) {
            //echo $e->getMessage();
        } catch ( ForeignKeyException $e ) {
            //echo $e->getMessage();
        } catch ( CourseDoesntExistsException $e ) {
            //echo $e->getMessage();
        }
    }
?>
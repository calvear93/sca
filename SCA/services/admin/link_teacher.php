<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/TeacherDoesntExistsException.php' );
    require_once( '../../utilities/exceptions/TeacherEnabledException.php' );
    require_once( '../../utilities/exceptions/SubjectHasTeacherException.php' );
    require_once( '../../utilities/exceptions/SubjectDoesntExistsException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    link_teacher( $_COOKIE[ 'teacher_focused' ], $_COOKIE[ 'subject_focused' ] );

    setcookie( 'session_state', 'teacher_linked', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function link_teacher( $run, $subject ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT vincular_profesor_asignatura( '$run', $subject );" );
        } catch ( TeacherDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( SubjectHasTeacherException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'teacher_subject_has_teacher', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        } catch ( SubjectDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( TeacherDisabledException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'teacher_disabled_link', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
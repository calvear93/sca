<?php
    require_once( '../../cfg/constants.php' );
    require_once( '../../utilities/Connector.php' );
    require_once( '../../utilities/Normalizer.php' );
    require_once( '../../utilities/exceptions/StudentDoesntExistsException.php' );
    require_once( '../../utilities/exceptions/StudentCourseEnrolmentAlreadyException.php' );

    session_start();

    $_SESSION[ 'db_connection' ] = new Connector( _HOST, _PORT, _DB_NAME, _DB_USER, _DB_PASSWD );

    enroll_student( $_COOKIE[ 'student_focused' ], $_COOKIE[ 'course_focused' ] );

    setcookie( 'session_state', 'enroll_student', time() + (86400 * 30), '/' );
    header ( "Location: ../../views/main_admin.php" );
    exit;

    function enroll_student( $run, $course ) {
        try {
            $_SESSION[ 'db_connection' ]->execute(
                "SELECT matricular_estudiante_en_curso( '$run', $course );" );
        } catch ( StudentDoesntExistsException $e ) {
            //echo $e->getMessage();
        } catch ( StudentCourseEnrolmentAlreadyException $e ) {
            //echo $e->getMessage();
            setcookie( 'session_state', 'enroll_student_already', time() + (86400 * 30), '/' );
            header ( "Location: ../../views/main_admin.php" );
            exit;
        }
    }
?>
<?php 
require_once( 'exceptions/AttributeFormatException.php' );
require_once( 'exceptions/DuplicatedExamException.php' );
require_once( 'exceptions/DuplicatedKeyException.php' );
require_once( 'exceptions/ForeignKeyException.php' );
require_once( 'exceptions/WrongPasswordException.php' );
require_once( 'exceptions/StudentCourseEnrolmentAlreadyException.php' );
require_once( 'exceptions/StudentCourseEnrolmentYetException.php' );
require_once( 'exceptions/StudentDoesntExistsException.php' );
require_once( 'exceptions/SubjectHasTeacherException.php' );
require_once( 'exceptions/TeacherDisabledException.php' );
require_once( 'exceptions/TeacherDoesntExistsException.php' );
require_once( 'exceptions/TeacherEnabledException.php' );
require_once( 'exceptions/TeacherBelongToSubjectException.php' );
require_once( 'exceptions/ExamDoesntExistsException.php' );
require_once( 'exceptions/ScoreDoesntExistsException.php' );
require_once( 'exceptions/SubjectDoesntExistsException.php' );
require_once( 'exceptions/CourseDoesntExistsException.php' );

class ExceptionController {
    
    static function verify( $result ) {
        switch ( pg_result_error_field( $result, PGSQL_DIAG_SQLSTATE ) ) {
            case '42703': case '22007': // Invalid Attribute Format.
                throw new AttributeFormatException( "[!] Invalid Attribute Format." );

            case '23505': // Duplicated Key.
                throw new DuplicatedKeyException( "[!] Duplicated Key." );

            case '23503': // Foreign Key Violation.
                throw new ForeignKeyException( "[!] Foreign Key Violation." );

            case '26308': // Student doesn't exists.
                throw new StudentDoesntExistsException( "[!] Student doesn't exists." );

            case '26302': // Student's course registration already registered.
                throw new StudentCourseEnrolmentAlreadyException( "[!] Student's course registration already registered." );

            case '26301': // Student's hasn't course registration.
                throw new StudentCourseEnrolmentYetException( "[!] Student's course registration not registered yet." );

            case '12403': // Invalid password.
                throw new WrongPasswordException( "[!] Invalid password." );

            case '22308': // Teacher doesn't exists.
                throw new TeacherDoesntExistsException( "[!] Teacher doesn't exists." );

            case '22113': // Teacher already enabled.
                throw new TeacherEnabledException( "[!] Teacher already enabled." );

            case '22112': // Teacher already disabled.
                throw new TeacherDisabledException( "[!] Teacher already disabled." );

            case '27204': // Subject already has a teacher.
                throw new SubjectHasTeacherException( "[!] Subject already has a teacher." );

            case '21540': // Already exists an exam this day.
                throw new DuplicatedExamException( "[!] Already exists an exam this day." );

            case '22318': // Teacher teaches some subjects this year.
                throw new TeacherBelongToSubjectException( "[!] Teacher can't be disabled. (He teaches some subject currently)" );

            case '15258': // Teacher doesn't exists.
                throw new ExamDoesntExistsException( "[!] Exam doesn't exists." );

            case '17258': // Score doesn't exists.
                throw new ScoreDoesntExistsException( "[!] Score doesn't exists." );

            case '16258': // Subject doesn't exists.
                throw new SubjectDoesntExistsException( "[!] Subject doesn't exists." );

            case '11258': // Course doesn't exists.
                throw new CourseDoesntExistsException( "[!] Course doesn't exists." );
        }
    }
}
?>
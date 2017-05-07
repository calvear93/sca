<?php
/**
 * StudentCourseEnrolmentAlreadyException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class StudentCourseEnrolmentAlreadyException extends Exception {
    public function __construct( $message, $code = 26302, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
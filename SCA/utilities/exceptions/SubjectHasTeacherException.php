<?php
/**
 * SubjectHasTeacherException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class SubjectHasTeacherException extends Exception {
    public function __construct( $message, $code = 27204, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
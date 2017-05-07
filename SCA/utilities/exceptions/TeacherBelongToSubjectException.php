<?php
/**
 * TeacherBelongToSubjectException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class TeacherBelongToSubjectException extends Exception {
    public function __construct( $message, $code = 22318, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
<?php
/**
 * TeacherEnabledException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class TeacherEnabledException extends Exception {
    public function __construct( $message, $code = 22112, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
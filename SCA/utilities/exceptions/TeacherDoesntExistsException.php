<?php
/**
 * TeacherDoesntExistsException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class TeacherDoesntExistsException extends Exception {
    public function __construct( $message, $code = 22308, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
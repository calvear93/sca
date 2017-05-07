<?php
/**
 * StudentDoesntExistsException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class StudentDoesntExistsException extends Exception {
    public function __construct( $message, $code = 26308, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
<?php
/**
 * WrongPasswordException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class WrongPasswordException extends Exception {
    public function __construct( $message, $code = 12403, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
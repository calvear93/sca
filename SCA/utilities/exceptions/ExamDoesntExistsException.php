<?php
/**
 * ExamDoesntExistsException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class ExamDoesntExistsException extends Exception {
    public function __construct( $message, $code = 15258, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
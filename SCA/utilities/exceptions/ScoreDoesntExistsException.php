<?php
/**
 * ScoreDoesntExistsException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class ScoreDoesntExistsException extends Exception {
    public function __construct( $message, $code = 17258, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
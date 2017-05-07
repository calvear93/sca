<?php
/**
 * InvalidForeignKeyException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class ForeignKeyException extends Exception {
    public function __construct( $message, $code = 23503, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
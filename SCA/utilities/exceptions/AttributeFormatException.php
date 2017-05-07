<?php
/**
 * AttributeFormatException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class AttributeFormatException extends Exception {
    public function __construct( $message, $code = 42703, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
<?php
/**
 * DuplicatedExamException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class DuplicatedExamException extends Exception {
    public function __construct( $message, $code = 21540, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
<?php
/**
 * CourseDoesntExistsException Class.
 * @package utilities\exceptions
 * @version 1.0
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class CourseDoesntExistsException extends Exception {
    public function __construct( $message, $code = 11258, Exception $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
?>
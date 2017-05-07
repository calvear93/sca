<?php
class Normalizer {

	private function __construct() {}
	
    static function input_normalize_char( &$char ) {
        if ( ord( $char ) < 97 )
            $char = chr( ord( $char ) + 32 );
    }

    static function output_normalize_char( $char ) {
        return chr( ord( $char ) - 32 );
    }

	static function input_normalize_run( &$run ) {
        $run = preg_replace( '/([0-9]{2})[.]{0,1}([0-9]{3})[.]{0,1}([0-9]{3})-{0,1}([0-9Kk])/', '$1$2$3$4',
            substr( $run, 0, strlen( $run ) - 1 ).strtolower( substr( $run, strlen( $run ) - 1 ) ) );
	}

    static function output_normalize_run( $run ) {
        return substr( $run, 0, 2 ).".".substr( $run, 2, 3 ).".".substr( $run, 5, 3 )."-".strtoupper( substr( $run, 8 ) );
    }

    static function input_normalize_name( &$name ) {
        $name = strtolower( $name );
    }

    static function output_normalize_name( $name ) {
        return self::output_normalize_text( $name, '/\b[a-z]/' );
    }

    static function output_normalize_paragraph( $text ) {
        return self::output_normalize_text( $text, '/[.] *\b[a-z]|^[a-z]/' );
    }

    private static function output_normalize_text( $text, $regex ) {
        $capitalize = function( $matches ) {
            return strtoupper( $matches[0] );
        };
        return preg_replace_callback( $regex, $capitalize, $text );
    }
}
?>
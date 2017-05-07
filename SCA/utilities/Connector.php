<?php
require_once( 'ExceptionController.php' );
/**
 * Connector Class.
 * Allow to connect and comunicate to Postgres database.
 * @package utilities
 * @version 1.3
 * @author Cristopher Alvear <calvear93@gmail.com>
 */
class Connector	{
	/** @var resource Stores Postgre database connection. */
	private $connection;
	
	/**
	 * Class constructor.
	 * @param String $host Host IP.
	 * @param int    $port Connection port.
	 * @param String $db   Database name.
	 * @param String $user Database user.
	 * @param String $pass Database password.
	 */
	function __construct( $host, $port, $db, $user, $pass ) {
		$this->connection = &pg_connect( "host=$host port=$port dbname=$db user=$user password=$pass" );
	}
	
	function inject_query( $query ) {
		$result = pg_query( $this->connection, $query ) or die( pg_last_error() );
		return $result;
	}

	function inject_smart_query( $query ) {
		pg_send_query( $this->connection, $query );
		$result = pg_get_result( $this->connection );
		ExceptionController::verify( $result );
		return $result;
	}

	function execute( $query ) {
		pg_send_query( $this->connection, $query );
		ExceptionController::verify( pg_get_result( $this->connection ) );
	}
	
	function get_array_from_table( $table_name ) {
		$array = pg_copy_to( $this->connection, $table_name );
		return $array;
	}
	
	function get_row_from_table( $table_name, $n_row, $result_type, $attributes, $condition = '' ) {
		$result = $this->inject_query( "SELECT $attributes FROM $table_name $condition;" );
		$row = pg_fetch_array( $result, $n_row, $result_type );
		return $row;
	}
	
	function get_matrix_from_table( $table_name, $result_type, $attributes, $condition = '' ) {
		$array = [];
		$result = $this->inject_query( "SELECT $attributes FROM $table_name $condition;" );
		while( $row = pg_fetch_array( $result, NULL, $result_type ) )
			array_push( $array, $row );
		return $array;
	}
}
?>
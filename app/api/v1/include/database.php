<?php
//Database Class
//@author Ravi Dhavlesha

class Database
{
	var $dbConnection = null ;
	var $num_records = 0 ;
	var $last_id = 0 ;
	
	function Database ( )
	{
		$this->connect ( ) ;
		
	}
	
	function get_last_id ( )
	{
		return $this->last_id ;
	}
	
	function get_total_records ( )
	{
		return $this->num_records ; 
	}
	
	function get_record_set ( $qry )
	{
		$records = null ;
		if ( $qry != "" )
		{
			$records = mysql_query ( $qry , $this->dbConnection ) or die ( mysql_error ( ) ) ;
			$this->num_records = mysql_num_rows ( $records ) ;
		}
		return $records ;
	}
	
	function records_to_array ( $records )
	{
		$array = null ;
		if ( $records != null )
			while ( $row = mysql_fetch_assoc ( $records ) )
				$array[] = $row ;
		
		mysql_free_result ( $records ) ;
		$records = null ;
		
		return $array ;
	}
	
	function operation_query ( $qry )
	{
		$records = null ;
		if ( $qry != "" )
		{
			$records = mysql_query ( $qry , $this->dbConnection ) or die ( mysql_error ( )."<br>".$qry ) ;
			$this->last_id = mysql_insert_id ( $this->dbConnection ) ;
			
		}
		return $records ;
	}
	
	function connect( )
	{
		// This function Connects to database
		if( $this->dbConnection == null )
		{
			$this->dbConnection=mysql_pconnect( DBSERVER, DBUSERNAME, DBPASSWORD ) or die ( "Database connection cannot be found" ) ;
			mysql_select_db( DBNAME, $this->dbConnection) or die ( "Database cannot be found" ) ;
			//mysql_query ("set character_set_client='utf8'"); 
			//mysql_query ("set character_set_results='utf8'"); 
			//mysql_query ("set collation_connection='utf8_general_ci'"); 
		}
		return $this->dbConnection ;
		
	}
	
	function disconnect( )
	{
		// This function is used to disconnect this connection to database.
		mysql_close( $this->dbConnection ) ;
	}
}	
?>
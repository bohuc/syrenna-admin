<?php


$MYSQL_HOST  = '';
$MYSQL_USER  = '';
$MYSQL_PASS  = '';
$MYSQL_DB    = '';

require_once('configdb.php');

class mymysqli {

    var $link = 0;
    var $debug = 0;
    var $result = 0 ;
    var $last_array = 0;
    
    function mysqli() {
    
	$this->connect();
    
    }
    

    
    function connect($username="UNSET", $password="", $host="localhost", $db="")  {
    
	if ($username == "UNSET") {
	    $username = $GLOBALS["MYSQL_USER"];
	    $password = $GLOBALS["MYSQL_PASS"];
	    $host     = $GLOBALS["MYSQL_HOST"];
	    $db       = $GLOBALS["MYSQL_DB"];
	    	
	}
	
	$this->link = mysqli_connect($host, $username, $password, $db);

	if($this->link) {
	
	    if($db) $this->select($db);
	
	} else {
	    
	    if($this->debug) {
		
		echo mysqli_error(); 
		
	    }
	
	}
    
    }

    function select($db) {
	
	if($this->link) {
	
	    mysqli_select_db($this->link,$db);
	    return 1;
	    
	} else {
	    
	    return 0;
	
	}
		
    
    }
    
    
    function close() {
    
	mysqli_close($this->link);
    
    }

    function error() {
    
	return mysqli_error($this->link);
    
    }

    function errno() {
    
	return mysqli_errno($this->link);
    
    }
    
    function free() {
    
	mysqli_free_result($this->result);
    
    }
    
    
    
    function query($sql, $db="") {
	
	// posto nema vise ove funkcije , onda cemo prvo selektovati pazu pa tek onda imdemo dalje, ako je tako definisano u funkciji da nebi morali menjati kod!
	//if ($db) $this->result =  mysqli_db_query($db, $sql, $this->link);
	if ($db)  $this->select($db);
	else $this->result =  mysqli_query($this->link,$sql);
	return $this->result;
    }    

    function num_rows() {
	
	 $return =  mysqli_num_rows($this->result);	
	return $return;
    
    }
	
	function insert_id() {
	
	 $return =  mysqli_insert_id($this->result);	
	return $return;
    
    }



    function sfetch($sql, $db="") {
	
	
	//if ($db) $this->result =  mysqli_db_query($db, $sql, $this->link);
	if($db) $this->select($db);
	else $this->result =  mysqli_query($this->link,$sql);
	$temp = mysqli_fetch_row($this->result);
	$this->free();
	return $temp[0];

    }    
    
    function afetch($sql, $db="") {
	
	
	//if ($db) $this->result =  mysqli_db_query($db, $sql, $this->link);
	if ($db) $this->select($db);
	else $this->result =  mysqli_query($this->link,$sql);
	$temp = mysqli_fetch_row($this->result);
	$this->free();
	return $temp;
    }

    function afetcha($sql, $db="") {
	
	
	//if ($db) $this->result =  mysqli_db_query($db, $sql, $this->link);
	if ($db) $this->select($db);
	else $this->result =  mysqli_query($this->link,$sql);
	$temp = mysqli_fetch_array($this->result);
	$this->free();
	return $temp;
    }
    
    function fetch_array() {
    
	$this->last_array = mysqli_fetch_array($this->result);
	return $this->last_array;
	
    }
    
    function fetch_assoc(){
	
	$this->last_array = mysqli_fetch_assoc($this->result);
	return $this->last_array;
	}
	
    function fetch_row() {
    
	$this->last_array = mysqli_fetch_row($this->result);
	return $this->last_array;
	
    }

			          
    function row($row_id) {
	
	return $this->last_array[$row_id];	
    
    }
    
    function all_row() {
	
	return $this->last_array;	
    
    }


    function escape($esc) {
	
	return mysqli_real_escape_string($this->link,$esc);
    
    }
    
    function c($esc){

	return $this->escape($esc);

    }
    
}



class db extends mymysqli {

    function db()  {
	global $site_config;
		$this->connect($site_config['mysql']['user'],$site_config['mysql']['pass'],$site_config['mysql']['server'],$site_config['mysql']['datebase']);
		$this->query("SET NAMES utf8");
	    
    }
}


    



		



?>
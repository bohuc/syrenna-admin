<?php


$MYSQL_HOST  = '';
$MYSQL_USER  = '';
$MYSQL_PASS  = '';
$MYSQL_DB    = '';

require_once('config.php');

class mysql {

    var $link = 0;
    var $debug = 0;
    var $result = 0 ;
    var $last_array = 0;
    
    function mysql() {
    
	$this->connect();
    
    }
    

    
    function connect($username="UNSET", $password="", $host="localhost", $db="")  {
    
	if ($username == "UNSET") {
	    $username = $GLOBALS["MYSQL_USER"];
	    $password = $GLOBALS["MYSQL_PASS"];
	    $host     = $GLOBALS["MYSQL_HOST"];
	    $db       = $GLOBALS["MYSQL_DB"];
	    	
	}
	
	$this->link = mysql_connect($host, $username, $password, TRUE);

	if($this->link) {
	
	    if($db) $this->select($db);
	
	} else {
	    
	    if($this->debug) {
		
		echo mysql_error(); 
		
	    }
	
	}
    
    }

    function select($db) {
	
	if($this->link) {
	
	    mysql_select_db($db,$this->link);
	    return 1;
	    
	} else {
	    
	    return 0;
	
	}
		
    
    }
    
    
    function close() {
    
	mysql_close($this->link);
    
    }

    function error() {
    
	return mysql_error($this->link);
    
    }

    function errno() {
    
	return mysql_errno($this->link);
    
    }
    
    function free() {
    
	mysql_free_result($this->result);
    
    }
    
    
    
    function query($sql, $db="") {
	
	
	if ($db) $this->result =  mysql_db_query($db, $sql, $this->link);
	else $this->result =  mysql_query($sql, $this->link);
	return $this->result;

    }    

    function num_rows() {
	
	 $return =  mysql_num_rows($this->result);	
	return $return;
    
    }



    function sfetch($sql, $db="") {
	
	
	if ($db) $this->result =  mysql_db_query($db, $sql, $this->link);
	else $this->result =  mysql_query($sql, $this->link);
	$temp = mysql_fetch_row($this->result);
	$this->free();
	return $temp[0];

    }    
    
    function afetch($sql, $db="") {
	
	
	if ($db) $this->result =  mysql_db_query($db, $sql, $this->link);
	else $this->result =  mysql_query($sql, $this->link);
	$temp = mysql_fetch_row($this->result);
	$this->free();
	return $temp;
    }

    function afetcha($sql, $db="") {
	
	
	if ($db) $this->result =  mysql_db_query($db, $sql, $this->link);
	else $this->result =  mysql_query($sql, $this->link);
	$temp = mysql_fetch_array($this->result);
	$this->free();
	return $temp;
    }
    
    function fetch_array() {
    
	$this->last_array = mysql_fetch_array($this->result);
	return $this->last_array;
	
    }
    
    function fetch_assoc(){
	
	$this->last_array = mysql_fetch_assoc($this->result);
	return $this->last_array;
	}
	
    function fetch_row() {
    
	$this->last_array = mysql_fetch_row($this->result);
	return $this->last_array;
	
    }

			          
    function row($row_id) {
	
	return $this->last_array[$row_id];	
    
    }
    
    function all_row() {
	
	return $this->last_array;	
    
    }


    function escape($esc) {
	
	return mysql_real_escape_string($esc);
    
    }

    function c($esc) {

	return $this->escape($esc);
    
    }
    
}



class db extends mysql {

    function db()  {
	global $site_config;
		$this->connect($site_config['mysql']['user'],$site_config['mysql']['pass'],$site_config['mysql']['server'],$site_config['mysql']['datebase']);
		$this->query("SET NAMES utf8");
	    
    }
}


    



		



?>
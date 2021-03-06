<?php

/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 4932 $
  $LastChangedBy: abbas-ali $
  $Date: 2008-08-28 20:47:20 +0530 (Thu, 28 Aug 2008) $
**********************************************/

/**
 * Database abstraction class
 *
 * This is the db abstraction class for mysql server.
 */
class cpgDB {
    /* public: connection parameters */
    var $Host = '';
    var $Database = '';
    var $User = '';
    var $Password = '';

    /* public: configuration parameters */
    var $Auto_Free = 0; ## Set to 1 for automatic mysql_free_result()
    var $Debug = 0; ## Set to 1 for debugging messages.
    var $Halt_On_Error = 'yes'; ## "yes" (halt with message), "no" (ignore errors quietly), "report" (ignore error, but spit a warning)
    var $Seq_Table = 'db_sequence';

    /* public: result array and current row number */
    var $Record = array();
    var $Row;

    /* public: current error number and error text */
    var $Errno = 0;
    var $Error = '';

    /* public: this is an api revision, not a CVS revision. */
    var $type = 'mysql';

    /* private: link and query handles */
    var $Link_ID = 0;
    var $Query_ID = 0;
	
	/* */
	var $lock_querytime = FALSE;	## when TRUE, cpggetmicrotime not available.
	var $update = FALSE;	## when TRUE, failure of query return no errors;
	var $nodb = FALSE;		## when TRUE, no database name is required in conect function (for install.php)

    /**
     * 
     * @var array $queries
     */
    //var $queries = array();

    //var $query_stats = array();

    /* public: constructor */
    /**
     * cpgDB::cpgDB()
     * 
     * @param string $query 
     * @return 
     */

	function cpgDB($query = "")
    {

    } 

    /**
     * cpgDB::getInstance()
     * 
     * @return 
     */
    function &getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new cpgDB;
        } 

        return ($instance);
    } 

    /* public: some trivial reporting */
    /**
     * cpgDB::linkId()
     * 
     * @return 
     */
    function linkId()
    {
        return $this->Link_ID;
    } 

    function queryId()
    {
        return $this->Query_ID;
    } 

	function connect_to_existing($link)
	{
		$this->Link_ID = $link;
	}
	
	
    /**
     * cpgDB::connect()
     * 
     * @param string $Database
     * @param string $Host
     * @param string $User
     * @param string $Password
     * @return
     */
    function connect($Database = '', $Host = '', $User = '', $Password = '')
    {
        global $CONFIG;
		/* Handle defaults */
        if ('' == $Database)
            $Database = $this->Database;
        if ('' == $Host)
            $Host = $this->Host;
        if ('' == $User)
            $User = $this->User;
        if ('' == $Password)
            $Password = $this->Password;

        /* establish connection, select database */
		if($this->nodb != TRUE) {
			$check_sql_values = " please check the SQL values in include/config.inc.php";
		} else {
			$check_sql_values = '';
		}
        if (0 == $this->Link_ID) {
            $this->Link_ID = mysql_connect($Host, $User, $Password);
            if (!$this->Link_ID) {
                //$this->halt("connect($Host, $User, \$Password) failed.");
				$this->Error = "<hr /><br />Could not create a mySQL connection, $check_sql_values<br /><br />MySQL error was : " . mysql_error() . "<br /><br />";
                return 0;
            } 

            if (!@mysql_select_db($Database, $this->Link_ID) && $this->nodb != TRUE) {
                //$this->halt("cannot use database " . $this->Database);
				$this->Error .= "<hr /><br />mySQL could not locate a database called '{$CONFIG['dbname']}' please check the value entered for this in include/config.inc.php<br /><br />";
                return 0;
            } 
        } 

        return $this->Link_ID;
    } 

    /* public: discard the query result */
    /**
     * cpgDB::free()
     * 
     * @return 
     */
    function free()
    {
        @mysql_free_result($this->Query_ID);
        $this->Query_ID = 0;
    } 

    /* public: perform a query */
    /**
     * cpgDB::query()
     * 
     * @param  $Query_String 
     * @param integer $linkId 
     * @return 
     */
    function query()
    {
    	global $CONFIG, $query_stats, $queries;
		$args = func_get_args();
		$Query_String = array_shift($args);
	    /* No empty queries, please, since PHP4 chokes on them. */
        if ($Query_String == '') {
			/* The empty query string is passed on from the constructor,
			* when calling the class without a query, e.g. in situations
			* like these: '$db = new DB_Sql_Subclass;'
			*/
			$this->Error = "<br />There is no query to execute.<br />";
			$this->Error .= mysql_error();
			return 0;
		}
		if (count($args)) {
			$Query_String = vsprintf($Query_String, $args);
		}
		
        if (!$this->connect()) {
			$this->Error = "<br />Database connection not found.<br />";
			$this->Error .= mysql_error();
            return 0;
            /* we already complained in connect() about that. */
        } ; 
        // New query, discard previous result.
        if ($this->Query_ID) {
            $this->free();
        } 
        
		if ($this->lock_querytime != TRUE) {
			$query_start = cpgGetMicroTime();
		}
 
		$this->Query_ID = @mysql_query($Query_String, $this->Link_ID);
 
        if ($this->lock_querytime != TRUE) {
			$query_end = cpgGetMicroTime();
        }
		
		$this->Row = 0;
        //$this->Errno = mysql_errno();
        //$this->Error = mysql_error();
        if (!$this->Query_ID && $this->update != TRUE) {
            //$this->halt("Invalid SQL: " . $Query_String);
			$this->db_error("Invalid SQL:".$Query_String);
        } 

        if ($this->nf() > 0) {
            $this->nextRecord();
        } 
		if ($this->lock_querytime != TRUE) {
			if (isset($CONFIG['debug_mode']) && (($CONFIG['debug_mode']==1) || ($CONFIG['debug_mode']==2) )) {
				$duration = round($query_end - $query_start, 3);
				$query_stats[] = $duration;
				$queries[] = $Query_String . " ({$duration}s)"; 
			}
		}
		
	//	print_r($this->queries);echo"<br /><br />";
		
        // Will return nada if it fails. That's fine. // '
        return $this->Query_ID;
    } 

    /* public: walk result set */
    /**
     * cpgDB::nextRecord()
     * 
     * @return 
     */
    function nextRecord()
    {
        if (!$this->Query_ID && $this->update != TRUE) {
            $this->halt('nextRecord called with no query pending.');
            return 0;
        } 

        if ($this->update != TRUE) {
            $this->Record = @mysql_fetch_array($this->Query_ID, MYSQL_ASSOC);
            $this->Row += 1;
            $this->Errno = mysql_errno();
            $this->Error = mysql_error();
		}

        $stat = is_array($this->Record);
        if (!$stat && $this->Auto_Free) {
            $this->free();
        } 
        return $stat;
    } 

    /**
     * cpgDB::fetchRow()
     * 
     * @return 
     */
    function fetchRow()
    {
        $row = $this->Record;
        $this->nextRecord();
        return ($row);
    } 

    /**
     * cpgDB::fetchRowSet()
     * 
     * @return 
     */
    function fetchRowSet()
    {
        $rowset = array();
		if (!$this->Record) 
		{
			return $rowset;
		}
        do {
            $rowset[] = $this->Record;
        } while ($this->nextRecord());

        return ($rowset);
    } 

    /* public: position in result set */
    /**
     * cpgDB::seek()
     * 
     * @param integer $pos 
     * @return 
     */
    function seek($pos = 0)
    {
        $status = @mysql_data_seek($this->Query_ID, $pos);
        if ($status) {
            $this->Row = $pos;
            $this->nextRecord();
        } else {
            $this->halt("seek($pos) failed: result has " . $this->numRows() . " rows");

            /* half assed attempt to save the day,
       * but do not consider this documented or even
       * desireable behaviour.
       */
            @mysql_data_seek($this->Query_ID, $this->numRows());
            $this->Row = $this->numRows;
            return 0;
        } 

        return 1;
    } 

    /* public: table locking */
    /**
     * cpgDB::lock()
     * 
     * @param  $table 
     * @param string $mode 
     * @return 
     */
    function lock($table, $mode = 'write')
    {
        $this->connect();

        $query = 'lock tables ';
        if (is_array($table)) {
            while (list($key, $value) = each($table)) {
                if ($key == 'read' && $key != 0) {
                    $query .= "$value read, ";
                } else {
                    $query .= "$value $mode, ";
                } 
            } 
            $query = substr($query, 0, -2);
        } else {
            $query .= "$table $mode";
        } 
        $res = @mysql_query($query, $this->Link_ID);
        if (!$res) {
            $this->halt("lock($table, $mode) failed.");
            return 0;
        } 
        return $res;
    } 

    /**
     * cpgDB::unlock()
     * 
     * @return 
     */
    function unlock()
    {
        $this->connect();

        $res = @mysql_query("unlock tables", $this->Link_ID);
        if (!$res) {
            $this->halt('unlock() failed.');
            return 0;
        } 
        return $res;
    } 

    /* public: evaluate the result (size, width) */
    /**
     * cpgDB::affectedRows()
     * 
     * @return 
     */
    function affectedRows()
    {
        return @mysql_affected_rows($this->Link_ID);
    } 

    /**
     * cpgDB::numRows()
     * 
     * @return 
     */
    function numRows()
    {
        return @mysql_num_rows($this->Query_ID);
    } 

    /**
     * cpgDB::numFields()
     * 
     * @return 
     */
    function numFields()
    {
        return @mysql_num_fields($this->Query_ID);
    } 

    /* public: shorthand notation */
    /**
     * cpgDB::nf()
     * 
     * @return 
     */
    function nf()
    {
        return $this->numRows();
    } 

    /**
     * cpgDB::np()
     * 
     * @return 
     */
    function np()
    {
        print $this->numRows();
    } 

    /**
     * cpgDB::f()
     * 
     * @param  $Name 
     * @return 
     */
    function f($Name)
    {
        return $this->Record[$Name];
    } 

    /**
     * cpgDB::p()
     * 
     * @param  $Name 
     * @return 
     */
    function p($Name)
    {
        print $this->Record[$Name];
    } 

    /* public: sequence numbers */
    /**
     * cpgDB::nextid()
     * 
     * @param  $seq_name 
     * @return 
     */
    function nextid($seq_name)
    {
        $this->connect();

        if ($this->lock($this->Seq_Table)) {
            /* get sequence number (locked) and increment */
            $q = sprintf("select nextid from %s where seq_name = '%s'",
                $this->Seq_Table,
                $seq_name);
            $id = @mysql_query($q, $this->Link_ID);
            $res = @mysql_fetch_array($id, MYSQL_ASSOC);

            /* No current value, make one */
            if (!is_array($res)) {
                $currentid = 0;
                $q = sprintf("insert into %s values('%s', %s)",
                    $this->Seq_Table,
                    $seq_name,
                    $currentid);
                $id = @mysql_query($q, $this->Link_ID);
            } else {
                $currentid = $res["nextid"];
            } 
            $nextid = $currentid + 1;
            $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'",
                $this->Seq_Table,
                $nextid,
                $seq_name);
            $id = @mysql_query($q, $this->Link_ID);
            $this->unlock();
        } else {
            $this->halt("cannot lock " . $this->Seq_Table . " - has it been created?");
            return 0;
        } 
        return $nextid;
    } 

 /**
 * cpg_db_error()
 *
 * Error message if a query failed
 *
 * @param $the_error
 * @return
 **/

	function db_error($the_error)
	{
		global $CONFIG,$lang_errors;
		print($the_error);
		if ($CONFIG['debug_mode'] === '0' || (!GALLERY_ADMIN_MODE)) {
			cpg_die(CRITICAL_ERROR, $lang_errors['database_query'], __FILE__, __LINE__);
		} else {
				$the_error .= "\n\nMySQL error: ".mysql_error()."\n";
				$out = "<br />".$lang_errors['database_query'].".<br /><br/>
					<form name=\"mysql\" id=\"mysql\"><textarea rows=\"8\" cols=\"60\">".htmlspecialchars($the_error)."</textarea></form>";
			cpg_die(CRITICAL_ERROR, $out, __FILE__, __LINE__);
		}
	}


    /* private: error handling */
    /**
     * cpgDB::halt()
     *
     * @param  $msg
     * @return
     */
    function halt($msg)
    {
        $this->Error = @mysql_error($this->Link_ID);
        $this->Errno = @mysql_errno($this->Link_ID);
        if ($this->Halt_On_Error == 'no')
            return;

        $this->haltmsg($msg);

        if ($this->Halt_On_Error != 'report')
            die('Session halted.');
    }

    /**
     * cpgDB::haltmsg()
     *
     * @param  $msg
     * @return
     */
    function haltmsg($msg)
    {
        printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
        printf("<b>MySQL Error</b>: %s (%s)<br>\n",
            $this->Errno,
            $this->Error);
    }

    /**
     * cpgDB::tableNames()
     *
     * @return
     */
    function tableNames()
    {
        $this->query("SHOW TABLES");
        $i = 0;
        while ($info = mysql_fetch_row($this->Query_ID)) {
            $return[$i]['table_name'] = $info[0];
            $return[$i]['tablespace_name'] = $this->Database;
            $return[$i]['database'] = $this->Database;
            $i++;
        }
        return $return;
    }

    /**
     * insertId()
     *
     * Used to return id of last inserted row
     *
     * return $id
     */
    function insertId()
    {
      return (int)mysql_insert_id($this->Link_ID);
    }
	
//  function to return datetime in UNIX_TIMESTAMP
	function timestamp($datetime_var ='')
	{
		return "UNIX_TIMESTAMP($datetime_var)";
	}

	/**
	//closes the non-persistent connection 
	*cpgDB :: close () 
	*/
	function close($link='')
	{
		if ($link == '') {
			$link = $this->Link_ID;
		}
		mysql_close($link);
	}


	/**
	//closes the non-persistent connection 
	*cpgDB :: close () 
	*/
	function escape($str_to_escape)
	{
		//if (get_magic_quotes_gpc()) {
		//	$str_to_escape = stripslashes($str_to_escape);
		//}
		if (defined('INSTALL_PHP') || defined('UPDATE_PHP')) {
			return addslashes($str_to_escape);
		} else {
			return mysql_real_escape_string($str_to_escape);
		}
	}
	
	function removeQuotes($str)
	{
		return $str;
	}

	/**
	// returns the database list
	*cpgDB :: ListDbs ()
	*/
	function ListDbs()
	{
		$db_list = array();
		$list_query = mysql_list_dbs();
		while ($row = mysql_fetch_object($list_query)) {
			$db_list[] = $row->Database;
		}
		return $db_list;
	}


	function getLimits($limit1, $limit2)
	{
		$limit = '';
		$limit = ($limit1 != -1) ? ' LIMIT '. $limit1 : '';
		$limit.= ($limit2 != -1) ? ' ,'. $limit2 : '';	
		return $limit;
	}


	function getFullTableNames($database, $prefix, $table)
	{
		return '`'.$database.'`.'.$prefix.''.$table;
	}
}


?>

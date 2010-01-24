<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

/**
 * 
 * Database Driver & Active Record Class
 *
 */

class Database {
    
    // driver
    var $username;
    var $password;
    var $hostname;
    var $database;
    var $dbdriver        = 'mysql';
    var $dbprefix        = '';
    var $port            = '';
    var $pconnect        = FALSE;
    var $query_count     = 0;
    var $bind_marker     = '?';
    var $conn_id         = FALSE;
    var $result_id       = FALSE;
    var $queries         = array();
    // mysql
    var $delete_hack = TRUE;
    // active record
    var $ar_select       = array();
    var $ar_distinct     = FALSE;
    var $ar_from         = array();
    var $ar_join         = array();
    var $ar_where        = array();
    var $ar_like         = array();
    var $ar_groupby      = array();
    var $ar_having       = array();
    var $ar_limit        = FALSE;
    var $ar_offset       = FALSE;
    var $ar_order        = FALSE;
    var $ar_orderby      = array();
    var $ar_set          = array();
    
    /**
     * Constructor.  Accepts one parameter containing the database
     * connection settings.
     *
     * Database settings can be passed as discreet
     * parameters or as a data source name in the first
     * parameter. DSNs must have this prototype:
     * $dsn = 'driver://username:password@hostname/database';
     *
     * @param mixed. Can be an array or a DSN string
     */                              
    function Database($params = '') {            
        $this->initialize($params); 
    }
    
    // --------------------------------------------------------------------
    /**
     * Skeleton pattern.  
     *
     * Database settings can be passed as discreet
     * parameters or as a data source name in the first
     * parameter. DSNs must have this prototype:
     * $dsn = 'driver://username:password@hostname/database';
     *
     * @param mixed. Can be an array or a DSN string
     */     
    function & getInstance($param = '') {
        static $instance = array();
        if (!$instance) {    
            $instance[0] = & new Database($param);
        } 
        return $instance[0];
    }
        
    // --------------------------------------------------------------------
    
    /**
     * Initialize Database Settings
     *
     * @access    private Called by the constructor
     * @param    mixed
     * @return    void
     */    
    function initialize($params = '') {
        if (is_array($params)) {
            $defaults = array(
                'hostname'    => '',
                'username'    => '',
                'password'    => '',
                'database'    => '',
                'conn_id'     => FALSE,
                'dbdriver'    => 'mysql',
                'dbprefix'    => '',
                'port'        => '',
                'pconnect'    => FALSE,
            );        
            foreach ($defaults as $key => $val) {
                $this->$key = (!isset($params[$key])) ? $val : $params[$key];
            }
        } elseif (strpos($params, '://')) {
            if (FALSE === ($dsn = @parse_url($params))) {
                $this->display_error('db_invalid_connection_str');
                return FALSE;            
            }            
            $this->hostname = (!isset($dsn['host'])) ? '' : rawurldecode($dsn['host']);
            $this->username = (!isset($dsn['user'])) ? '' : rawurldecode($dsn['user']);
            $this->password = (!isset($dsn['pass'])) ? '' : rawurldecode($dsn['pass']);
            $this->database = (!isset($dsn['path'])) ? '' : rawurldecode(substr($dsn['path'], 1));
        }        
        // If an existing DB connection resource is supplied
        // there is no need to connect and select the database
        if (is_resource($this->conn_id)) {
            return TRUE;
        }        
        // Connect to the database
        $this->conn_id = ($this->pconnect == FALSE) ? $this->db_connect() : $this->db_pconnect();

        // No connection?  Throw an error
        if (!$this->conn_id) {
            $this->display_error('db_unable_to_connect');            
            return FALSE;
        }
        // Select the database
        if ($this->database != '') {
            if (!$this->db_select()) {
                $this->display_error('db_unable_to_select', $this->database);                
                return FALSE;
            }
        }

        return TRUE;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Non-persistent database connection
     *
     * @access    private called by the base class
     * @return    resource
     */    
    function db_connect() {
        return @mysql_connect($this->hostname, $this->username, $this->password, TRUE);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Persistent database connection
     *
     * @access    private called by the base class
     * @return    resource
     */        
    function db_pconnect() {
        return @mysql_pconnect($this->hostname, $this->username, $this->password);
    }    
    
    // --------------------------------------------------------------------

    /**
     * Select the database
     *
     * @access    private called by the base class
     * @return    resource
     */        
    function db_select() {
        return @mysql_select_db($this->database, $this->conn_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Close DB Connection
     *
     * @access    public
     * @return    void        
     */        
    function close() {
        if (is_resource($this->conn_id)) {
            @mysql_close($this->conn_id);
        }
        $this->conn_id = FALSE;
    }
    
    // --------------------------------------------------------------------

    /**
     * Database Version Number.  Returns a string containing the
     * version of the database being used
     *
     * @access    public
     * @return    string    
     */    
    function platform() {
        return $this->dbdriver;
    }
    
    // --------------------------------------------------------------------

    /**
     * Version number query string
     *
     * @access    public
     * @return    string
     */
    function version() {
        $sql = "SELECT version() AS ver";   
        $query = $this->query($sql);
        $row = $query->row();
        return $row->ver;
    }
    
    // --------------------------------------------------------------------

    /**
     * Execute the query
     *
     * Accepts an SQL string as input and returns a result object upon
     * successful execution of a "read" type query.  Returns boolean TRUE
     * upon successful execution of a "write" type query. Returns boolean
     * FALSE upon failure.
     *
     * @access    public
     * @param    string    An SQL query string
     * @param    array    An array of binding data
     * @return    mixed        
     */      
    function query($sql, $binds = FALSE, $return_object = TRUE) {        
        if ($sql == '') {
            $this->display_error('db_invalid_query');            
            return FALSE;        
        }      
        // Save the query
        $this->queries[] = $sql;        
        // Run the Query
        if (FALSE === ($this->result_id = $this->simple_query($sql))) {
            return $this->display_error(
                array(
                    'Error Number: '.mysql_errno($this->conn_id),
                    mysql_error($this->conn_id),
                    $sql
                )
            );                
            return FALSE;
        }        
        // Increment the query counter
        $this->query_count++;        
        // Was the query a "write" type?
        // If so we'll simply return true
        if ($this->is_write_type($sql) === TRUE) {
            return TRUE;
        }        
        // Return TRUE if we don't need to create a result object
        // Currently only the Oracle driver uses this when stored
        // procedures are used
        if ($return_object !== TRUE) {
            return TRUE;
        }    
        // Load and instantiate the result driver
        $RES             = new DatabaseResult();
        $RES->conn_id    = $this->conn_id;
        $RES->result_id  = $this->result_id;        
        return $RES;        
    }
    
    // --------------------------------------------------------------------

    /**
     * Simple Query
     * This is a simplified version of the query() function.  Internally
     * we only use it when running transaction commands since they do
     * not require all the features of the main query() function.
     *
     * @access    public
     * @param    string    the sql query
     * @return    mixed        
     */    
    function simple_query($sql) {        
        $sql = $this->_prep_query($sql);
        return @mysql_query($sql, $this->conn_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Affected Rows
     *
     * @access    public
     * @return    integer
     */
    function affected_rows() {
        return @mysql_affected_rows($this->conn_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Insert ID
     *
     * @access    public
     * @return    integer
     */
    function insert_id(){
        return @mysql_insert_id($this->conn_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Generate an update string
     *
     * @access    public
     * @param    string    the table upon which the query will be performed
     * @param    array    an associative array data of key/values
     * @param    mixed    the "where" statement
     * @return    string        
     */
    function update_string($table, $data, $where) {
        if ($where == '') return false;                    
        $fields = array();
        foreach($data as $key => $val) {
            $fields[$key] = $this->escape($val);
        }
        if (!is_array($where)) {
            $dest = array($where);
        } else {
            $dest = array();
            foreach ($where as $key => $val) {
                $prefix = (count($dest) == 0) ? '' : ' AND ';    
                if ($val != '') {
                    if (!$this->_has_operator($key)) {
                        $key .= ' =';
                    }                
                    $val = ' '.$this->escape($val);
                }                            
                $dest[] = $prefix.$key.$val;
            }
        }    
        foreach($fields as $key => $val) {
            $valstr[] = $key." = ".$val;
        }    
        return "UPDATE ".$this->_escape_table($this->dbprefix.$table)." SET ".implode(', ', $valstr)." WHERE ".implode(" ", $dest);
        
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Generate an insert string
     *
     * @access    public
     * @param    string    the table upon which the query will be performed
     * @param    array    an associative array data of key/values
     * @return    string        
     */
    function insert_string($table, $data) {
        $fields = array();    
        $values = array();        
        foreach($data as $key => $val) {
            $fields[] = $key;
            $values[] = $this->escape($val);
        }
        return "INSERT INTO ".$this->_escape_table($this->dbprefix.$table)." (".implode(', ', $fields).") VALUES (".implode(', ', $values).")";
    }
    
    /**
     * Insert statement
     *
     * Generates a platform-specific insert string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the insert keys
     * @param   array   the insert values
     * @return  string
     */
    function _insert($table, $keys, $values) {
        return "INSERT INTO ".$this->_escape_table($table)." (".implode(', ', $keys).") VALUES (".implode(', ', $values).")";
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Update statement
     *
     * Generates a platform-specific update string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the update data
     * @param   array   the where clause
     * @return  string
     */
    function _update($table, $values, $where) {
        foreach($values as $key => $val) {
            $valstr[] = $key." = ".$val;
        }
        return "UPDATE ".$this->_escape_table($table)." SET ".implode(', ', $valstr)." WHERE ".implode(" ", $where);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * List table query
     *
     * Generates a platform-specific query string so that the table names can be fetched
     *
     * @access  private
     * @return  string
     */
    function _list_tables() {
        return "SHOW TABLES FROM `".$this->database."`";
    }
    
    // --------------------------------------------------------------------

    /**
     * Show column query
     *
     * Generates a platform-specific query string so that the column names can be fetched
     *
     * @access  public
     * @param   string  the table name
     * @return  string
     */
    function _list_columns($table = '') {
        return "SHOW COLUMNS FROM ".$this->_escape_table($table);
    }

    // --------------------------------------------------------------------

    /**
     * Field data query
     *
     * Generates a platform-specific query so that the column data can be retrieved
     *
     * @access  public
     * @param   string  the table name
     * @return  object
     */
    function _field_data($table) {
        return "SELECT * FROM ".$this->_escape_table($table)." LIMIT 1";
    }

    // --------------------------------------------------------------------

    /**
     * The error message string
     *
     * @access  private
     * @return  string
     */
    function _error_message() {
        return mysql_error($this->conn_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * The error message number
     *
     * @access  private
     * @return  integer
     */
    function _error_number() {
        return mysql_errno($this->conn_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Escape Table Name
     *
     * This function adds backticks if the table name has a period
     * in it. Some DBs will get cranky unless periods are escaped
     *
     * @access    private
     * @param    string    the table name
     * @return    string
     */    
    function _escape_table($table) {
        if (stristr($table, '.')) {
            $table = preg_replace("/\./", "`.`", $table);
        }        
        return $table;
    }
    
    // --------------------------------------------------------------------

    /**
     * Delete statement
     *
     * Generates a platform-specific delete string from the supplied data
     *
     * @access    public
     * @param    string    the table name
     * @param    array    the where clause
     * @return    string
     */
    function _delete($table, $where) {
        return "DELETE FROM ".$this->_escape_table($table)." WHERE ".implode(" ", $where);    
    }
    
    // --------------------------------------------------------------------

    /**
     * Limit string
     *
     * Generates a platform-specific LIMIT clause
     *
     * @access  public
     * @param   string  the sql query string
     * @param   integer the number of rows to limit the query to
     * @param   integer the offset value
     * @return  string
     */
    function _limit($sql, $limit, $offset) {
        if ($offset == 0) {
            $offset = '';
        } else {
            $offset .= ", ";
        }
        return $sql."LIMIT ".$offset.$limit;
    }
    
    // --------------------------------------------------------------------

    /**
     * Prep the query
     *
     * If needed, each database adapter can prep the query string
     *
     * @access    private called by execute()
     * @param    string    an SQL query
     * @return    string
     */    
    function _prep_query($sql) {
        // "DELETE FROM TABLE" returns 0 affected rows This hack modifies
        // the query so that it returns the number of affected rows
        if ($this->delete_hack === TRUE) {
            if (preg_match('/^\s*DELETE\s+FROM\s+(\S+)\s*$/i', $sql)) {
                $sql = preg_replace("/^\s*DELETE\s+FROM\s+(\S+)\s*$/", "DELETE FROM \\1 WHERE 1=1", $sql);
            }
        }        
        return $sql;
    }
    
    // --------------------------------------------------------------------

    /**
     * Compile Bindings
     *
     * @access    public
     * @param    string    the sql statement
     * @param    array    an array of bind data
     * @return    string        
     */
    function compile_binds($sql, $binds) {    
        if (FALSE === strpos($sql, $this->bind_marker)) {
            return $sql;
        }
        
        if (! is_array($binds)) {
            $binds = array($binds);
        }
        
        foreach ($binds as $val) {
            $val = $this->escape($val);                    
            // Just in case the replacement string contains the bind
            // character we'll temporarily replace it with a marker
            $val = str_replace($this->bind_marker, '{%bind_marker%}', $val);
            $sql = preg_replace("#".preg_quote($this->bind_marker, '#')."#", str_replace('$', '\$', $val), $sql, 1);
        }
        return str_replace('{%bind_marker%}', $this->bind_marker, $sql);        
    }
    
    // --------------------------------------------------------------------

    /**
     * Determines if a query is a "write" type.
     *
     * @access    public
     * @param    string    An SQL query string
     * @return    boolean        
     */    
    
    function is_write_type($sql) {
        if (!preg_match('/^\s*"?(INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|LOAD DATA|COPY|ALTER|GRANT|REVOKE|LOCK|UNLOCK)\s+/i', $sql)) {
            return FALSE;
        }
        return TRUE;
    }
    
    // --------------------------------------------------------------------

    /**
     * Returns the total number of queries
     *
     * @access    public
     * @return    integer        
     */    
    function total_queries() {
        return $this->query_count;
    }
    
    // --------------------------------------------------------------------

    /**
     * Returns the last query that was executed
     *
     * @access    public
     * @return    void        
     */    
    function last_query() {
        return end($this->queries);
    }
    
    // --------------------------------------------------------------------

    /**
     * Primary
     *
     * Retrieves the primary key.  It assumes that the row in the first
     * position is the primary key
     *
     * @access    public
     * @param    string    the table name
     * @return    string        
     */    
    function primary($table = '') {    
        $fields = $this->list_fields($table);        
        if (!is_array($fields)) {
            return FALSE;
        }
        return current($fields);
    }

    // --------------------------------------------------------------------

    /**
     * Returns an array of table names
     *
     * @access    public
     * @return    array        
     */    
    function list_tables() {
        $sql = "SHOW TABLES FROM `".$this->database."`";
        $retval = array();
        $query = $this->query($sql);        
        if ($query->num_rows() > 0) {
            foreach($query->result_array() as $row) {
                if (isset($row['TABLE_NAME'])) {
                    $retval[] = $row['TABLE_NAME'];
                } else {
                    $retval[] = array_shift($row);
                }
            }
        }
        return $retval;
    }
    
    // --------------------------------------------------------------------

    /**
     * Fetch MySQL Field Names
     *
     * @access    public
     * @param    string    the table name
     * @return    array        
     */
    function list_fields($table = '') {
        if ($table == '') {
            $this->display_error('db_field_param_missing');            
            return FALSE;            
        }        
        if (FALSE === ($sql = $this->_list_columns($this->dbprefix.$table))) {
            $this->display_error('db_unsupported_function');
            return FALSE;        
        }        
        $query = $this->query($sql);        
        $retval = array();
        foreach($query->result_array() as $row) {
            if (isset($row['COLUMN_NAME'])) {
                $retval[] = $row['COLUMN_NAME'];
            } else {
                $retval[] = current($row);
            }        
        }        
        return $retval;
    }
    
    // --------------------------------------------------------------------

    /**
     * "Smart" Escape String
     *
     * Escapes data based on type
     * Sets boolean and null types
     *
     * @access    public
     * @param    string
     * @return    integer        
     */
    function escape($str) {    
        switch (gettype($str)) {
            case 'string'   :   $str = "'".$this->escape_str($str)."'";
                break;
            case 'boolean'  :   $str = ($str === FALSE) ? 0 : 1;
                break;      
            default         :   $str = ($str === NULL) ? 'NULL' : $str;
                break;
        }
        return $str;
    }
    
    // --------------------------------------------------------------------

    /**
     * Determine if a particular field exists
     * @access    public
     * @param    string
     * @param    string
     * @return    boolean
     */    
    function field_exists($field_name, $table_name) {    
        return (!in_array($field_name, $this->list_fields($table_name))) ? FALSE : TRUE;
    }
        
    // --------------------------------------------------------------------

    /**
     * DEPRECATED - use list_fields()
     */    
    function field_names($table = '') {    
        return $this->list_fields($table);
    }
    
    // --------------------------------------------------------------------

    /**
     * Returns an object with field data
     *
     * @access    public
     * @param    string    the table name
     * @return    object        
     */        
    function field_data($table = '') {
        if ($table == '') {
            $this->display_error('db_field_param_missing');            
            return FALSE;            
        }        
        $query = $this->query($this->_field_data($this->dbprefix.$table));
        return $query->field_data();
    } 
       
    // --------------------------------------------------------------------

    /**
     * Escape String
     *
     * @access    public
     * @param    string
     * @return    string
     */    
    function escape_str($str) {    
        if (get_magic_quotes_gpc()) {
            return $str;
        }
        if (function_exists('mysql_real_escape_string')) {
            return mysql_real_escape_string($str, $this->conn_id);
        } elseif (function_exists('mysql_escape_string')) {
            return mysql_escape_string($str);
        } else {
            return addslashes($str);
        }
    }
    
    // --------------------------------------------------------------------

    /**
     * Display Error
     *
     * @access    public
     * @param    mixed
     * @return    void
     */    
    function display_error($error) {
        if (is_array($error)) {
            print_r($error);   
        } else {
            echo $error;
        }
        exit;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Select
     *
     * Generates the SELECT portion of the query
     *
     * @access    public
     * @param    string
     * @return    object
     */
    function select($select = '*') {
        if (is_string($select)) {
            $select = explode(',', $select);
        }    
        foreach ($select as $val) {
            $val = trim($val);        
            if ($val != '')
                $this->ar_select[] = $val;
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * DISTINCT
     *
     * Sets a flag which tells the query string compiler to add DISTINCT
     *
     * @access    public
     * @param    bool
     * @return    object
     */
    function distinct($val = TRUE) {
        $this->ar_distinct = (is_bool($val)) ? $val : TRUE;
        return $this;
    }   
    
    // --------------------------------------------------------------------

    /**
     * From
     *
     * Generates the FROM portion of the query
     *
     * @access    public
     * @param    mixed    can be a string or array
     * @return    object
     */
    function from($from) {
        foreach ((array)$from as $val) {
            $this->ar_from[] = $this->dbprefix.$val;
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * Join
     *
     * Generates the JOIN portion of the query
     *
     * @access    public
     * @param    string
     * @param    string    the join condition
     * @param    string    the type of join
     * @return    object
     */
    function join($table, $cond, $type = '') {        
        if ($type != '') {
            $type = strtoupper(trim($type));
            if (!in_array($type, array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER'), TRUE)) {
                $type = '';
            } else {
                $type .= ' ';
            }
        }
        if ($this->dbprefix) {
            $cond = preg_replace('|([\w\.]+)([\W\s]+)(.+)|', $this->dbprefix . "$1$2" . $this->dbprefix . "$3", $cond);
        }        
        // If a DB prefix is used we might need to add it to the column names
        if ($this->dbprefix) {
            // First we remove any existing prefixes in the condition to avoid duplicates
            $cond = preg_replace('|('.$this->dbprefix.')([\w\.]+)([\W\s]+)|', "$2$3", $cond);            
            // Next we add the prefixes to the condition
            $cond = preg_replace('|([\w\.]+)([\W\s]+)(.+)|', $this->dbprefix . "$1$2" . $this->dbprefix . "$3", $cond);
        }        
        $this->ar_join[] = $type.'JOIN '.$this->dbprefix.$table.' ON '.$cond;
        return $this;
    }
     
    // --------------------------------------------------------------------

    /**
     * Where
     *
     * Generates the WHERE portion of the query. Separates
     * multiple calls with AND
     *
     * @access    public
     * @param    mixed
     * @param    mixed
     * @return    object
     */   
    function where($key, $value = NULL) {
        return $this->_where($key, $value, 'AND ');
    }
        
    // --------------------------------------------------------------------

    /**
     * OR Where
     *
     * Generates the WHERE portion of the query. Separates
     * multiple calls with OR
     *
     * @access    public
     * @param    mixed
     * @param    mixed
     * @return    object
     */
    function orwhere($key, $value = NULL) {
        return $this->_where($key, $value, 'OR ');
    }    
    
    // --------------------------------------------------------------------

    /**
     * Where
     *
     * Called by where() or orwhere()
     *
     * @access    private
     * @param    mixed
     * @param    mixed
     * @param    string
     * @return    object
     */
    function _where($key, $value = NULL, $type = 'AND ') {
        if (!is_array($key)) {
            $key = array($key => $value);
        }          
        foreach ($key as $k => $v) {
            $prefix = (count($this->ar_where) == 0) ? '' : $type;            
            if (!is_null($v)) {
                if (!$this->_has_operator($k)) {
                    $k .= ' =';
                }            
                $v = ' '.$this->escape($v);
            }                        
            $this->ar_where[] = $prefix.$k.$v;
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * Like
     *
     * Generates a %LIKE% portion of the query. Separates
     * multiple calls with AND
     *
     * @access    public
     * @param    mixed
     * @param    mixed
     * @return    object
     */
    function like($field, $match = '') {
        return $this->_like($field, $match, 'AND ');
    }    
    
    // --------------------------------------------------------------------

    /**
     * OR Like
     *
     * Generates a %LIKE% portion of the query. Separates
     * multiple calls with OR
     *
     * @access    public
     * @param    mixed
     * @param    mixed
     * @return    object
     */
    function orlike($field, $match = '') {
        return $this->_like($field, $match, 'OR ');
    }
    
    // --------------------------------------------------------------------

    /**
     * Like
     *
     * Called by like() or orlike()
     *
     * @access    private
     * @param    mixed
     * @param    mixed
     * @param    string
     * @return    object
     */
    function _like($field, $match = '', $type = 'AND ') {
        if (!is_array($field)) {
            $field = array($field => $match);
        }     
        foreach ($field as $k => $v) {
            $prefix = (count($this->ar_like) == 0) ? '' : $type;            
            $v = $this->escape_str($v);                                    
            $this->ar_like[] = $prefix." $k LIKE '%{$v}%'";
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * GROUP BY
     *
     * @access    public
     * @param    string
     * @return    object
     */
    function groupby($by) {
        if (is_string($by)) {
            $by = explode(',', $by);
        }    
        foreach ($by as $val) {
            $val = trim($val);        
            if ($val != '')
                $this->ar_groupby[] = $val;
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * Sets the HAVING value
     *
     * Separates multiple calls with AND
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    object
     */
    function having($key, $value = '') {
        return $this->_having($key, $value, 'AND ');
    }
    
    // --------------------------------------------------------------------

    /**
     * Sets the OR HAVING value
     *
     * Separates multiple calls with OR
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    object
     */
    function orhaving($key, $value = '') {
        return $this->_having($key, $value, 'OR ');
    }    
    
    // --------------------------------------------------------------------

    /**
     * Sets the HAVING values
     *
     * Called by having() or orhaving()
     *
     * @access    private
     * @param    string
     * @param    string
     * @return    object
     */
    function _having($key, $value = '', $type = 'AND ') {
        if (!is_array($key)) {
            $key = array($key => $value);
        }    
        foreach ($key as $k => $v) {
            $prefix = (count($this->ar_having) == 0) ? '' : $type;            
            if ($v != '') {
                $v = ' '.$this->escape($v);
            }            
            $this->ar_having[] = $prefix.$k.$v;
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * Sets the ORDER BY value
     *
     * @access    public
     * @param    string
     * @param    string    direction: asc or desc
     * @return    object
     */
    function orderby($orderby, $direction = '') {
        if (trim($direction) != '') {
            $direction = (in_array(strtoupper(trim($direction)), array('ASC', 'DESC', 'RAND()'), TRUE)) ? ' '.$direction : ' ASC';
        }        
        $this->ar_orderby[] = $orderby.$direction;
        return $this;
    }   
    
    // --------------------------------------------------------------------

    /**
     * Sets the LIMIT value
     *
     * @access    public
     * @param    integer    the limit value
     * @param    integer    the offset value
     * @return    object
     */
    function limit($value, $offset = '') {
        $this->ar_limit = $value;        
        if ($offset != '')
            $this->ar_offset = $offset;        
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * Sets the OFFSET value
     *
     * @access    public
     * @param    integer    the offset value
     * @return    object
     */
    function offset($value) {
        $this->ar_offset = $value;
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * The "set" function.  Allows key/value pairs to be set for inserting or updating
     *
     * @access    public
     * @param    mixed
     * @param    string
     * @return    object
     */
    function set($key, $value = '', $escape = TRUE) {
        $key = $this->_object_to_array($key);    
        if (!is_array($key)) {
            $key = array($key => $value);
        }
        foreach ($key as $k => $v){
            if ($escape) {
                $this->ar_set[$k] = $this->escape($v);
            } else {
                $this->ar_set[$k] = $v;
            }
        }
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * Get
     *
     * Compiles the select statement based on the other functions called
     * and runs the query
     *
     * @access    public
     * @param    string    the limit clause
     * @param    string    the offset clause
     * @return    object
     */
    function get($table = '', $limit = null, $offset = null) {
        if ($table != '') {
            $this->from($table);
        }        
        if (!is_null($limit)){
            $this->limit($limit, $offset);
        }            
        $sql = $this->_compile_select();
        $result = $this->query($sql);
        $this->_reset_select();
        return $result;
    }

    // --------------------------------------------------------------------

    /**
     * GetWhere
     *
     * Allows the where clause, limit and offset to be added directly
     *
     * @access    public
     * @param    string    the where clause
     * @param    string    the limit clause
     * @param    string    the offset clause
     * @return    object
     */
    function getwhere($table = '', $where = null, $limit = null, $offset = null) {
        if ($table != '') {
            $this->from($table);
        }
        if (!is_null($where)){
            $this->where($where);
        }        
        if (!is_null($limit)) {
            $this->limit($limit, $offset);
        }            
        $sql = $this->_compile_select();
        $result = $this->query($sql);
        $this->_reset_select();
        return $result;
    }
    
    // --------------------------------------------------------------------

    /**
     * Insert
     *
     * Compiles an insert string and runs the query
     *
     * @access    public
     * @param    string    the table to retrieve the results from
     * @param    array    an associative array of insert values
     * @return    object
     */
    function insert($table = '', $set = NULL) {
        if (!is_null($set)) {        
            $this->set($set);
        }    
        if (count($this->ar_set) == 0) {            
            $this->display_error('db_must_use_set');            
            return FALSE;
        }
        if ($table == '') {
            if (!isset($this->ar_from[0])) {
                $this->display_error('db_must_set_table');
                return FALSE;
            }            
            $table = $this->ar_from[0];
        }                    
        $sql = $this->_insert($this->dbprefix.$table, array_keys($this->ar_set), array_values($this->ar_set));        
        $this->_reset_write();
        return $this->query($sql);        
    }
    
    // --------------------------------------------------------------------

    /**
     * Update
     *
     * Compiles an update string and runs the query
     *
     * @access    public
     * @param    string    the table to retrieve the results from
     * @param    array    an associative array of update values
     * @param    mixed    the where clause
     * @return    object
     */
    function update($table = '', $set = NULL, $where = null) {
        if (!is_null($set)) {
            $this->set($set);
        }    
        if (count($this->ar_set) == 0) {
            $this->display_error('db_must_use_set');
            return FALSE;
        }
        if ($table == '') {
            if (!isset($this->ar_from[0])) {
                return $this->display_error('db_must_set_table');
                return FALSE;
            }            
            $table = $this->ar_from[0];
        }        
        if ($where != null) {
            $this->where($where);
        }        
        $sql = $this->_update($this->dbprefix.$table, $this->ar_set, $this->ar_where);        
        $this->_reset_write();
        return $this->query($sql);
    }
    
    // --------------------------------------------------------------------

    /**
     * Delete
     *
     * Compiles a delete string and runs the query
     *
     * @access    public
     * @param    string    the table to retrieve the results from
     * @param    mixed    the where clause
     * @return    object
     */
    function delete($table = '', $where = '') {
        if ($table == '') {
            if (!isset($this->ar_from[0])) {
                $this->display_error('db_must_set_table');
                return FALSE;
            }            
            $table = $this->ar_from[0];
        }
        if ($where != '') {
            $this->where($where);
        }
        if (count($this->ar_where) == 0) {
            $this->display_error('db_del_must_use_where');
            return FALSE;
        }        
        $sql = $this->_delete($this->dbprefix.$table, $this->ar_where);
        $this->_reset_write();
        return $this->query($sql);
    }
    
    // --------------------------------------------------------------------

    /**
     * Use Table - DEPRECATED
     *
     * @deprecated    use $this->db->from instead
     */
    function use_table($table) {
        return $this->from($table);
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
     * ORDER BY - DEPRECATED
     *
     * @deprecated    use $this->db->orderby() instead
     */
    function order_by($orderby, $direction = '') {
        return $this->orderby($orderby, $direction);
    }
    
    // --------------------------------------------------------------------

    /**
     * Tests whether the string has an SQL operator
     *
     * @access    private
     * @param    string
     * @return    bool
     */
    function _has_operator($str) {
        $str = trim($str);
        if (!preg_match("/(\s|<|>|!|=|is null|is not null)/i", $str)) {
            return FALSE;
        }
        return TRUE;
    }
    
    // --------------------------------------------------------------------

    /**
     * Compile the SELECT statement
     *
     * Generates a query string based on which functions were used.
     * Should not be called directly.  The get() function calls it.
     *
     * @access    private
     * @return    string
     */
    function _compile_select() {
        $sql = (!$this->ar_distinct) ? 'SELECT ' : 'SELECT DISTINCT ';    
        $sql .= (count($this->ar_select) == 0) ? '*' : implode(', ', $this->ar_select);
        if (count($this->ar_from) > 0) {
            $sql .= "\nFROM ";
            $sql .= implode(', ', $this->ar_from);
        } 
        if (count($this->ar_join) > 0) {
            $sql .= "\n";
            $sql .= implode("\n", $this->ar_join);
        }
        if (count($this->ar_where) > 0 OR count($this->ar_like) > 0) {
            $sql .= "\nWHERE ";
        }
        $sql .= implode("\n", $this->ar_where);        
        if (count($this->ar_like) > 0) {
            if (count($this->ar_where) > 0) {
                $sql .= " AND ";
            }
            $sql .= implode("\n", $this->ar_like);
        }        
        if (count($this->ar_groupby) > 0) {
            $sql .= "\nGROUP BY ";
            $sql .= implode(', ', $this->ar_groupby);
        }        
        if (count($this->ar_having) > 0) {
            $sql .= "\nHAVING ";
            $sql .= implode("\n", $this->ar_having);
        }
        if (count($this->ar_orderby) > 0) {
            $sql .= "\nORDER BY ";
            $sql .= implode(', ', $this->ar_orderby);            
            if ($this->ar_order !== FALSE) {
                $sql .= ($this->ar_order == 'desc') ? ' DESC' : ' ASC';
            }        
        }        
        if (is_numeric($this->ar_limit)) {
            $sql .= "\n";
            $sql = $this->_limit($sql, $this->ar_limit, $this->ar_offset);
        }
        return $sql;
    }

    // --------------------------------------------------------------------

    /**
     * Object to Array
     *
     * Takes an object as input and converts the class variables to array key/vals
     *
     * @access    public
     * @param    object
     * @return    array
     */
    function _object_to_array($object) {
        if (!is_object($object)) {
            return $object;
        }        
        $array = array();
        foreach (get_object_vars($object) as $key => $val) {
            if (!is_object($val) AND !is_array($val)) {
                $array[$key] = $val;
            }
        }    
        return $array;
    }
    
    // --------------------------------------------------------------------

    /**
     * Resets the active record values.  Called by the get() function
     *
     * @access    private
     * @return    void
     */
    function _reset_select() {
        $this->ar_select      = array();
        $this->ar_distinct    = FALSE;
        $this->ar_from        = array();
        $this->ar_join        = array();
        $this->ar_where       = array();
        $this->ar_like        = array();
        $this->ar_groupby     = array();
        $this->ar_having      = array();
        $this->ar_limit       = FALSE;
        $this->ar_offset      = FALSE;
        $this->ar_order       = FALSE;
        $this->ar_orderby     = array();
    }    
    
    // --------------------------------------------------------------------

    /**
     * Resets the active record "write" values.
     *
     * Called by the insert() or update() functions
     *
     * @access    private
     * @return    void
     */
    function _reset_write() {
        $this->ar_set         = array();
        $this->ar_from        = array();
        $this->ar_where       = array();
    }
}

/**
 * Database Result Class
 *
 * This is the platform-independent result class.
 * This class will not be called directly. Rather, the adapter
 * class for the specific database will extend and instantiate it.
 *
 * @category    Database
 * @author        Rick Ellis
 * @link        http://www.codeigniter.com/user_guide/database/
 */ 

class DatabaseResult {

    var $conn_id         = NULL;
    var $result_id       = NULL;
    var $result_array    = array();
    var $result_object   = array();
    var $current_row     = 0;
    var $num_rows        = 0;
    
    /**
     * Query result.  Acts as a wrapper function for the following functions.
     *
     * @access    public
     * @param    string    can be "object" or "array"
     * @return    mixed    either a result object or array    
     */
    function result($type = 'object') {    
        return ($type == 'object') ? $this->result_object() : $this->result_array();
    }

    // --------------------------------------------------------------------

    /**
     * Query result.  "object" version.
     *
     * @access    public
     * @return    object
     */
    function result_object() {
        if (count($this->result_object) > 0) {
            return $this->result_object;
        }
        if ($this->result_id === FALSE OR $this->num_rows() == 0) {
            return array();
        }
        $this->_data_seek(0);
        while ($row = $this->_fetch_object()) {
            $this->result_object[] = $row;
        }        
        return $this->result_object;
    }    
    
    // --------------------------------------------------------------------

    /**
     * Query result.  "array" version.
     *
     * @access    public
     * @return    array
     */
    function result_array() {
        if (count($this->result_array) > 0) {
            return $this->result_array;
        }
        // In the event that query caching is on the result_id variable 
        // will return FALSE since there isn't a valid SQL resource so 
        // we'll simply return an empty array.
        if ($this->result_id === FALSE OR $this->num_rows() == 0) {
            return array();
        }
        $this->_data_seek(0);            
        while ($row = $this->_fetch_assoc()) {
            $this->result_array[] = $row;
        }        
        return $this->result_array;
    }

    // --------------------------------------------------------------------

    /**
     * Query result.  Acts as a wrapper function for the following functions.
     *
     * @access    public
     * @param    string    can be "object" or "array"
     * @return    mixed    either a result object or array    
     */
    function row($n = 0, $type = 'object') {
        return ($type == 'object') ? $this->row_object($n) : $this->row_array($n);
    }

    // --------------------------------------------------------------------

    /**
     * Returns a single result row - object version
     *
     * @access    public
     * @return    object
     */
    function row_object($n = 0) {
        $result = $this->result_object();        
        if (count($result) == 0) {
            return $result;
        }
        if ($n != $this->current_row AND isset($result[$n])) {
            $this->current_row = $n;
        }
        return $result[$this->current_row];
    }

    // --------------------------------------------------------------------

    /**
     * Returns a single result row - array version
     *
     * @access    public
     * @return    array
     */
    function row_array($n = 0) {
        $result = $this->result_array();
        if (count($result) == 0) {
            return $result;
        }            
        if ($n != $this->current_row AND isset($result[$n])) {
            $this->current_row = $n;
        }        
        return $result[$this->current_row];
    }
        
    // --------------------------------------------------------------------

    /**
     * Returns the "first" row
     *
     * @access    public
     * @return    object
     */
    function first_row($type = 'object') {
        $result = $this->result($type);
        if (count($result) == 0) {
            return $result;
        }
        return $result[0];
    }
    
    // --------------------------------------------------------------------

    /**
     * Returns the "last" row
     *
     * @access    public
     * @return    object
     */
    function last_row($type = 'object') {
        $result = $this->result($type);
        if (count($result) == 0) {
            return $result;
        }
        return $result[count($result) -1];
    }    

    // --------------------------------------------------------------------

    /**
     * Returns the "next" row
     *
     * @access    public
     * @return    object
     */
    function next_row($type = 'object') {
        $result = $this->result($type);
        if (count($result) == 0) {
            return $result;
        }
        if (isset($result[$this->current_row + 1])) {
            ++$this->current_row;
        }                
        return $result[$this->current_row];
    }    
    
    // --------------------------------------------------------------------

    /**
     * Returns the "previous" row
     *
     * @access    public
     * @return    object
     */
    function previous_row($type = 'object') {
        $result = $this->result($type);
        if (count($result) == 0) {
            return $result;
        }
        if (isset($result[$this->current_row - 1])) {
            --$this->current_row;
        }
        return $result[$this->current_row];
    }
    
    // --------------------------------------------------------------------

    /**
     * Number of rows in the result set
     *
     * @access    public
     * @return    integer
     */
    function num_rows() { 
        return @mysql_num_rows($this->result_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Number of fields in the result set
     *
     * @access    public
     * @return    integer
     */
    function num_fields() { 
        return @mysql_num_fields($this->result_id); 
    }
    
    // --------------------------------------------------------------------

    /**
     * Fetch Field Names
     *
     * Generates an array of column names
     *
     * @access    public
     * @return    array
     */
    function list_fields() { 
        $field_names = array();
        while ($field = mysql_fetch_field($this->result_id)) {
            $field_names[] = $field->name;
        }        
        return $field_names;     
    }
    // Deprecated
    function field_names() { 
        return $this->list_fields();  
    }

    // --------------------------------------------------------------------

    /**
     * Field data
     *
     * Generates an array of objects containing field meta-data
     *
     * @access    public
     * @return    array
     */
    function field_data() { 
        $retval = array();
        while ($field = mysql_fetch_field($this->result_id)) {    
            $F                = new stdClass();
            $F->name         = $field->name;
            $F->type         = $field->type;
            $F->default        = $field->def;
            $F->max_length    = $field->max_length;
            $F->primary_key = $field->primary_key;            
            $retval[] = $F;
        }        
        return $retval;
    }
    
    // --------------------------------------------------------------------

    /**
     * Free the result
     *
     * @return    null
     */      
    function free_result() { 
        if (is_resource($this->result_id)) {
            mysql_free_result($this->result_id);
            $this->result_id = FALSE;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Data Seek
     *
     * Moves the internal pointer to the desired offset.  We call
     * this internally before fetching results to make sure the
     * result set starts at zero
     *
     * @access    private
     * @return    array
     */
    function _data_seek($n = 0) { 
        return mysql_data_seek($this->result_id, $n);    
    }

    // --------------------------------------------------------------------

    /**
     * Result - associative array
     *
     * Returns the result set as an array
     *
     * @access    private
     * @return    array
     */
    function _fetch_assoc() { 
        return mysql_fetch_assoc($this->result_id);
    }
    
    // --------------------------------------------------------------------

    /**
     * Result - object
     *
     * Returns the result set as an object
     *
     * @access    private
     * @return    object
     */   
    function _fetch_object() { 
        return mysql_fetch_object($this->result_id);
    }
    
}
<?php
/*
 * PHP library for all global functions in CPG
 * @author xnitingupta
 */

/**
 * Class for user related functions
 */
class globalfunctions {

  /* Fetches and updates the configuration parameters from database
   * @ CONFIG
   * @ return CONFIG
   */
  function getconfig ($CONFIG) {
    global $DBS;
    $sql =  "SELECT name, value FROM {$DBS->configtable}";
    $results = $DBS->sql_query($sql);

    for ($i=0; $i < mysql_numrows($results); $i++) {
       $CONFIG[mysql_result($results, $i, "name")] = mysql_result($results, $i, "value");
    }
    return $CONFIG;
  }

  /* Updates the configuration parameters into the database
   * @ CONFIG
   * @ return CONFIG
   */
  function setconfig ($CONFIG) {
    global $DISPLAY, $DBS;

    for($i=0; $i < count($DISPLAY->configfields); $i++) {
       $sql = "UPDATE {$DBS->configtable} SET value='" . $CONFIG[$DISPLAY->configfields[$i]] . "' WHERE name='" . $DISPLAY->configfields[$i] . "'";
       $DBS->sql_update($sql);
    }
  }
}

?>
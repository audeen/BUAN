<?php


// https://www.evoluted.net/thinktank/web-development/time-saving-database-functions

// $form_data für Admins

$form_data_admin = array(
    'id_a' => $id_a,
    'a_blocked' => $a_blocked,
    'a_name' => $a_name,
    'a_pw' => $a_pw,
    'a_saved' => $a_saved,
    'time' => time()
);



//Form_data für Händler

$form_data_retailer = array(
    'id_r' => $id_r,
    'r_blocked' => $r_blocked,
    'r_name' => $r_name,
    'r_mail' => $r_mail,
    'r_pw' => $r_pw,
    'r_street' => $r_street,
    'email' => $email,
    'r_city' => $r_city,
    'r_postal' => $r_postal,
    'r_saved' => $r_saved,
    'time' => time()
);

function dbRowInsert($table_name, $form_data)
{
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";

    // run and return the query result resource
    return mysql_query($sql);
}

// again where clause is left optional
function dbRowUpdate($table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;

    // run and return the query result
    return mysql_query($sql);
}
?>
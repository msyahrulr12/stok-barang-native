<?php

require_once __DIR__.'/config/db.php';

session_start();


function dd($var) {
    var_dump($var);
    die();
}

function getResult($query) {
    return mysqli_fetch_assoc($query);
}

function redirect($page) {
    header(sprintf('Location: %s', $page));
}

/**
 * =============================
 * Authentication
 * =============================
 */

function login($username, $password) {
    global $connection;

    $sql = sprintf("SELECT * FROM users WHERE username = '%s' AND password = '%s'", $username, md5($password));

    $query = mysqli_query($connection, $sql);

    $result = getResult($query);

    if ($result) {
        // set session auth
        $_SESSION['auth'] = $result;

        return true;
    } else {
        return false;
    }
}

function register($data) {
    $sql = sprintf("INSERT INTO users VALUES name = '%s', email = '%s', username = '%s', password = '%s', phone_number = '%s', role = '%s'", $data['name'], $data['email'], $data['username'], $data['password'], $data['phone_number'], $data['role']);

    return $sql;
}

function logout() {
    unset($_SESSION);
    session_destroy();
}


function joinTable($typeJoin, $table, $tableKey, $refTable, $refTableKey) {
    $query = "$typeJoin $refTable
    ON $table.$tableKey = $refTable.$refTableKey";

    return $query;
}


function findAll($table, $column = "*", $additional = null) {
    global $connection;

    $sql = "SELECT $column FROM $table";

    if ($additional != null) {
        $sql .= " ".$additional;
    }
    
    $query = mysqli_query($connection, $sql);
    
    $data = [];
    while ($result = getResult($query)) {
        $data[] = $result;
    }
    return $data;
}

function findOneBy($table, $filter) {
    global $connection;
    if (!is_array($filter)) {
        return 'Not an array';
    }

    $column = array_keys($filter);
    $value = array_values($filter);

    $sql = sprintf("SELECT * FROM %s WHERE %s = %s", $table, $column[0], $value[0]);

    $query = mysqli_query($connection, $sql);

    $result = getResult($query);
    return $result;
}

function findBy($table, $filter) {
    if (!is_array($filter)) {
        return 'Not an array';
    }

    $column = array_keys($filter);
    $value = array_values($filter);

    $sql = "SELECT * FROM $table WHERE $column[0] = $value[0]";
}

function create($table, $datas) {
    global $connection;

    $column = "";
    $data_value = "";
    foreach  ($datas as $key => $value) {
        if (is_integer($value)) {
            $val_string = "%d";
        } else {
            $val_string = "'%s'";
        }
        
        $column .= $key.", ";
        $data_value .= sprintf("$val_string, ", $value);
    }

    $column = substr($column, 0, strlen($column) - 2);
    $data_value = substr($data_value, 0, strlen($data_value) - 2);

    $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $column, $data_value);

    $query = mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection)) {
        return true;
    } else {
        return false;
    }
}

function update($table, $datas, $where) {
    global $connection;
    
    $column_value = "";
    foreach ($datas as $key => $value) {
        if (is_integer($value)) {
            $val_string = "%d";
        } else {
            $val_string = "'%s'";
        }

        $column_value .= sprintf("%s = $val_string, ", $key, $value);
    }

    $where_column = array_keys($where);
    $where_value = array_values($where);
    $where_value_type = is_integer($where_value[0]) ? "%d" : "'%s'";

    
    $sql = sprintf("UPDATE %s SET %s", $table, $column_value);
    $sql = substr($sql, 0, strlen($sql) - 2);
    $sql .= sprintf(" WHERE $where_column[0] = $where_value_type", $where_value[0]);
    
    $query = mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection)) {
        return true;
    } else {
        return false;
    }
    
}

function delete($table, $where) {
    global $connection;

    $where_column = array_keys($where);
    $where_value = array_values($where);
    $where_value_type = is_integer($where_value[0]) ? "%d" : "'%s'";
    
    $sql = sprintf("DELETE FROM %s WHERE %s = $where_value_type", $table, $where_column[0], $where_value[0]);
    
    $query = mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection)) {
        return true;
    } else {
        return false;
    }
}

?>
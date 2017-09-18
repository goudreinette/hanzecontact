<?php

/**
 * Represents a database table, it's columns and CRUD actions.
 */
class Resource
{
    function __construct($table, $options)
    {
        global $mysqli;

        $this->mysqli     = $mysqli;

        $this->table      = $table;
        $this->lowercase  = strtolower($this->table);
        $this->singular   = substr($this->lowercase, 0, -1);

        $this->showInList = $options['showInList'];
        $this->labels     = $options['labels'];
        $this->columns    = $mysqli->query("DESCRIBE $table")->fetch_all();
        $this->pk         = $this->findPk($this->columns);
    }


    /**
     * Display functions
     */
    function display()
    {
        $orderBy = $_GET['order'] ?? $this->showInList[0];
        $result = $this->mysqli->query("SELECT * FROM $this->table ORDER BY {$orderBy}");
        include "templates/show.php";
    }

    function displayAdd()
    {
        $columnNames = $this->columnNames();
        include "templates/add.php";
    }

    function displayEdit()
    {

        $sql = "SELECT * FROM $this->table WHERE `$this->pk` = {$_GET['id']}";
        $result = $this->mysqli->query($sql);
        if($row = $result->fetch_assoc()) {
            $row = escapeArray($row); // alle slashes weghalen
            $columnNames = $this->columnNames();
            include "templates/edit.php";
        }
        else {
            die("Geen gegevens gevonden");
        }
    }


    /**
     * CRUD functions
     */
    function insert()
    {
        $columnValues = $this->getPostColumnValues();
        $sql = "INSERT INTO `$this->table` {$this->columnNameString()}
                VALUES {$this->columnValuesString($columnValues)}";

        $this->mysqli->query($sql);
        $this->returnToResource();
    }

    function update()
    {
        $columnValues = $this->getPostColumnValues();
        $sql = "UPDATE `$this->table` SET {$this->columnSetString($columnValues)}
                WHERE `$this->pk` = {$_POST[$this->pk]}";
        $this->mysqli->query($sql);
        $this->returnToResource();
    }

    function delete()
    {
        $sql = "DELETE FROM `$this->table` WHERE `$this->pk` = {$_GET['id']}";
        $this->mysqli->query($sql);
        $this->returnToResource();
    }

    function returnToResource()
    {
        header("location: index.php?action=$this->lowercase"); // terugkeren naar jobs
        exit();
    }


    /**
     * Column Helpers
     */
    function findPk($columns)
    {
        return array_filter($columns, function($column) {
            return $column[3] == 'PRI';
        })[0][0];
    }

    function columnNames()
    {
        $names     = array_column($this->columns, 0);
        $withoutPk = array_diff($names, [$this->pk]);
        return $withoutPk;
    }

    function columnNameString()
    {
        return $this->tupleString($this->columnNames());
    }

    function tupleString($array)
    {
        return "(" . implode(',', $array) . ")";
    }

    function columnSetString($values)
    {
        $withAssigments = array_map(function ($columnName) use ($values) {
            return "$columnName = '{$values[$columnName]}'";
        }, $this->columnNames());

        return implode(',', $withAssigments);
    }

    function columnValuesString($values)
    {
        return $this->tupleString(array_map(function ($val){
            return "'$val'";
        }, $values));
    }

    function getPostColumnValues()
    {
        return array_intersect_key($_POST, array_flip($this->columnNames()));
    }
}

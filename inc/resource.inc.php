<?php



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
        $result = $this->mysqli->query("SELECT * FROM $this->table");

        echo "
            <h1>$this->table</h1>
            <br/>
            <input type='button' onclick='document.location.href=\"?action=add$this->singular\"' value='Toevoegen' />
            <br/>
            <br/>

            <table>";


        echo "<tr>";
        foreach ($this->showInList as $column)
            echo "<th>{$this->labels[$column]}</th>";
        echo "<th>Actie</th>";
        echo "</tr>";


        while($row = $result->fetch_assoc()) {
            $row = escapeArray($row); // alle slashes weghalen
            echo"<tr>";
            foreach ($this->showInList as $column)
                echo"<td>".$row[$column]."</td>";
            echo"<td>
                    <a href=\"index.php?action=editjob&id=".$row[$this->pk]."\">Bewerken</a>
                    |
                    <a href=\"javascript:confirmAction('Zeker weten?', 'index.php?action=deletejob&id=".$row[$this->pk]."');\">Verwijderen</a>
                </td>
            </tr>";
        }

        echo"</table>";
    }

    function displayAdd()
    {
        echo"
        <h1>Baan bewerken</h1>
        <form method=\"post\" action=\"index.php?action=insertjob\">
             <table>";
        $this->displayInputFields();
        $this->displaySubmitButton();
        echo"</table>
        </form>";
    }

    function displayEdit()
    {

        $sql = sprintf( "SELECT * FROM $this->table WHERE `$this->pk` = %d",
                        $this->mysqli->escape_string($_GET['id']) );

        $result = $this->mysqli->query($sql);

        if($row = $result->fetch_assoc()) {

            $row = escapeArray($row); // alle slashes weghalen

            echo"<h1>Baan bewerken</h1>
             <form method=\"post\" action=\"index.php?action=updatejob\">
                 <table>";
            $this->displayInputFields($row);
            $this->displaySubmitButton();
            echo"</table>
                 <input type=\"hidden\" name=\"JobID\" value=\"".$row[$this->pk]."\" />
             </form>";
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

        // Letop we maken gebruik van sprintf. Kijk op php.net voor meer info.
        // Binnen sprintf staat %s voor een string, %d voor een decimaal (integer) en %f voor een float

        $sql = sprintf("INSERT INTO `$this->table` {$this->columnNameString()} VALUES  ('%s', '%f', '%f')",
                        $this->mysqli->escape_string($_POST['JobTitle']),
                        $this->mysqli->escape_string($_POST['MinSalary']),
                        $this->mysqli->escape_string($_POST['MaxSalary']) );

        $this->mysqli->query($sql);
        $this->returnToResource();
    }

    function update()
    {
        $sql = sprintf("UPDATE `Jobs` SET {$this->columnSetString()}
                        WHERE `$this->pk` = %d",
                        $this->mysqli->escape_string($_POST['JobTitle']),
                        $this->mysqli->escape_string($_POST['MinSalary']),
                        $this->mysqli->escape_string($_POST['MaxSalary']),
                        $this->mysqli->escape_string($_POST['JobID']) );

        $this->mysqli->query($sql);
        $this->returnToResource();
    }

    function delete()
    {
        $sql = sprintf("DELETE FROM `$this->table`
                        WHERE `$this->pk` = %d",
                        $this->mysqli->escape_string($_GET['id']));
        $this->mysqli->query($sql);
        $this->returnToResource();
    }

    function returnToResource()
    {
        header("location: index.php?action=$this->lowercase"); // terugkeren naar jobs
        exit();
    }

    /**
     * Views
     */
    function displayInputFields($values = [])
    {
         foreach ($this->columnNames() as $columnName) {
             $label = $this->labels[$columnName] ?? $columnName;
             echo"		<tr>";
             echo"			<td>{$label}:</td>";
             echo"			<td><input type=\"text\" name=\"$columnName\" value='$values[$columnName]'/></td>";
             echo"		</tr>";
         }
    }

    function displaySubmitButton()
    {
        echo "<tr>
            <td></td>
            <td><input type=\"submit\" value=\"Opslaan\" /></td>
        </tr>";
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
        return "(" . implode(',', $this->columnNames()) . ")";
    }

    function columnSetString()
    {
        $withAssigments = array_map(function ($columnName) {
            return "$columnName = '%s'";
        }, $this->columnNames());

        return implode(',', $withAssigments);
    }
}

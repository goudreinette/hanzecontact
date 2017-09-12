<?php



class Resource
{

    function __construct($table, $labels)
    {
        global $mysqli;

        $this->mysqli = $mysqli;
        $this->table = $table;
        $this->labels = $labels;
        $this->columns = $mysqli->query("DESCRIBE $table")->fetch_all();
    }


    /**
     * Display functions
     */
    function display()
    {
        $result = $this->mysqli->query("SELECT * FROM $this->table");

        echo "
            <h1>Banen</h1>
            <br/>
            <input type='button' onclick='document.location.href='?action=addjob';' value='Baan toevoegen' />
            <br/>
            <br/>

            <table>";


        echo "<tr>";
        foreach ($this->labels as $column => $label)
            echo "<th>{$label}</th>";
        echo "<th>Actie</th>";
        echo "</tr>";


        while($row = $result->fetch_assoc()) {
            $row = escapeArray($row); // alle slashes weghalen
            echo"<tr>";
            foreach ($this->labels as $column => $label) {
                echo"<td>".$row[$column]."</td>";
            }
            echo"<td>
                    <a href=\"index.php?action=editjob&id=".$row['JobID']."\">Bewerken</a>
                    |
                    <a href=\"javascript:confirmAction('Zeker weten?', 'index.php?action=deletejob&id=".$row['JobID']."');\">Verwijderen</a>
                </td>
            </tr>";
        }

        echo"</table>";
    }

    function displayAdd()
    {

    }

    function displayEdit()
    {

    }


    /**
     * CRUD functions
     */
    function add()
    {

    }

    function update()
    {

    }

    function delete()
    {

    }
}

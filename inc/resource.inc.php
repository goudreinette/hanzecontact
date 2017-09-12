<?php



class Resource
{

    function __construct($table)
    {
        global $mysqli;

        $this->mysqli = $mysqli;
        $this->table = $table;
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

            <table>
                <tr>
                     <th>Titel</td>;
                     <th>Minimum salaris</td>
                     <th>Maximum salaris</td>
                     <th>Actie</td>
                </tr>";


        while($row = $result->fetch_assoc()) {
            $row = escapeArray($row); // alle slashes weghalen

            echo"	<tr>";
            echo"		<td>".$row['JobTitle']."</td>";
            echo"		<td>".$row['MinSalary']."</td>";
            echo"		<td>".$row['MaxSalary']."</td>";
            echo"		<td>";
            echo"			<a href=\"index.php?action=editjob&id=".$row['JobID']."\">Bewerken</a>";
            echo"			|";
            echo"			<a href=\"javascript:confirmAction('Zeker weten?', 'index.php?action=deletejob&id=".$row['JobID']."');\">Verwijderen</a>";
            echo"		</td>";
            echo"	</tr>";
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

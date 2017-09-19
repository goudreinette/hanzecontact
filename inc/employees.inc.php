<?

/**
 * A resource with a special 'image' field.
 */
class Employees extends Resource
{
    public $table = 'Employees';
    public $lowercase = 'employees';
    public $singular = 'employee';
    public $pk = 'EmployeeID';
    public $showInList = ['FirstName', 'LastName'];
    public $labels = [
        'Employees' => 'Mederwerker',
        'employee' => 'Medewerker',
        'FirstName' => 'Voornaam',
        'LastName' => 'Achternaam'
    ];

    function __construct()
    {
        global $mysqli;
        $this->mysqli = $mysqli;
    }

    function displayAdd()
    {
        $columnNames = $this->columnNames();
        include "templates/add_employee.php";
    }

    function displayEdit()
    {
        $sql = "SELECT * FROM $this->table WHERE `$this->pk` = {$_GET['id']}";
        $result = $this->mysqli->query($sql);
        if($row = $result->fetch_assoc()) {
            $row = escapeArray($row); // alle slashes weghalen
            $columnNames = $this->columnNames();
            include "templates/edit_employee.php";
        }
        else {
            die("Geen gegevens gevonden");
        }
    }

    function afterInsert($id)
    {
        $this->setImage($id);
    }

    function afterUpdate($id)
    {
        $this->setImage($id);
    }

    function setImage($id)
    {
        $file_name = $_FILES['Picture']['name'];
        $file_tmp =  $_FILES['Picture']['tmp_name'];

        move_uploaded_file($file_tmp, "pictures/".$file_name);

        $sql = "UPDATE $this->table SET Picture = '$file_name' WHERE `$this->pk` = $id";
        $this->mysqli->query($sql);
    }

    function columnNames()
    {
        return [
            'FirstName',
            'LastName',
            'Email',
            'PhoneNumber',
            'HireDate',
            'JobID',
            'Salary',
            'CommissionPCT',
            'ManagerID',
            'DepartmentID'
        ];
    }
}

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
        'FirstName' => 'Voornaam',
        'LastName' => 'Achternaam'
    ];

    function __construct()
    {
        global $mysqli;
        $this->mysqli = $mysqli;
    }

    function display()
    {
        $orderBy = $_GET['order'] ?? $this->showInList[0];
        $result = $this->mysqli->query("SELECT * FROM $this->table ORDER BY {$orderBy}");
        include "templates/show.php";
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

    function insert()
    {
        $_POST['Picture'] = $_FILES['Picture']['name'];


        $columnValues = $this->getPostColumnValues();
        $sql = "INSERT INTO `$this->table` {$this->columnNameString()}
                VALUES {$this->columnValuesString($columnValues)}";

        $this->mysqli->query($sql);
        $this->setImage($this->mysqli->insert_id);
        $this->returnToResource();
    }

    function update()
    {

    }

    function deleteImage($id)
    {
        $sql = "SELECT * FROM $this->table WHERE `$this->pk` = $id";
        $result = $this->mysqli->query($sql)->fetch_assoc();
        $file_name = $result['Picture'];
        unlink("pictures/$file_name");
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

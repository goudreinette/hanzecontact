<?

/**
 * A resource with a special 'image' field.
 */
class Employees extends AResource
{
    public $table = 'Employees';
    public $lowercase = 'employees';
    public $singular = 'employee';
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
        include "templates/add_employee.php";
    }

    function displayEdit()
    {
        include "templates/edit_employee.php";
    }

    function insert()
    {
        $_POST['Picture'] = $_FILES['Picture']['name'];
        $columnValues = $this->getPostColumnValues();
        $sql = "INSERT INTO `$this->table` {$this->columnNameString()}
                VALUES {$this->columnValuesString($columnValues)}";

        $this->mysqli->query($sql);
        $this->setImage();
        // $this->returnToResource();
    }

    function update()
    {

    }

    function delete()
    {

    }

    function deleteImage()
    {
        $sql = "SELECT * FROM $this->table WHERE `$this->pk` = {$_POST[$this->pk]}";
        $result = $this->mysqli->query($sql)->fetch_assoc();
        $path = $result['Picture'];
        unlink("pictures/$path");
    }

    function setImage()
    {
        $this->deleteImage();
        $file_name = $_FILE['Picture']['name'];
        $file_tmp =  $_FILE['Picture']['tmp_name'];

        move_uploaded_file($file_tmp,"pictures/".$file_name);

        $sql = "UPDATE $this->table SET Picture = $file_name WHERE `$this->pk` = {$_POST[$this->pk]}";
    }
}

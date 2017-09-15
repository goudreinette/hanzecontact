<?

/**
 * A resource with a special 'image' field.
 */
class Employees extends Resource
{
    function __construct()
    {
        parent::__construct('Employees', [
             'showInList' => ['FirstName', 'LastName', 'Salary'],
             'labels' => [
                 'FirstName' => 'Voornaam',
                 'LastName' => 'Achternaam',
                 'Salary' => 'Salaris'
             ]
        ]);
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

    }

    function update()
    {

    }

    function delete()
    {

    }

    function deleteImage()
    {

    }

    function setImage()
    {

    }
}

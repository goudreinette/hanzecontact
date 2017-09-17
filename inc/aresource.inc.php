<?


abstract class AResource
{
    public $lowercase;
    public $singular;
    public $table;
    public $showInList;

    // Views
    abstract function display();
    abstract function displayAdd();
    abstract function displayEdit();

    // Actions
    abstract function insert();
    abstract function update();
    abstract function delete();
}

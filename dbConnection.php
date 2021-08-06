<?php
class Mydb{
    private $userName;
    private $hostName;
    private $password;
    private $dbName;
    public $conObject = null;
    function __construct($dbParam = null){
        $this->userName = "root";
        $this->hostName = "localhost";
        $this->password = '';
        $this->dbName = $dbParam;
    }
    public function connect(){
        $this->conObject = mysqli_connect($this->hostName,$this->userName,$this->password,$this->dbName);
        if(!$this->conObject){
            return false;
        }else
        return true;
    }
    public function selectAll($tableName){
        $this->connect();
        $sql = 'SELECT * FROM '.$tableName.'';
        $results = mysqli_query($this->conObject , $sql);
        if($results){
            if(mysqli_num_rows($results) > 0){
                return $results;
            }
        }else
        // var_dump($results);
        return false;
    }
}
// $test = new Mydb('register');
// $test->connect();
// $data = $test->insertData('personalinfo');
// var_dump($data); 
// while($row = mysqli_fetch_assoc($data)){
//      var_dump($row);
// }
?>
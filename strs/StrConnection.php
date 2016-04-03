<?php
$user = strtolower($_POST['dbUserName']);
$pswr = strtolower($_POST['dbPassword']);

$str_connection = "<?php
namespace DAO;
class Connection {

 public static \$con;

 public function getCon(){

    try{
        
        self::\$con = new \PDO('mysql:host=localhost;dbname=".strtolower($_POST['dbName'])."', '".$user."', '".$pswr."');
        self::\$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return self::\$con;
    }catch(PDOException \$ex){
        echo \$ex->getMessage();
    }


 }

}";

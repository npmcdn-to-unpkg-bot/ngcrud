<?php

//DAO userDAO.php

$str_dao_user = "<?php \n".

"namespace DAO;\n\n".

"class userDAO extends \DAO\AbstractDAO{\n\n".
"   public function __construct(){\n".
"       \$this->setTableName('".$_POST['dbPrefixTable']."user');\n".
"       \$this->setPK('id');\n".
"   }\n\n".
"   /**\n".
"    * @param \model\User \$user\n".
"   **/\n".
"   public function populate(\$user){\n".
"    \$row['firstname']    = \$user->getFirstName();\n".
"    \$row['lastname']     = \$user->getLastName();\n".
"    \$row['email']         = \$user->getEmail();\n".
"    \$row['active']        = \$user->getActive();\n\n".
"    return \$row;\n".
"   }\n\n".
"   public function hydrate(\$row){\n".
"       \$user = new \model\User();\n\n".
"       \$user->setId(\$row['id']);\n".
"       \$user->setFirstName(\$row['firstname']);\n".
"       \$user->setLastName(\$row['lastname']);\n".
"       \$user->setEmail(\$row['email']);\n".
"       \$user->setActive(\$row['active']);\n".
"       return \$user;\n".
"   }\n".
"}";

$str_dao_generate = "<?php
namespace DAO;

class GenerateDAO extends Connection{
    
    public function generate(\$prefix){

       \$sql = 'CREATE TABLE `'.\$prefix.'user` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        active TINYINT
       )';
        \$stmt = \$this->getCon()->prepare(\$sql);
        \$return = \$stmt->execute();
        if(\$return != FALSE){
            return true;
        } else {
            return false;
        }
    }
}
";
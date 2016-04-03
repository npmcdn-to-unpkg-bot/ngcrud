<?php

$str_generate_action = "<?php
include 'autoload.php';

\$generateDAO = new \\DAO\\GenerateDAO();
\$user 		  = new \\model\\User();
\$userDAO	  = new \\DAO\\UserDAO();
switch(\$_POST['action']){
	
	case 'generate':
		try{
				\$return = \$generateDAO->generate(\$_POST['prefixTable']);
				if(\$return == true){
					\$user->setFirstName('Jhon');
					\$user->setLastName('Nobody');
					\$user->setEmail('j-nobody@email.com');
					\$user->setActive(true);
					\$returnUser = \$userDAO->toinsert(\$user);
				}
				echo (\$returnUser == true)?'true':'false';
			}catch(Exception \$ex){
				echo \$ex->getMessage();
			}
		break;
}

";
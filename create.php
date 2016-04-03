<?php
ini_set('display_errors', true);

include 'strs/StrAbstractDAO.php';
include 'strs/StrConnection.php';
include 'strs/StrAutoload.php';
include 'strs/StrUserAction.php';
include 'strs/StrGenerateAction.php';

include 'strs/StrDAO.php';
include 'strs/StrHtml.php';
include 'strs/StrModel.php';
include 'strs/StrServices.php';
include 'strs/StrStyle.php';
include 'strs/StrControllers.php';

/**
 * validations
 */

if(!isset($_POST['directoryUrl'])){
	echo 'Type the directory URL for you web server location';
	exit;
}
if(!isset($_POST['projectName'])){
    echo 'Type the project name';
    exit;
}

if(!isset($_POST['dbName'])){
    echo 'Type the Database name';
    exit;
}

if(!isset($_POST['dbUserName'])){
    echo 'Type the User (database) name';
    exit;
}

if(!isset($_POST['dbPassword'])){
    echo 'Type the password (database)';
    exit;
}


$return	= mkdir($_POST['directoryUrl'],0777);
$bool1 	= shell_exec("chmod 777 ".$_POST['directoryUrl']);
$bool2 	= shell_exec("chmod -R 777 ".$_POST['directoryUrl']."/*");

$dao_dir    	= $_POST['directoryUrl'].'/DAO';
$model_dir  	= $_POST['directoryUrl'].'/model';
$js_dir     	= $_POST['directoryUrl'].'/js';
$controller_dir = $_POST['directoryUrl'].'/js/controller';
$service_dir	= $_POST['directoryUrl'].'/js/service';
$tpl_dir		= $_POST['directoryUrl'].'/template';
$css_dir        = $_POST['directoryUrl'].'/css';
$action_dir     = $_POST['directoryUrl'].'/action';

if($return == true){
    mkdir($dao_dir,0777);
    mkdir($model_dir,0777);
    mkdir($js_dir,0777);
    mkdir($controller_dir,0777);
    mkdir($tpl_dir,0777);
    mkdir($css_dir,0777);
    mkdir($action_dir,0777);
    mkdir($service_dir,0777);
}

//create index.php
$fp = fopen($_POST['directoryUrl'].'/index.php','w+');
$escreve = fwrite($fp, $str_index);

shell_exec("chmod 777 ".$_POST['directoryUrl']);
shell_exec("chmod 777 ".$dao_dir);
shell_exec("chmod 777 ".$model_dir);
shell_exec("chmod 777 ".$js_dir);
shell_exec("chmod 777 ".$controller_dir);
shell_exec("chmod 777 ".$tpl_dir);
shell_exec("chmod 777 ".$css_dir);
shell_exec("chmod 777 ".$action_dir);
shell_exec("chmod 777 ".$service_dir);

shell_exec("chmod 777 ".$_POST['directoryUrl']."/*");
shell_exec("chmod 777 ".$dao_dir."/*");
shell_exec("chmod 777 ".$model_dir."/*");
shell_exec("chmod 777 ".$js_dir."/*");
shell_exec("chmod 777 ".$controller_dir."/*");
shell_exec("chmod 777 ".$tpl_dir."/*");
shell_exec("chmod 777 ".$css_dir."/*");
shell_exec("chmod 777 ".$action_dir."/*");
shell_exec("chmod 777 ".$service_dir."/*");



//create \model\User.php
$fp = fopen($model_dir.'/User.php','w+');
$escreve = fwrite($fp, $str_model_user);

//create \DAO\UserDAO.php
$fp = fopen($dao_dir.'/UserDAO.php','w+');
$escreve = fwrite($fp, $str_dao_user);

//create \js\app.js
$fp = fopen($js_dir.'/app.js','w+');
$escreve = fwrite($fp, $str_app);

//create \js\controller\dashboard.controller.js
$fp = fopen($controller_dir.'/dashboard.controller.js','w+');
$escreve = fwrite($fp, $str_dashboard_controller);

$fp = fopen($controller_dir.'/ngcrud.controller.js','w+');
$escreve = fwrite($fp, $str_ngcrud_controller);

$fp = fopen($tpl_dir.'/indextpl.php','w+');
$escreve = fwrite($fp, $tpl_dashboard);

$fp = fopen($css_dir.'/style.css','w+');
$escreve = fwrite($fp, $css_style);

$fp = fopen($dao_dir.'/AbstractDAO.php','w+');
$escreve = fwrite($fp, $str_abs_dao);

$fp = fopen($dao_dir.'/GenerateDAO.php','w+');
$escreve = fwrite($fp, $str_dao_generate);

$fp = fopen($dao_dir.'/Connection.php','w+');
$escreve = fwrite($fp, $str_connection);

$fp = fopen($action_dir.'/autoload.php','w+');
$escreve = fwrite($fp, $str_autoload);

$fp = fopen($action_dir.'/userAction.php','w+');
$escreve = fwrite($fp, $str_user_action);

$fp = fopen($action_dir.'/generateAction.php','w+');
$escreve = fwrite($fp, $str_generate_action);

$fp = fopen($service_dir.'/user.service.js','w+');
$escreve = fwrite($fp, $str_user_service);
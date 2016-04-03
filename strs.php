<?php

$str_index ="<html ng-app='".$_POST['projectName'].'App'."'> \n".
"   <head>\n".
"       <script src='//code.jquery.com/jquery-1.12.0.min.js'></script>\n\n\n".
"       <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>\n\n".
"       <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>\n\n".
"       <link rel='stylesheet' type='text/css' href='css/style.css'>\n\n".
"       <link rel='stylesheet' href='https://npmcdn.com/angular-toastr/dist/angular-toastr.css' />\n".
"   </head>\n".
"   <body style='background-color:#e7e7e7'>\n".
"       <div class='".$_POST['projectName']."-nav'>".ucfirst($_POST['projectName'])."</div>\n\n".
"       <div class='".$_POST['projectName']."-content'>\n".
"           <div ng-view></div>\n".
"       </div>\n".
"       <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js'></script>\n".
"       <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-route.js'></script>\n".
"       <script src='https://npmcdn.com/angular-toastr/dist/angular-toastr.tpls.js'></script>\n".
"       <script src='js/app.js'></script>\n\n\n".
"       <script src='js/controller/dashboard.controller.js'></script>\n".
"       <script src='js/controller/ngcrud.controller.js'></script>\n".
"       <script src='js/service/user.service.js'></script>\n".
"   </body>\n".
"</html>";


//model user.php
$array = array('id','firstName', 'lastName', 'email', 'active');

$str_model_user = "<?php \n".

                    "namespace model;\n".
                    "\n".
                    "\n".
                    "\n".
                    "class User {\n".
                    "\n".
                    "\n".

                        "   private $".$array[0].";\n".
                        "   private $".$array[1].";\n".
                        "   private $".$array[2].";\n".
                        "   private $".$array[3].";\n".
                        "   private $".$array[4].";\n".
                        "\n".
                        "\n".
                        "   public function __construct(){}\n".
                        "\n".
                        "\n".
                        "   public function toArray(){\n".
                        "       return get_object_vars(\$this);\n
                    }"
;


foreach ($array as $item) {
    //getter
    $str_model_user .= "\n   public function get".ucfirst($item)."(){\n".
                            "      return $"."this->".$item.";\n   }";

    //setter
    $str_model_user .= "\n   public function set".ucfirst($item)."(\$".$item."){\n".
                            "      \$this->".$item."    = \$".$item.";\n      return \$this; \n   }\n\n";
}
$str_model_user .="}";
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

/**
 * angualar controllers
 */

$str_app = "angular.module('".$_POST['projectName']."App',['ngRoute', 'dashboard.controller','ngcrud.controller','toastr'])\n\n\n
    
.config(['\$routeProvider', function(\$routeProvider){\n
    \$routeProvider.\n
    when('/',{\n
        templateUrl:'template/indextpl.php',\n
        controller:'ngCrudCtrl'\n
    })\n
}])\n

";


$str_dashboard_controller = "angular.module('dashboard.controller',['user.service'])\n\n
.controller('dashboardCtrl',['\$scope','userService','toastr',function(\$scope,userService,toastr){\n\n
    
    \$scope.item = {};

    \$scope.insert = function(item){
        item.active = 't';
        if(item.firstName == undefined || item.firstName == ''){
            toastr.error('First name is required', 'Error');
            return false;
        }

        if(item.lastName == undefined || item.lastName == ''){
            toastr.error('Last name is required', 'Error');
            return false;
        }

        if(item.email == undefined || item.email == ''){
            toastr.error('Last name is required', 'Error');
            return false;
        }

        userService.add(item).success(function(data){
            if(data == 'true'){
                toastr.success('User inserterd with success!','Done!');
                angular.copy({}, \$scope.item);
                \$scope.list();
            } else {
                toastr.error(data,'Done!');
            }
        })
    }
    \$scope.editGrid = function(user){
        \$scope.item.firstName  = user.firstName;
        \$scope.item.lastName   = user.lastName;
        \$scope.item.email      = user.email;
        \$scope.item.id         = user.id;
        \$scope.updating = true;
    }

    \$scope.cancelUpdating = function(){
        \$scope.updating = false;
        \$scope.item.firstName  = '';
        \$scope.item.lastName   = '';
        \$scope.item.email      = '';
        \$scope.item.id         = '';
    }

    \$scope.update = function(item){
        userService.edit(item).success(function(data){
            if(data == 'true'){
                toastr.success('User updated with success!','Done!');
                \$scope.cancelUpdating();
                \$scope.list();
            } else {
                toastr.error(data,'Done!');
            }
        })
    }
    \$scope.get = function(id){
        userService.get(id).success(function(data){
            \$scope.item = data;
        })
    }
    \$scope.list = function(filters){
        userService.list(filters).success(function(data){
            \$scope.itemlist = data;
        })
    }
    \$scope.delete = function(id){
        userService.delete(id).success(function(data){
            if(data == 'true'){
                \$scope.list();
            } else {
                toastr.erro(data, 'Error');
            }
        })
    }
}])\n\n
";

$str_ngcrud_controller = "angular.module('ngcrud.controller',[])\n\n
.controller('ngCrudCtrl',['\$scope','\$http','\$httpParamSerializerJQLike','toastr','userService',function(\$scope,\$http,\$httpParamSerializerJQLike,toastr,userService){\n\n
    userService.list()
        .success(function(data){
            if(angular.isArray(data) == true){
                \$scope.createdbd = true;
            } else {
                \$scope.createdbd = false;
            }
        })
    
    \$scope.generateDB = function(item){
        \$http({
            url:'action/generateAction.php',
            method:'post',
            data:'&action=generate&prefixTable=".$_POST['dbPrefixTable']."',
            headers:{
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function(response){
            if(response.data == 'true'){
                toastr.success('Tables Created With Success', 'Complete!');
                \$scope.createdbd = true;
            } else {
                toastr.error(data, 'Error!');
            }
        })
    }
    
}])\n\n
";

/**
 * angular services
 */

$str_user_service = "
angular.module('user.service',[])

.factory('userService',['\$http','\$httpParamSerializerJQLike', function(\$http,\$httpParamSerializerJQLike){
    var service = {
        add: function(item){
            return \$http({
                url:'action/userAction.php',
                method:'post',
                data:'action=create&'+\$httpParamSerializerJQLike(item),
                headers:{
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
        },
        edit: function(item){
            return \$http({
                url:'action/userAction.php',
                method:'post',
                data:'action=update&'+\$httpParamSerializerJQLike(item),
                headers:{
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
        },
        delete: function(id){
            return \$http({
                url:'action/userAction.php',
                method:'post',
                data:'action=delete&id='+id,
                headers:{
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
        },
        get: function(id){
            return \$http({
                url:'action/userAction.php',
                method:'post',
                data:'action=get&id='+id,
                headers:{
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
        },
        list: function(filters){
            try{
                filters = \$httpParamSerializerJQLike(item);
            }catch(e){
                
            }
            return \$http({
                url:'action/userAction.php',
                method:'post',
                data:'action=list&'+filters,
                headers:{
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
        }


    }
    return service;
}])
";
/**
 *  css
 */
$css_style="
body{
    background-color: #cccccc;
}
.".$_POST['projectName']."-content{
    width: 97%;
    margin-left: 23px;
    float: left;
    min-height: 600px;
    height: auto;
    padding:15px;
    background-color: white;
    box-shadow: 0px 0px 7px 0px;
    z-index: 888;
    margin-top: 7%;
}
.".$_POST['projectName']."-nav{
    width: 100%;
    height:65px;
    background-color: #555555;
    box-shadow: 0px 0px 10px 0px;
    padding: 20px 15px 0px 15px;
    color: #8C715C;
    font-size: 22px;
    font-weight: bold;
    z-index: 999;
    position: fixed;
    top:0;
    left:0;
}
";

$tpl_dashboard = "
    <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 jumbotron' ng-if='createdbd == false'>
        <h1 class='text-center'>
            <span style='color:#C7432C'>ng</span>Crud<span style='color:#C7432C'>.</span>io
        </h1>
        <h3 class='text-center'>
            We wants to thank you!
        </h3>
        <p class='text-center'> Just after you create your bd called for '".$_POST['dbName']."' click down here.</p>
        <p class='text-center'> <button class='btn btn-default btn-lg' ng-click='generateDB()'>Generate DB tables</button></p> 
    </div>
    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 jumbotron' ng-if='createdbd == true' ng-controller='dashboardCtrl'>
        <h1 class='text-center'>
            <span style='color:#C7432C'>ng</span>Crud<span style='color:#C7432C'>.</span>io
        </h1>
        <form class='form-group' ng-init='list()'> 
            <div class='col-md-6'>
                <label>First Name</label>
                <input type='text' ng-model='item.firstName' class='form-control'/>
            </div>

            <div class='col-md-6'>
                <label>Last Name</label>
                <input type='text' ng-model='item.lastName' class='form-control'/>
            </div>
            <div class='col-md-6'>
                <label>Email</label>
                <input type='text' ng-model='item.email' class='form-control'/>
            </div>
            <input type='hidden' ng-model='item.active' value='true'/>
            <div class='text-center col-md-6' style='padding-top:25px' >
                <button class='btn btn-success' ng-click='insert(item)' ng-if='updating!=true'>
                    <i class='glyphicon glyphicon-ok'></i> insert
                </button>

                <button class='btn btn-warning' ng-click='update(item)' ng-if='updating==true'>
                    <i class='glyphicon glyphicon-pencil'></i> update
                </button>

                <button class='btn btn-danger' ng-click='cancelUpdating()' ng-if='updating==true'>
                    <i class='glyphicon glyphicon-remove'></i> Cancelar
                </button>
            </div>
        </form>

        <div class='clearfix'></div> 
        <div class='table-responsive col-md-12 col-lg-12'>
            <table class='table table-hover table-condensed table-striped' style='background-color: white; margin-top: 15px'>
                <thead>
                    <tr>
                        <td class='col-md-4 col-lg-4'>
                            <strong>Name</strong>
                        </td>
                        <td class='col-md-4 col-lg-4'>
                            <strong>Last Name</strong>
                        </td>
                        <td class='col-md-4 col-lg-3'>
                            <strong>Email</strong>
                        </td>
                        <td class='col-md-1 col-lg-1'></td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat='user in itemlist'>
                        <td class='col-md-4 col-lg-4'>
                            <small>{{user.firstName}}</small>
                        </td>
                        <td class='col-md-4 col-lg-4'>
                            <small>{{user.lastName}}</small>
                        </td>
                        <td class='col-md-4 col-lg-3'>
                            <small>{{user.email}}</small>
                        </td>
                        <td class='col-md-1 col-lg-1'>
                            <i class='glyphicon glyphicon-pencil' ng-click='editGrid(user)'></i>
                            <i class='glyphicon glyphicon-trash'  ng-click='delete(user.id)'></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>

";
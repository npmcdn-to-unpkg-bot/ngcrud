<?php
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

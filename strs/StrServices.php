<?php

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
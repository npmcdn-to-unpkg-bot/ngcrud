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
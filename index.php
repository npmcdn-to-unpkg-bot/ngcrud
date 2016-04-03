<html>

    <meta charset='utf-8'/>

    <head>

        <style type="text/css">
        .grid-4{
            width: 31%;
            float: left;
            padding: 15px;
        }
        .main-card{
            box-shadow: 0px 0px 10px -1px;
            background-color: white;
            width: 100%;
            min-height: 400px;
            margin-top: 20%;
            padding-top: 10px;
        }
        </style>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="index.js"></script>
    </head>

    <body>
        <div class='frame01-nav'><span style="color:#C7432C">ng</span>Crud<span style="color:#C7432C">.</span>io</div>
        <div class="frame01-content">
            <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="main-card">
                <fieldset>
                    <legend style="padding-left: 10px"><a>Project Configuration</a></legend>
                    <form class="form-group" onsubmit="return false;">

                        <div class="col-md-12">
                            <label>Project name</label>
                            <input type="text" class="form-control" id="projectName">
                        </div>

                        <div class="col-md-12">
                            <label>Directory URL<i><small style="color: gray"> Ex.: C:/xampp/htdocs/directory_name</small></i></label>
                            <input type="text" class="form-control" id="directoryUrl">
                        </div>

                        <div class="col-md-12">
                            <label>Database name</label>
                            <input type="text" class="form-control" id="dbName">
                        </div>
                        <div class="col-md-6">
                            <label>Username (database)</label>
                            <input type="text" class="form-control" id="dbUserName">
                        </div>

                        <div class="col-md-6">
                            <label>Password (database)</label>
                            <input type="text" class="form-control" id="dbPassword">
                        </div>

                        <div class="col-md-6">
                            <label>Prefix table</label>
                            <input type="text" class="form-control"id="dbPrefixTable" placeholder="ex_">
                        </div>
                        <div class="col-md-6 text-right" style="padding-top: 23px;">
                            <button class="btn btn-primary" onclick="createProject()"> Done</button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        <div class="col-md-4"></div>
        </div>
    </body>
</html>
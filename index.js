function createProject(){
    var data = {
        action: 'create',
        projectName: $('#projectName').val(),
        directoryUrl: $('#directoryUrl').val(),
        dbName: $('#dbName').val(),
        dbUserName: $('#dbUserName').val(),
        dbPassword: $('#dbPassword').val(),
        dbPrefixTable: $('#dbPrefixTable').val()
    }

    $.ajax({
        url:'create.php',
        method: 'post',
        data: data,
        success: function(response){
            window.open('http://localhost/ngCrud/done.php','_blank');
        }
    })
}
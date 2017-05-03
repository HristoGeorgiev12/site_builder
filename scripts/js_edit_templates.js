$(document).ready(function() {



//                var uploadImage = '<form action="upload.php" method="post" enctype="multipart/form-data">'+
//                    'Select image to upload:'+
//                    '<input type="file" name="fileToUpload" id="fileToUpload">'+
//                    '<input type="submit" value="Upload Image" name="submit" id="submitFileUpload">'+
//                    '</form>';

//                $('img').click(function() {
//                    $("#fileToUpload").trigger('click', function() {
//                        $("#submitFileUpload").trigger('click');
//                    });
//
//                    console.log('asdas');
//                });

    // $('h2').text('asd');

    var objectsChanges = {};
    $('.edit').editable({
        type: 'textarea',
        //    url: '/post',
        url: 'http://localhost/site_builder/Templates/ajax.php',
        pk: {
            ha:1,
            ha2:2
        },
        placement: 'top',
        title: 'Enter comments',
        success: function(response, newValue) {
            var index = $( ".edit" ).index(this);
            var elementType = $(this).get(0).tagName;
            objectsChanges[elementType +'_'+ index] = newValue;
        }
    });

    //modify buttons style
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-success editable-submit btn-mini"><i class="icon-ok icon-white"></i></button>' +
        '<button type="button" class="btn editable-cancel btn-mini"><i class="icon-remove"></i></button>';

    // $.fn.editable.defaults.mode = 'inline';

    function performClick(elemId) {
        var elem = document.getElementById(elemId);
        if(elem && document.createEvent) {
            var evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            elem.dispatchEvent(evt);
        }
    }

    var editMenu = '<nav class="navbar navbar-inverse" style="position: fixed; width: 100%">' +
        '<div class="container-fluid">' +
        '<ul class="nav navbar-nav">' +
        '<li >' + '<a id="goBack" href="?page=index">Go Back' +
        '</a>' +
        '</li>' +
        '</ul>' +
        '<ul class="nav navbar-nav navbar-right">' +
        '<li >' + '<a id="create" href="#">Continue' +
        '</a>' + '</li>' +
        '</ul>' +
        '</div>' +
        '</nav>';

    $('body').prepend(editMenu);

    $('#create').click(function () {
        console.log(findGetParameter('project_id'));
        $.ajax({
            type: 'POST',
            data: {
                create: true,
                template_id: findGetParameter('template_id'),
                params: objectsChanges,
                project_id: findGetParameter('project_id')

            },
            url: 'Templates/ajax.php',
            success: function(data){
                var json = JSON.parse(data);
                $(location).attr('href', '?user_id=1&project_id='+json);

            }
        });
    })

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result?result:false;
    }

    // $('#goBack').click(function () {
    //     var answer = confirm("Are you sure, all of the changes will be lost?");
    //     if(answer){
    //
    //     }
    // });
   // window.onbeforeunload = $('#goBack').trigger('click');
   var objValue = function(){
       var answer = confirm("do you want to check our other products");
       if(answer){
           $.ajax({
               type: 'POST',
               data: {
                   edit: true,
                   bla: 12,
                   params: objectsChanges,
                   project_id: findGetParameter('project_id')
               },
               url: 'http://localhost/site_builder/Templates/ajax.php',
               send: 'always',
               success: function(data){
                   var json = JSON.parse(data);
               }
           });
       }
   };


});

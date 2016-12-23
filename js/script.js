$(document).ready(function() {

    $("#hideForm").click(function(){
        $("#createForm").hide(1000);
    });
    $("#showForm").click(function(){
        $("#createForm").show(1000);
    });


});


function validation(action, fn, sn, email){

    $("div.message").html('');

    var message = '';

    var valid_fn = false;
    var valid_sn = false;
    var valid_email = false;

    if( fn == '' ){

        message = 'Поле First Name обязательно для заполнения!';
        if(action == 'create'){
            $("#error_fn").append(message);
        }else{
            $("#edit_fn").append(message);
        }

    }else{
        valid_fn = true;
    }

    if( sn == '' ){

        message = 'Поле Second Name обязательно для заполнения!';
        if(action == 'create'){
            $("#error_sn").append(message);
        }else{
            $("#edit_sn").append(message);
        }

    }else{
        valid_sn = true;
    }

    if( email == '' ){

        message = 'Поле Email обязательно для заполнения!';
        if(action == 'create'){
            $("#error_email").append(message);
        }else{
            $("#edit_email").append(message);
        }

    }else if( email.indexOf('@') + 1 == 0 ){
        message = 'не корректный Email !';
        if(action == 'create'){
            $("#error_email").append(message);
        }else{
            $("#edit_email").append(message);
        }
    }else{
        valid_email = true;
    }

    if(valid_fn&&valid_sn&&valid_email){
        return true;
    }else{
        return false;
    }

}


$(document).ready(function() {

    $("#createButton").click(function (e) {
        e.preventDefault();

        var firstName = $("#firstName").val();
        var secondName = $("#secondName").val();
        var email = $("#email").val();
        if(validation('create', firstName, secondName, email)){
            $.ajax({
                type: "POST",
                url: "crud.php",
                data: {action : 'create', firstName : firstName, secondName : secondName, email : email},
                success: function(data){
                    $("#users").append(data);
                    $("#firstName").val('');
                    $("#secondName").val('');
                    $("#email").val('');
                }
            });
        }else{
            alert('Заполните форму корректно');
        }
    })
    
});

function deleteUser(id) {

    if (confirm("Подтвердите удаление")) {
        $.ajax({
            type: "POST",
            url: "crud.php",
            data: {action : 'delete', id : id},
            success: function(data){
                $("#"+id).css('display', 'none');
            }
        });
    }


}

function editUser(id){

        var firstName = $("#fn_"+id).html();
        var secondName = $("#sn_"+id).html();
        var email = $("#email_"+id).html();
        var fnInput = "<form id='form' method='POST'><input type='text' id='fn' name='firstName' value="+firstName+" placeholder='First Name'>";
        var snInput = "<br/><input type='text' id='sn' name='secondName' value="+secondName+" placeholder='Second Name'>";
        var emInput = "<br/><input type='email' id='em' name='email' value="+email+" placeholder='Email'></form>";
        var edit_err_fn = '<div id="edit_fn" class="edit_message"></div>';
        var edit_err_sn = '<div id="edit_sn" class="edit_message"></div>';
        var edit_err_email = '<div id="edit_email" class="edit_message"></div>';

        $("#edit_"+id).attr('onclick', "save("+id+")").text("Сохранить");

        $("#fn_"+id).append(fnInput);
        $("#fn_"+id).append(edit_err_fn);
        $("#sn_"+id).append(snInput);
        $("#sn_"+id).append(edit_err_sn);
        $("#email_"+id).append(emInput);
        $("#email_"+id).append(edit_err_email);

}


function save(id) {

    $("div.edit_message").html('');

    var newFN = $("#fn").val();
    var newSN = $("#sn").val();
    var newEmail = $("#em").val();

    if(validation('edit', newFN, newSN, newEmail)){
        $.ajax({
            type: "POST",
            url: "crud.php",
            data: {action : 'save', id : id, newFN : newFN, newSN : newSN, newEmail : newEmail},
            success: function(data){
                $("#edit_"+id).attr('onclick',  "editUser("+id+")").text("Изменить");

               // $("#test").append(data);
                $("#fn").remove();
                $("#sn").remove();
                $("#em").remove();
                $("#edit_fn").remove();
                $("#edit_sn").remove();
                $("#edit_email").remove();

                $("#fn_"+id).html(newFN);
                $("#sn_"+id).html(newSN);
                $("#email_"+id).html(newEmail);

            }
        });
    }else{
        alert('Заполните форму корректно');
    }



}




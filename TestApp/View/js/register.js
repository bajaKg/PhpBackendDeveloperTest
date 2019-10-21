function confirmRegistration(arg){    
    if (arg['data'] == 1){
        window.location.href = "HomeScreen.php";
    } else {
        $('#divMessage').show();		
        $('#showMessage').text(arg['message']);	
    }
}

$(document).ready(function() {	
    $("#register").click(function(){        
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm = $('#confirmPass').val();
        var name = $('#name').val();
        var req_data = {"name": name, "email": email, "password": password, "confirm":confirm };
        var request = JSON.stringify(req_data);

        callAjax('../Controller/RegisterController.php', request, 'POST', confirmRegistration);
    });
});

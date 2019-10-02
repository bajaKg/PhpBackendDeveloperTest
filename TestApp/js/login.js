function confirmLogin(arg){
    console.log('confirmLogin');
    if (arg['data'] == 1){
        //window.location.href = "HomeScreen.php";
        $('#divMessage').show();		
        $('#showMessage').text(arg['message']);	
    } else {
        $('#divMessage').show();		
        $('#showMessage').text(arg['message']);	
    }
}

$(document).ready(function() {	
    $("#login").click(function(){
        var email = $('#email').val();
        var password = $('#password').val();		
        var req_data = {"email": email, "password": password };
        var request = JSON.stringify(req_data);

        callAjax('LoginController.php', request, 'POST', confirmLogin);
    });
});

function showResults(arg){
    if (arg['data'] == 0){        

        $('#divMessage').show();		
        $('#showMessage').text(arg['message']);	

    } else if (arg['data'] == -1){
        $('#divLogin').show();
        $('#divMessage').show();	
        $('#showMessage').text(arg['message']);
    }
    else{
        window.location.href = "ResultsScreen.php?data="+JSON.stringify(arg['data']);
        

    }
}

$(document).ready(function() {	
    $('#divLogin').hide();
    $("#search").click(function(){        
        var text = $('#text').val();                
        var req_data = {"text": text};
        var request = JSON.stringify(req_data);

        callAjax('../Controller/SearchController.php', request, 'POST', showResults);
    });
});

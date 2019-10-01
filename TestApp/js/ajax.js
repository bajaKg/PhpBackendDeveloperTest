function callAjax(url, requestData, type, callback) {
	$.ajax({
		url : url,
		data : {
				data : requestData
				},
		type : type,		
		error: function (xhr, status) {
            alert(status);
        },
		success : function(result) {			
			if (result['status'] == -1) {
				$('#divMessage').show();
				$('#showMessage').text(result['message']);	
			} else {
				callback(result);
			}
		}
	});
}
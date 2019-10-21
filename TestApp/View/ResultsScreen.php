<?php
include "header.php";
?>  
<script>
    function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
</script>

<script>    
$(document).ready(function() {
    var data = JSON.parse(getUrlParameter('data'));

    var content = "<table>";
    content += "<tr>";
    content += '<td>' + 'ID' + '</td>';
    content += '<td>' + 'Name' + '</td>';
    content += '<td>' + 'Email' + '</td>';
    content += "</tr>";


    for (var i = 0; i < data.length; i++) {
        content += "<tr>";
        content += '<td>' + data[i]['id'] + '</td>';
        content += '<td>' + data[i]['name'] + '</td>';
        content += '<td>' + data[i]['email'] + '</td>';    
        content += "</tr>";
    }


    content += "</table>";
    $('#table').append(content);
});
</script>   
    <div class="col-sm-8 text-left" style="width:100%; height:100%; border:solid;" id="table"></div>

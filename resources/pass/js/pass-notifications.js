function error_message(xhr, status, error, mid) {
    var errorMessage = 'An Error Occurred - ' + xhr.status + ': ' + xhr.statusText + '<br> ' + error;  
    
    $(mid).html( 
        '<div class="card m-2 text-center">'+
            '<div class="card-header p-2">Server Response: </div>'+
            '<div class="card-body p-2 text-info">'+
                '<div class="card-text font-weight-bold text-danger">'+errorMessage+'</div>'
                +xhr.responseText+
            '</div>'+
        '</div>'
    );
}

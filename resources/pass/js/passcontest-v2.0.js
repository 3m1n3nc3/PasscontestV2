function confirmDelete(data) { 
    var button = 
        '<div class="d-flex font-weight-bold">'+
            '<a href="javascript:void(0)" class="btn btn-lg btn-block btn-danger" data-delete="true" onclick="'+data+'" id="delete_confirm"> Yes Delete </a>'+
            '<button type="button" class="btn btn-lg btn-block btn-info" data-dismiss="modal">No</button>'+
        '</div>';

    $('#actionModal .modal-body').html('<p>Are you sure you want to delete this item?</p>');
    $('#actionModal .modal-body').append(button);
    $('#actionModal .modal-title').html('Confirmation');
    $("#actionModal").modal('show'); 
}

$('#actionModal').on('hide.bs.modal', function function_name(e) { 
    $('#actionModal .modal-body, #actionModal .modal-title').html('');
})

/**
 * Vote for an item
 * @param  {[string]} data [json string representing the data to be sent along with the request]
 */
function add_vote(data) {
    var m_id = '#msg_'+data.contestant;
    var v_id = '#user_vote_count_'+data.contestant;

    $.ajax({
        type: 'POST',
        url: site_url+'ajax/connect/add_vote',
        data: data,  
        dataType: 'JSON',
        success: function(resps) { console.log(resps.status); 
            if (resps.status == 1) {
                $(v_id).html(resps.response); 
                $(v_id).attr('data-votes-count', resps.response); 
                $(m_id).html(''); 
            } 
            if (resps.msg) {
                $(m_id).html(resps.msg); 
            }
        }, 
        error: function(xhr, status, error) {
            error_message(xhr, status, error, m_id);
        }     
    })
}

/**
 * Accept or reject a contest entry request
 * @param  {[string]} data [json string representing the data to be sent along with the request]
 * @return {[string]}      [null]
 */
function acceptItem(data) {
    console.log(data);
    
    if (data.init === 'dt') {
        var tr_id = '#tr_'+data.id;
    } else if (data.init === 'table') {
        var tr_id = '#table_row_'+data.id;
    }
    
    var m_id = '#msg_box';

    $(m_id).html('');
    $(tr_id+' .btn').removeAttr('onclick');

    $.ajax({
        type: 'POST',
        url: site_url+'ajax/connect/acceptItem',
        data: data,  
        dataType: 'JSON',
        success: function(resps) {  
            if (resps.response === true) {
                if (data.action === 0) {
                    $(tr_id).fadeOut('slow'); 
                } else {
                    $(tr_id+' .identifier').removeClass('btn-success').addClass('btn-danger').html('Reject'); 
                    $(tr_id+' .identifier').attr('onclick', 'acceptItem({type:'+data.type+', action: 0, id: '+data.id+', '+data.contest_id+': 2, init: dt})');
                }
            }
        },
        error: function(xhr, status, error) {
            error_message(xhr, status, error, m_id);
        }  
    })
}

/**
 * Delete A contest
 * @param  {[string]} data [json string representing the data to be sent along with the request]
 * @return {[string]}      [null]
 */
function deleteItem(data) {
    console.log(data);

    if (data.init === 'dt') {
        var tr_id = '#tr_'+data.id;
    } else if (data.init === 'table') {
        var tr_id = '#table_row_'+data.id;
    } 

    var m_id = '#msg_box';

    $(m_id).html('');

    var confirm = $('#delete_confirm').data('delete'); 

    if (confirm === true) {
        
        $("#actionModal").modal('hide'); 
        $(tr_id+' .btn').removeAttr('onclick');

        $.ajax({
            type: 'POST',
            url: site_url+'ajax/connect/deleteItem',
            data: data,  
            dataType: 'JSON',
            success: function(resps) {  
                if (resps.response === true) { 
                    if (data.action === 1) {
                        $(tr_id).fadeOut('slow'); 
                    }
                }
            },
            error: function(xhr, status, error) {
                error_message(xhr, status, error, m_id);
            } 

        })
    } else {
        var onclick = $(tr_id+' .deleter').attr('onclick');
        confirmDelete(onclick);
    }
}

/**
 * fetch the image upload modal content and attach to the modal body
 * @param  {String} ){                                 var m_id [id or class of a container to append content]
 * @param  {[type]} error: function(xhr, status, error) {
 *                             error_message(xhr, status, error, m_id);        
 * }      })} [if there is an error on the page run the error function]
 * @return {[type]}        [null]
 */
$('#upload_resize_image').click(function(){

    var m_id = '.modal-content';
    var endpoint_id = $('#upload_resize_image').data('endpoint_id');
    var endpoint = $('#upload_resize_image').data('endpoint');
    var data = {endpoint_id:endpoint_id ? endpoint_id : null, endpoint:endpoint ? endpoint : endpoint}; 

    $.ajax({
        type: 'POST',
        url: site_url+'ajax/modal/upload_image',
        data: data,  
        dataType: 'JSON',
        success: function(resps) {  
            $(m_id).html(resps.content);
        },
        error: function(xhr, status, error) {
            error_message(xhr, status, error, m_id);
        }  
    })
})


$('select[name="parent"]').change(function() {
    var parent = $('select[name="parent"] option:selected').val();
    if (parent == '') $('#in_footer').attr('class', 'd-block');
    if (parent != '') $('#in_footer').attr('class', 'd-none');
})


function safeLinker(_this) { 
    var title = $.trim($(_this).val()); 
    title = title.replace(/[^a-zA-Z0-9-]+/g, '-');

    var safelink = 'input[name="safelink"]';
    $(safelink).val(title.toLowerCase());
}

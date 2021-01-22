
$("#form_validation").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response){
            // console.log(response);
            alert(response.messages);
        },
        error:function(e){
            console.log(e);
        }
    })
    

    
})

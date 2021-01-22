
$("#investor_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#investor_form')[0]),
        processData: false,
        contentType: false,
        success:function(response){
            response = JSON.parse(response);
            
            // alert(response.messages);
            $(document).Toasts('create', {
                class: response.class,
                title: response.title,
                // subtitle: 'Subtitle',
                body: response.messages
            });
        },
        error:function(e){
            console.log(e);
        }
    })
    

    
})


// delete investor 
function delete_investor(investorId){
    
    console.log("id");
    console.log(investorId);
    $.ajax({
        url:"./includes/fetch_investor_by_id.php",
        type:'post',
        data: {investorId: investorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_investor_id').val(response.id);

            $('#delete_investor').unbind('submit').bind('submit',function(){
                event.preventDefault();
                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success:function(response){
                        $(document).Toasts('create', {
                            class: response.class,
                            title: response.title,
                            body: response.messages
                        });
                        location.reload();
                    }
                })

                    
            })
        },
        error: function(err){
            console.log(err);
        }
    })
}



// update investor record
function edit_investor(investorId){
    
    console.log("id");
    console.log(investorId);
    $.ajax({
        url:"./includes/fetch_investor_by_id.php",
        type:'post',
        data: {investorId: investorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_i_id').val(response.id);
            $('#edit_i_name').val(response.name);
            $('#edit_i_address').val(response.address);
            $('#edit_i_phone').val(response.phone);

            $('#update_investor').unbind('submit').bind('submit',function(){
                event.preventDefault();
                // var edit_date = $('#edit_date').val();

                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData($('#update_investor')[0]),
                    processData: false,
                    contentType: false,
                    success:function(response){
                        response = JSON.parse(response);
                        $(document).Toasts('create', {
                            class: response.class,
                            title: response.title,
                            body: response.messages
                          });
                        //   $("#updateButton").attr("data-dismiss","modal");
                    }
                })

                    
            })



        },
        error: function(err){
            console.log(err);
        }
    })
}

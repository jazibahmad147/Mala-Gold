
$("#customer_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#customer_form')[0]),
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
            $('#customer_form')[0].reset();
            location.reload();
        },
        error:function(e){
            console.log(e);
        }
    })
    

    
})


// delete investor 
function delete_customer(customerId){
    
    console.log("id");
    console.log(customerId);
    $.ajax({
        url:"./includes/fetch_customer_by_id.php",
        type:'post',
        data: {customerId: customerId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_customer_id').val(response.id);

            $('#delete_customer').unbind('submit').bind('submit',function(){
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
function edit_customer(customerId){
    
    console.log("id");
    console.log(customerId);
    $.ajax({
        url:"./includes/fetch_customer_by_id.php",
        type:'post',
        data: {customerId: customerId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_c_id').val(response.id);
            $('#edit_c_name').val(response.name);
            $('#edit_c_cnic').val(response.cnic);
            $('#edit_c_address').val(response.address);
            $('#edit_c_phone').val(response.phone);

            $('#update_customer').unbind('submit').bind('submit',function(){
                event.preventDefault();
                // var edit_date = $('#edit_date').val();

                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData($('#update_customer')[0]),
                    processData: false,
                    contentType: false,
                    success:function(response){
                        response = JSON.parse(response);
                        $(document).Toasts('create', {
                            class: response.class,
                            title: response.title,
                            body: response.messages
                          });
                          $('#update_customer')[0].reset();
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

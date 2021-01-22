
$("#worker_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#worker_form')[0]),
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


// delete worker 
function delete_worker(workerId){
    
    console.log("id");
    console.log(workerId);
    $.ajax({
        url:"./includes/fetch_worker_by_id.php",
        type:'post',
        data: {workerId: workerId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_worker_id').val(response.id);

            $('#delete_worker').unbind('submit').bind('submit',function(){
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



// update worker record
function edit_worker(workerId){
    
    console.log("id");
    console.log(workerId);
    $.ajax({
        url:"./includes/fetch_worker_by_id.php",
        type:'post',
        data: {workerId: workerId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_w_id').val(response.id);
            $('#edit_w_name').val(response.name);
            $('#edit_w_address').val(response.address);
            $('#edit_w_phone').val(response.phone);

            $('#update_worker').unbind('submit').bind('submit',function(){
                event.preventDefault();

                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData($('#update_worker')[0]),
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

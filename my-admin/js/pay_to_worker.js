

$("#pay_to_worker_in_rupee_process").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#pay_to_worker_in_rupee_process')[0]),
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
            location.reload();
        },
        error:function(e){
            console.log(e);
        }
    })
    
})


$("#pay_to_worker_in_gold_process").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#pay_to_worker_in_gold_process')[0]),
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
            location.reload();
        },
        error:function(e){
            console.log(e);
        }
    })
    
})



function delete_worker_payment(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_worker_payment_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_payment_id').val(response.id);

            $('#delete_payment').unbind('submit').bind('submit',function(){
                event.preventDefault();
                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success:function(response){
                        // console.log(response);
                        // alert(response.messages);
                        $(document).Toasts('create', {
                            class: response.class,
                            title: response.title,
                            // subtitle: 'Subtitle',
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

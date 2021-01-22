

function edit_silver_rate(silverId){
    
    console.log("id");
    console.log(silverId);
    $.ajax({
        url:"./includes/fetch_silver_by_id.php",
        type:'post',
        data: {silverId: silverId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_silver_id').val(response.id);
            $('#edit_silver_date').val(response.date);
            $('#edit_silver_buying').val(response.buying);
            $('#edit_silver_selling').val(response.selling);
            console.log(response.buying);

            $('#update_silver_rate').unbind('submit').bind('submit',function(){
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


function edit_gold_pathor_rate(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_pathor_id').val(response.id);
            $('#edit_pathor_date').val(response.date);
            $('#edit_pathor_buying').val(response.buying);
            $('#edit_pathor_selling').val(response.selling);

            $('#update_gold_pathor_rate').unbind('submit').bind('submit',function(){
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
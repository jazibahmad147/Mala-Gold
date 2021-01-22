

function edit_gold_piece_rate(goldPieceId){
    
    console.log("id");
    console.log(goldPieceId);
    $.ajax({
        url:"./includes/fetch_gold_piece_by_id.php",
        type:'post',
        data: {goldPieceId: goldPieceId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_id').val(response.id);
            $('#edit_date').val(response.date);
            $('#edit_buying').val(response.buying);
            $('#edit_selling').val(response.selling);

            $('#update_gold_piece_rate').unbind('submit').bind('submit',function(){
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
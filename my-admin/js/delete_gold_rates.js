

function delete_gold_pathor_rate(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_pathor_id').val(response.id);

            $('#delete_gold_pathor_rate').unbind('submit').bind('submit',function(){
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




function delete_gold_piece_rate(goldPieceId){
    
    console.log("id");
    console.log(goldPieceId);
    $.ajax({
        url:"./includes/fetch_gold_piece_by_id.php",
        type:'post',
        data: {goldPieceId: goldPieceId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_piece_id').val(response.id);

            $('#delete_gold_piece_rate').unbind('submit').bind('submit',function(){
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




function delete_silver_rate(silverId){
    
    console.log("id");
    console.log(silverId);
    $.ajax({
        url:"./includes/fetch_silver_by_id.php",
        type:'post',
        data: {silverId: silverId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_silver_id').val(response.id);

            $('#delete_silver_rate').unbind('submit').bind('submit',function(){
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
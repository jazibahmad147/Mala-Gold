


// view barcode
function print_barcode_gold_piece_stock_item(pieceId){
    
    console.log("id");
    console.log(pieceId);
    $.ajax({
        url:"./includes/fetch_piece_by_id.php",
        type:'post',
        data: {pieceId: pieceId },
        dataType : 'json',
        success : function(response) {
            console.log(response.barcode);

            document.getElementById("barcodeId").src = "barcode/barcode.php?text="+response.barcode+"&size=50&print=true";
            document.getElementById("printButton").setAttribute("onclick", "location.href='print_barcode_page.php?id="+response.barcode+"'");

        },
        error: function(err){
            console.log(err);
        }
    })
}

// addd in stock 
$("#add_piece_stock_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#add_piece_stock_form')[0]),
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



// delete piece 
function delete_piece(pieceId){
    
    console.log("id");
    console.log(pieceId);
    $.ajax({
        url:"./includes/fetch_piece_by_id.php",
        type:'post',
        data: {pieceId: pieceId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_piece_id').val(response.id);

            $('#delete_piece').unbind('submit').bind('submit',function(){
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



// update piece record
function edit_piece(pieceId){
    
    console.log("id");
    console.log(pieceId);
    $.ajax({
        url:"./includes/fetch_piece_by_id.php",
        type:'post',
        data: {pieceId: pieceId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_piece_id').val(response.id);
            $('#edit_piece_date').val(response.date);
            $('#edit_piece_weight').val(response.weight);

            $('#update_piece').unbind('submit').bind('submit',function(){
                event.preventDefault();
                // var edit_date = $('#edit_date').val();

                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData($('#update_piece')[0]),
                    processData: false,
                    contentType: false,
                    success:function(response){
                        response = JSON.parse(response);
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

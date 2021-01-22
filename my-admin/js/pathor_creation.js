
$("#add_pathor_stock_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#add_pathor_stock_form')[0]),
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


$("#create_pathor_stock_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#create_pathor_stock_form')[0]),
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


$("#remove_from_pathor_cart_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#remove_from_pathor_cart_form')[0]),
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


// view barcode
function print_barcode_gold_pathor_stock_item(pathorId){
    
    console.log("id");
    console.log(pathorId);
    $.ajax({
        url:"./includes/fetch_pathor_by_id.php",
        type:'post',
        data: {pathorId: pathorId },
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



// delete piece 
function delete_pathor(pathorId){
    
    console.log("id");
    console.log(pathorId);
    $.ajax({
        url:"./includes/fetch_pathor_by_id.php",
        type:'post',
        data: {pathorId: pathorId},
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_pathor_id').val(response.barcode);

            $('#delete_pathor').unbind('submit').bind('submit',function(){
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



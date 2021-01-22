function recieve_payment(id){
    console.log(id);

    $.ajax({
        url:"./includes/fetch_sales_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.saleId );
            $('#invoiceId').val(response.saleId);

            $('#recieve_payment').unbind('submit').bind('submit',function(){
                event.preventDefault();
                
                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    // data: form.serialize(),
                    // dataType: 'json',
                    data: new FormData($('#recieve_payment')[0]),
                    processData: false,
                    contentType: false,
                    success:function(response){

                        response = JSON.parse(response);

                        $(document).Toasts('create', {
                            class: response.class,
                            title: response.title,
                            // subtitle: 'Subtitle',
                            body: response.messages
                          });
                          $('#recieve_payment')[0].reset();
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

function delete_sale_record(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_sales_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_sale_record_id').val(response.id);

            $('#delete_sale_record').unbind('submit').bind('submit',function(){
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


function return_sale_record(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_sales_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#return_sale_record_id').val(response.id);

            $('#return_sale_record').unbind('submit').bind('submit',function(){
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

// print sale invoice
function print_sale_invoice(invoiceId = null) {
    console.log("inside function "+invoiceId);
    if (invoiceId) {

        $.ajax({
            url: './includes/print_sale_invoice.php',
            type: 'post',
            data: { invoiceId: invoiceId },
            dataType: 'text',
            success: function(response) {

                    var mywindow = window.open('', 'Mala Gold', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>Sale Invoice</title>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

                    mywindow.print();
                    // mywindow.close();

                } // /success function
        }); // /ajax function to fetch the printable order
    } // /if orderId
} // /print order function
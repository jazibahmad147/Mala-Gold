
// addd in stock 
$("#stone_sale_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#stone_sale_form')[0]),
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


// show initials
function showInitialPrice(){
    var barcode = $('#stoneName').val();
    console.log(barcode);
    $.ajax({
        url:"./includes/fetch_stone_stock_item_by_barcode.php",
        type:'post',
        data: {barcode: barcode },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            document.getElementById('stoneInitialPrice').innerHTML = response.price;

            $('#update_investor').unbind('submit').bind('submit',function(){
                event.preventDefault();
                // var edit_date = $('#edit_date').val();

                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData($('#update_investor')[0]),
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

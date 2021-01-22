
// add in stock 
$("#add_gold_stock").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#add_gold_stock')[0]),
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



function delete_gold_pathor_stock_item(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_stock_item_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_pathor_id').val(response.id);

            $('#delete_gold_pathor_stock_item').unbind('submit').bind('submit',function(){
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




// view barcode
function print_barcode_gold_pathor_stock_item(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_stock_item_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.p_key);

            document.getElementById("barcodeId").src = "barcode/barcode.php?text="+response.p_key+"&size=50&print=true";
            document.getElementById("printButton").setAttribute("onclick", "location.href='print_barcode_page.php?id="+response.p_key+"'");

        },
        error: function(err){
            console.log(err);
        }
    })
}


// view image
function view_gold_pathor_stock_item_image(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_stock_item_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );

            document.getElementById("imageId").src = "media/stock/gold_stock/"+response.image;

        },
        error: function(err){
            console.log(err);
        }
    })
}

// view stock item
function view_gold_pathor_stock_item(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_stock_item_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.quantity );

            document.getElementById("stock_item_name").innerHTML = response.name;
            document.getElementById("stock_item_id").innerHTML = response.p_key;
            document.getElementById("stock_item_date").innerHTML = response.date;
            document.getElementById("stock_item_desc").innerHTML = response.description;
            document.getElementById("stock_item_karat").innerHTML = response.karat;
            document.getElementById("stock_item_quantity").innerHTML = response.quantity;
            document.getElementById("stock_item_weight").innerHTML = response.weight;
            // document.getElementById("stock_item_etc").innerHTML = response.etc;
            document.getElementById("stock_item_type").innerHTML = response.category;

        },
        error: function(err){
            console.log(err);
        }
    })
}


// update gold pathor stock item
function edit_gold_pathor_stock_item(goldPathorId){
    
    console.log("id");
    console.log(goldPathorId);
    $.ajax({
        url:"./includes/fetch_gold_pathor_stock_item_by_id.php",
        type:'post',
        data: {goldPathorId: goldPathorId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#edit_id').val(response.id);
            $('#edit_date').val(response.date);
            $('#edit_p_name').val(response.name);
            $('#edit_productType').val(response.productType);
            $('#edit_p_description').val(response.description);
            $('#edit_karat').val(response.karat);
            $('#edit_qty').val(response.quantity);
            $('#edit_weight').val(response.weight);
            $('#edit_extra_charges').val(response.etc);

            $('#update_gold_pathor_stock_item').unbind('submit').bind('submit',function(){
                event.preventDefault();
                // var edit_date = $('#edit_date').val();
                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    // data: form.serialize(),
                    // dataType: 'json',
                    data: new FormData($('#update_gold_pathor_stock_item')[0]),
                    processData: false,
                    contentType: false,
                    success:function(response){
                        response = JSON.parse(response);
                        // console.log(response);
                        // alert(response.messages);
                        $(document).Toasts('create', {
                            class: response.class,
                            title: response.title,
                            // subtitle: 'Subtitle',
                            body: response.messages
                          });
                          location.reload();
                        //   $('#update_gold_pathor_stock_item')[0].reset();
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


function showDiv()
{
    var value = $('#group').val();
    if(value == "INVESTOR"){
        document.getElementById('investorSelectionDiv').style.display = "block";
    }else{
        document.getElementById('investorSelectionDiv').style.display = "none";
    }
}
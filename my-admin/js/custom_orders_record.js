
function client_payment_rupee(id){
    console.log(id);

    $.ajax({
        url:"./includes/fetch_order_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.orderId );
            console.log(response.totalBalance );
            $('#invoiceId').val(response.orderId);
            document.getElementById("balanceamount").innerHTML = response.totalBalance;

            $('#client_payment_rupee').unbind('submit').bind('submit',function(){
                event.preventDefault();
                
                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    // data: form.serialize(),
                    // dataType: 'json',
                    data: new FormData($('#client_payment_rupee')[0]),
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
                          $('#client_payment_rupee')[0].reset();
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

var tableRowIndex = 0, tableRowIndexCal = 0;
function worker_payment_rupee(id){
    $.ajax('./includes/fetch_order_items_array.php', {
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            console.log("Run");
            var len = response.length;
            console.log("L: "+len);
            console.log("KEY: "+id)
        
            $("#customeOrderItemTable tr").remove(); 

            for( var i=0; i<len; i++){
                var itemId = response[i]['id'];
                var name = response[i]['name'];
                var cust_name = response[i]['cust_name'];
                var purePrice = response[i]['purePrice'];
                var paidPurePrice = response[i]['paidPurePrice'];
                console.log(cust_name)
                //Worker Table
                var workerTr = document.createElement("tr");
                workerTr.innerHTML = `<td>
                                    <input type="checkbox" class="form-control form-control-sm onchange="orderItemCheckBox(${tableRowIndexCal})" name="orderItemCheckBox[]" value="${itemId}">
                                </td>
                                <td>
                                    <p id="itemName${tableRowIndexCal}">${name}</p>
                                </td> 
                                <td>
                                    <p id="snedTo${tableRowIndexCal}">${cust_name}</p>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm orderItemTotal${tableRowIndexCal}" id="orderItemTotal${tableRowIndexCal}" name="orderItemTotal[]" value="${purePrice}" readonly style="width:100%">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm orderItemTotalPaid${tableRowIndexCal}" id="orderItemTotalPaid${tableRowIndexCal}" name="orderItemTotal[]" value="${paidPurePrice}" readonly style="width:100%">
                                </td>
                                <td id="pAction">
                                    <select class="form-control custom-select workerSelection${tableRowIndexCal}" name="selectedOption[]" id="workerSelection${tableRowIndexCal}" required>
                                        <option value="SELF">SELF</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm orderItemAmount${tableRowIndexCal}" id="orderItemAmount${tableRowIndexCal}" name="orderItemAmount[]" value="0" style="width:100%">
                                </td>`;


                
                
                document.getElementById("customeOrderItemTable").appendChild(workerTr);

                workerArray(tableRowIndexCal);
                
                // set readonly field where itemTotal = paidTotal
                    var total = Number(document.getElementById("orderItemTotal"+tableRowIndexCal).value);
                    var paid = Number(document.getElementById("orderItemTotalPaid"+tableRowIndexCal).value);
                    console.log("T>"+total);
                    console.log("P>"+paid);
                    if(total == paid){
                        document.getElementById("orderItemAmount"+tableRowIndexCal).readOnly = true;
                    }
                // ... 

                tableRowIndex++;
                tableRowIndexCal = tableRowIndex;
            }


            $('#worker_payment_rupee').unbind('submit').bind('submit',function(){
                event.preventDefault();
                
                var form = $(this);
                console.log(form);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    // data: form.serialize(),
                    // dataType: 'json',
                    data: new FormData($('#worker_payment_rupee')[0]),
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
                          $('#worker_payment_rupee')[0].reset();
                        //   $("#updateButton").attr("data-dismiss","modal");
                    }
                })

                    
            })

        }
    });

}


// workers array
function workerArray(rowId){
    $.ajax('./includes/fetch_workers_array.php', {
        type: 'POST',
        // data: { key: key },
        dataType: 'json',
        success: function (response) {
            console.log("Run");
            var len = response.length;
            console.log("L: "+len);


            // $("#workerSelection"+rowId).empty();

            for( var i=0; i<len; i++){
                var id = response[i]['id'];
                var name = response[i]['name'];

                console.log("Arr Id: "+rowId);

                $("#workerSelection"+rowId).append(`<option value=`+id+`>`+name+`</option>`);
    
            }
        }
    });
}





function return_order_record(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_order_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#return_order_record_id').val(response.id);

            $('#return_order_record').unbind('submit').bind('submit',function(){
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


function worker_payment_gold(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_order_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#workerGoldInvoiceId').val(response.id);


            $('#worker_payment_gold').unbind('submit').bind('submit',function(){
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

function search_gold_scrab_item(){
    event.preventDefault();
    var key = $('#scrabItemCode').val();

    let index = 0, existingTable = $('#customeOrderScrabTable')[0].childNodes;

    var identify = true;
    while (index < existingTable.length) {
            
        if (existingTable[index].className === key) {
            updated_itemTotalByQty(key);
            identify = false;
            break;
        }
        index++;
    }

    if (identify === true ) {

        $.ajax('./includes/fetch_gold_pathor_item_by_barcode.php', {
            type: 'POST',
            data: { key: key },
            dataType: 'json',
            success: function (response) {
                console.log(response.barcode);
                priceArray[n] = response.updated_price;
                n += 1;

                var pathorRate24K = $('#workerGoldPaymentRate24K').val();

                var tola = Number(response.weight / 11.664);
                var actualPrice = Number(tola * pathorRate24K);
                var roundActualPrice = actualPrice.toFixed(0);
                console.log("P R: "+actualPrice);

                let itemClass = response.barcode.replace(/-/gi,"");
                console.log("Itm Class = "+itemClass);
                
                var tr = document.createElement("tr");
                tr.className = response[1];
                tr.innerHTML = `<td id="pId">${response.barcode}</td> 
                <td id="pKarat">
                    <input type="text" class="form-control form-control-sm workerGoldPaymentWeight${itemClass}" id="workerGoldPaymentWeight${itemClass}" name="workerGoldPaymentWeight[]">
                    <input type="hidden" name="itemKey[]" value="${response.barcode}">
                </td> 
                <td id="pTotal">
                    <input type="text" class="form-control form-control-sm workerGoldPaymentTotal${itemClass}" id="workerGoldPaymentTotal${itemClass}" name="workerGoldPaymentTotal[]" value="${roundActualPrice}" readonly>
                </td> `;

                document.getElementById("customeOrderScrabTable").appendChild(tr);

                index++;
                myNewIndex = index;
                // calculateSubTotal(itemClass);

                worker_payment_gold_func(itemClass);
                $('#scrabItemCode').val("");

            }
        })
    }
}


// function workerPayable(){
//     var workerID = $('#workerSelectForPayable').val();
//     console.log("worker: "+workerID);

//     $.ajax('./includes/fetch_worker_payable_gold.php', {
//         type: 'POST',
//         data: { workerID: workerID },
//         dataType: 'json',
//         success: function (response) {

//             console.log("response");
            

//         }
//     })
// }

function worker_payment_gold_func(rowKey){
    
    var rate24 = $('#workerGoldPaymentRate24K').val();
    var weight = Number($(`.workerGoldPaymentWeight${rowKey}`).val());
    var karat = Number($(`.workerGoldPaymentKarat${rowKey}`).val());
    console.log("W: "+weight);

    karatPrice = 0;
    if(karat == 24){
        karatPrice = rate24;
    }else{
        karatPrice = Number((rate24 / 24) * karat);
    }

    var tola = Number(weight / 11.664);
    var actualPrice = Number(tola * karatPrice);

    var roundActualweight = tola.toFixed(2);
    var roundActualPrice = actualPrice.toFixed(0);

    
    $(`.workerGoldPaymentPureWeight${rowKey}`).val(roundActualweight);
    $(`.workerGoldPaymentPurePrice${rowKey}`).val(roundActualPrice);
}



function change_order_status(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_order_record_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#change_order_status_id').val(response.id);

            $('#change_order_status').unbind('submit').bind('submit',function(){
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




// view image in order detail page
function view_order_item_image(id){
    
    console.log("id");
    console.log(id);
    $.ajax({
        url:"./includes/fetch_order_item_by_id.php",
        type:'post',
        data: {id: id },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );

            document.getElementById("imageId").src = "media/custom_order_items/"+response.image;

        },
        error: function(err){
            console.log(err);
        }
    })
}
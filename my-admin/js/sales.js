
var n = 0;
var priceArray = [];
var totalWeight = 0;
var totalWeightWithPolish = 0;
var perGramPrice = 0;
var pKarat = 0;
var finalSubTotal = 0;
var previousPolishCost = 0;
var previousLaborCost = 0;


function calculateSubTotal(item){

    let subTotal = 0;

    console.log("my new index = "+myNewIndex);
    for(var i = 0; i< myNewIndex ; i++ ){
        var itemTotal = Number($(`#${i}`).val());
        subTotal += itemTotal;
        console.log("itemTotal = "+itemTotal);
    }
    $(`#subTotalSale`).val( subTotal);
    $(`#grandTotal`).val( subTotal);

    finalSubTotal = subTotal;

    
    weight = Number($(`.weight${item}`).val());
    totalWeight += Number(weight);

    // other functions calling...
    // defaultPolishAndLabor();
    // myDefaultLaborAndPolish();
    // calPolish();
    // calLabor();
    calBeats();
    calETC();
    calDiscount();
    calPaid();

}


function myDefaultLaborAndPolish(rowId){
    var category = $(`.category${rowId}`).val();
    if(category == "GOLD"){
        var rowWeight =  Number(document.getElementsByClassName(`weight${rowId}`)[0].value);
        var rowTotal =  Number(document.getElementsByClassName(`total${rowId}`)[0].value);

        var finalSubTotal = rowTotal;
        var totalWeight = rowWeight;
        console.log("F T: "+rowWeight);


        var polishCost = 0;
        var polishInGram = 0;
        var labor = 0;

        if(totalWeight < 0.1){

            polishCost = ((finalSubTotal/100)*40);
            polishInGram = ((totalWeight/100)*40);
            labor = 2000;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(40);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(2000);
            $(`#polish`).val(40);
            $(`#labor`).val(2000);

        }else if(totalWeight >= 0.1 && totalWeight < 0.2){

            polishCost = ((finalSubTotal/100)*35);
            polishInGram = ((totalWeight/100)*35);
            labor = 1500;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(35);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(1500);
            $(`#polish`).val(35);
            $(`#labor`).val(1500);

        }else if(totalWeight >= 0.2 && totalWeight < 0.3){

            polishCost = ((finalSubTotal/100)*30);
            polishInGram = ((totalWeight/100)*30);
            labor = 1500;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(30);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(1500);
            $(`#polish`).val(30);
            $(`#labor`).val(1500);

        }else if(totalWeight >= 0.3 && totalWeight < 0.4){

            polishCost = ((finalSubTotal/100)*25);
            polishInGram = ((totalWeight/100)*25);
            labor = 1200;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(25);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(1200);
            $(`#polish`).val(25);
            $(`#labor`).val(1200);

        }else if(totalWeight >= 0.4 && totalWeight < 0.5){

            polishCost = ((finalSubTotal/100)*25);
            polishInGram = ((totalWeight/100)*25);
            labor = 800;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(25);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(800);
            $(`#polish`).val(25);
            $(`#labor`).val(800);

        }else if(totalWeight >= 0.5 && totalWeight < 0.6){

            polishCost = ((finalSubTotal/100)*20);
            polishInGram = ((totalWeight/100)*25);
            labor = 700;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(20);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(700);
            $(`#polish`).val(20);
            $(`#labor`).val(700);

        }else if(totalWeight >= 0.6 && totalWeight < 0.7){

            polishCost = ((finalSubTotal/100)*20);
            polishInGram = ((totalWeight/100)*20);
            labor = 600;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(20);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(600);
            $(`#polish`).val(20);
            $(`#labor`).val(600);

        }else if(totalWeight >= 0.7 && totalWeight < 1){

            polishCost = ((finalSubTotal/100)*20);
            polishInGram = ((totalWeight/100)*20);
            labor = 500;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(20);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(500);
            $(`#polish`).val(20);
            $(`#labor`).val(500);

        }else if(totalWeight >= 1 && totalWeight < 2){

            polishCost = ((finalSubTotal/100)*19);
            polishInGram = ((totalWeight/100)*19);
            labor = 500;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(19);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(500);
            $(`#polish`).val(19);
            $(`#labor`).val(500);

        }else if(totalWeight >= 2 && totalWeight < 3){

            polishCost = ((finalSubTotal/100)*18);
            polishInGram = ((totalWeight/100)*18);
            labor = 400;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(18);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(400);
            $(`#polish`).val(18);
            $(`#labor`).val(400);

        }else if(totalWeight >= 3 && totalWeight < 4){

            polishCost = ((finalSubTotal/100)*17);
            polishInGram = ((totalWeight/100)*17);
            labor = 400;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(17);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(400);
            $(`#polish`).val(17);
            $(`#labor`).val(400);

        }else if(totalWeight >= 4 && totalWeight < 10){

            polishCost = ((finalSubTotal/100)*16);
            polishInGram = ((totalWeight/100)*16);
            labor = 400;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(16);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(400);
            $(`#polish`).val(16);
            $(`#labor`).val(400);

        }else if(totalWeight >= 10 && totalWeight < 20){

            polishCost = ((finalSubTotal/100)*15);
            polishInGram = ((totalWeight/100)*15);
            labor = 500;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(15);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(500);
            $(`#polish`).val(15);
            $(`#labor`).val(500);

        }else{

            polishCost = ((finalSubTotal/100)*15);
            polishInGram = ((totalWeight/100)*15);
            labor = 300;
            document.getElementsByClassName(`polish${rowId}`)[0].value = Number(15);
            document.getElementsByClassName(`labor${rowId}`)[0].value = Number(300);
            $(`#polish`).val(15);
            $(`#labor`).val(300);
            
        }

        totalWeightWithPolish = totalWeight + polishInGram;
        laborCost = (totalWeightWithPolish * labor);

        previousPolishCost = Number(polishCost.toFixed(0));
        previousLaborCost = Number(laborCost.toFixed(0));

        // console.log();
        var testCP = Number(polishCost + laborCost)
        console.log("ACT RP D: "+testCP)

        var addingInGrandTotal = Number(rowTotal + polishCost + laborCost);
        var roundGrandTotal = addingInGrandTotal.toFixed(0);
        document.getElementsByClassName(`total${rowId}`)[0].value = Number(roundGrandTotal);

        previousRowTotal = roundGrandTotal;

        calculateSubTotal(rowId)

    }

}
// function myDefaultLaborAndPolish(){
//     var grandTotalVal = Number($(`#grandTotal`).val());

//     console.log("FinalSubTotal "+finalSubTotal);
//     console.log("totalWeight "+totalWeight);

//     var polishCost = 0;
//     var polishInGram = 0;
//     var labor = 0;

//     if(totalWeight < 0.1){

//         polishCost = ((finalSubTotal/100)*40);
//         polishInGram = ((totalWeight/100)*40);
//         labor = 2000;
//         $(`#polish`).val(40);
//         $(`#labor`).val(2000);

//     }else if(totalWeight >= 0.1 && totalWeight < 0.2){

//         polishCost = ((finalSubTotal/100)*35);
//         polishInGram = ((totalWeight/100)*35);
//         labor = 1500;
//         $(`#polish`).val(35);
//         $(`#labor`).val(1500);

//     }else if(totalWeight >= 0.2 && totalWeight < 0.3){

//         polishCost = ((finalSubTotal/100)*30);
//         polishInGram = ((totalWeight/100)*30);
//         labor = 1500;
//         $(`#polish`).val(30);
//         $(`#labor`).val(1500);

//     }else if(totalWeight >= 0.3 && totalWeight < 0.4){

//         polishCost = ((finalSubTotal/100)*25);
//         polishInGram = ((totalWeight/100)*25);
//         labor = 1200;
//         $(`#polish`).val(25);
//         $(`#labor`).val(1200);

//     }else if(totalWeight >= 0.4 && totalWeight < 0.5){

//         polishCost = ((finalSubTotal/100)*25);
//         polishInGram = ((totalWeight/100)*25);
//         labor = 800;
//         $(`#polish`).val(25);
//         $(`#labor`).val(800);

//     }else if(totalWeight >= 0.5 && totalWeight < 0.6){

//         polishCost = ((finalSubTotal/100)*20);
//         polishInGram = ((totalWeight/100)*25);
//         labor = 700;
//         $(`#polish`).val(20);
//         $(`#labor`).val(700);

//     }else if(totalWeight >= 0.6 && totalWeight < 0.7){

//         polishCost = ((finalSubTotal/100)*20);
//         polishInGram = ((totalWeight/100)*20);
//         labor = 600;
//         $(`#polish`).val(20);
//         $(`#labor`).val(600);

//     }else if(totalWeight >= 0.7 && totalWeight < 1){

//         polishCost = ((finalSubTotal/100)*20);
//         polishInGram = ((totalWeight/100)*20);
//         labor = 500;
//         $(`#polish`).val(20);
//         $(`#labor`).val(500);

//     }else if(totalWeight >= 1 && totalWeight < 2){

//         polishCost = ((finalSubTotal/100)*19);
//         polishInGram = ((totalWeight/100)*19);
//         labor = 500;
//         $(`#polish`).val(19);
//         $(`#labor`).val(500);

//     }else if(totalWeight >= 2 && totalWeight < 3){

//         polishCost = ((finalSubTotal/100)*18);
//         polishInGram = ((totalWeight/100)*18);
//         labor = 400;
//         $(`#polish`).val(18);
//         $(`#labor`).val(400);

//     }else if(totalWeight >= 3 && totalWeight < 4){

//         polishCost = ((finalSubTotal/100)*17);
//         polishInGram = ((totalWeight/100)*17);
//         labor = 400;
//         $(`#polish`).val(17);
//         $(`#labor`).val(400);

//     }else if(totalWeight >= 4 && totalWeight < 10){

//         polishCost = ((finalSubTotal/100)*16);
//         polishInGram = ((totalWeight/100)*16);
//         labor = 400;
//         $(`#polish`).val(16);
//         $(`#labor`).val(400);

//     }else if(totalWeight >= 10 && totalWeight < 20){

//         polishCost = ((finalSubTotal/100)*15);
//         polishInGram = ((totalWeight/100)*15);
//         labor = 500;
//         $(`#polish`).val(15);
//         $(`#labor`).val(500);

//     }else{

//         polishCost = ((finalSubTotal/100)*15);
//         polishInGram = ((totalWeight/100)*15);
//         labor = 300;
//         $(`#polish`).val(15);
//         $(`#labor`).val(300);
        
//     }

//     totalWeightWithPolish = totalWeight + polishInGram;
//     laborCost = (totalWeightWithPolish * labor);

//     previousPolishCost = Number(polishCost.toFixed(0));
//     previousLaborCost = Number(laborCost.toFixed(0));

//     // console.log();


//     var addingInGrandTotal = Number(grandTotalVal + polishCost + laborCost);
//     var roundGrandTotal = addingInGrandTotal.toFixed(0);
//     $(`#grandTotal`).val(roundGrandTotal);

//     var paid = $(`#paid`).val();
//     var grand = $(`#grandTotal`).val();
//     if(paid == 0){
//         $(`#balance`).val(grand);
//     }else{
//         var balance = Number(grand - paid);
//         $(`#balance`).val(balance);
//     }

// }


function calPolishAndLabor(rowId){
    var category = $(`.category${rowId}`).val();
    if(category == "GOLD"){
        var rowKarat =  Number(document.getElementsByClassName(`karat${rowId}`)[0].value);
        var polish = Number(document.getElementsByClassName(`polish${rowId}`)[0].value);
        var labor = Number(document.getElementsByClassName(`labor${rowId}`)[0].value);
        var rowTotal = Number(document.getElementsByClassName(`total${rowId}`)[0].value);
        var rowWeight = Number(document.getElementsByClassName(`weight${rowId}`)[0].value);
        // var finalSubTotal = rowTotal;
        var totalWeight = rowWeight;

        var polishInGram = Number((totalWeight/100)*polish);
        var totalWeightWithPolish = Number(totalWeight + polishInGram);
        var newLaborCost = Number(totalWeightWithPolish * labor);
        var roundingNewLaborCost = Number(newLaborCost.toFixed(0));
        
        var price = Number($(`#price24k`).val());
        

        if(rowKarat == 24){
            karatPriceForSelling = price;
        }else{
            karatPriceForSelling = Number((price / 24) * rowKarat);
        }

        var tola = Number(totalWeightWithPolish / 11.664);
        var actualPrice = Number(tola * karatPriceForSelling);
        var roundActualPrice = Number(actualPrice.toFixed(0));
        console.log("RAP: "+roundActualPrice)

        var addingInGrandTotal = Number(roundActualPrice + roundingNewLaborCost);
        var roundGrandTotal = addingInGrandTotal.toFixed(0);
        // $(`#grandTotal`).val(roundGrandTotal);
        document.getElementsByClassName(`total${rowId}`)[0].value = Number(roundGrandTotal);

        
        
        calculateSubTotal(rowId)
    }


}

// function calPolishAndLabor(){

//     var grandTotalVal = Number($(`#grandTotal`).val());
//     var polish = Number($(`#polish`).val());
//     var labor = Number($(`#labor`).val());
//     // var total = polish+labor;
//     var subtractFromGrandTotal = Number(grandTotalVal - previousPolishCost - previousLaborCost);
    
//     console.log("Check= "+grandTotalVal+"-"+previousPolishCost+"-"+previousLaborCost+"="+subtractFromGrandTotal);

//     var polishInGram = Number((totalWeight/100)*polish);
//     totalWeightWithPolish = Number(totalWeight + polishInGram);
//     var newLaborCost = Number(totalWeightWithPolish * labor);
//     var roundingNewLaborCost = Number(newLaborCost.toFixed(0));
    
//     var grandWithPolish = Number((finalSubTotal/100)*polish);
//     var roundingGrandPolish = Number(grandWithPolish.toFixed(0));
//     var totalGrand = Number(roundingGrandPolish + roundingNewLaborCost);
//     console.log("sub = "+roundingGrandPolish);
//     console.log("sub = "+roundingNewLaborCost);
//     console.log("sub = "+totalGrand);
    
//     // var roundingPolishGrand = roundingGrandPolish.toFixed(0);

//     previousPolishCost = roundingGrandPolish;
//     previousLaborCost = roundingNewLaborCost;

//     var addingInGrandTotal = Number(subtractFromGrandTotal + totalGrand);
//     var roundGrandTotal = addingInGrandTotal.toFixed(0);
//     $(`#grandTotal`).val(roundGrandTotal);
    

//     var paid = $(`#paid`).val();
//     var grand = $(`#grandTotal`).val();
//     if(paid == 0){
//         $(`#balance`).val(grand);
//     }else{
//         var balance = Number(grand - paid);
//         $(`#balance`).val(balance);
//     }


// }

var previousEtc = 0;
function calETC(){
    var grandTotal = Number($(`#grandTotal`).val());
    var subtractFromGrandTotal = grandTotal - previousEtc;
    var etc = Number($(`#etc`).val());
    console.log("previous etc = "+previousEtc+" previous grand = "+grandTotal);

    grandTotalCal = Number((subtractFromGrandTotal + etc));
    previousEtc = etc;

    var roundGrandTotal = grandTotalCal.toFixed(0);

    $(`#grandTotal`).val(roundGrandTotal);

    var paid = $(`#paid`).val();
    var grand = $(`#grandTotal`).val();
    if(paid == 0){
        $(`#balance`).val(grand);
    }else{
        var balance = Number(grand - paid);
        $(`#balance`).val(balance);
    }
}

var previousDiscount = 0;
function calDiscount(){
    var grandTotal = Number($(`#grandTotal`).val());
    var subtractFromGrandTotal = grandTotal + previousDiscount;
    console.log("previous etc = "+previousDiscount+" previous grand = "+grandTotal);

    // var subTotal = Number($(`#subTotal`).val());
    var discount = Number($(`#discount`).val());
    previousDiscount = discount;

    grandTotalCal = Number((subtractFromGrandTotal - discount));
    
    var roundGrandTotal = grandTotalCal.toFixed(0);

    $(`#grandTotal`).val(roundGrandTotal);

    var paid = $(`#paid`).val();
    var grand = $(`#grandTotal`).val();
    if(paid == 0){
        $(`#balance`).val(grand);
    }else{
        var balance = Number(grand - paid);
        $(`#balance`).val(balance);
    }
}


var beatsPricePrevious = 0;
function calBeats(){
    var grandTotalVal = Number($(`#grandTotal`).val());
    var subtractFromGrandTotal = grandTotalVal - beatsPricePrevious;
    
    var beatsPrice = Number($(`#beats`).val());
    beatsPricePrevious = beatsPrice;

    var addingInGrandTotal = Number(subtractFromGrandTotal + beatsPrice);
    var roundGrandTotal = addingInGrandTotal.toFixed(0);
    $(`#grandTotal`).val(roundGrandTotal);

    var paid = $(`#paid`).val();
    var grand = $(`#grandTotal`).val();
    if(paid == 0){
        $(`#balance`).val(grand);
    }else{
        var balance = Number(grand - paid);
        $(`#balance`).val(balance);
    }
}

var previousPaid = 0;
function calPaid(){
    var grandTotal = Number($(`#grandTotal`).val());
    var paid = Number($(`#paid`).val());
    var subtractFromGrandTotal = grandTotal + previousPaid;

    var balance = Number(subtractFromGrandTotal - paid);
    var roundBalance = balance.toFixed(0);

    $(`#balance`).val(roundBalance);
}

function itemTotalByQty(item) {
    console.log("run");
    console.log(item);
    var qty = $(`.qty${item}`).val();
    var price = $(`.price${item}`).val();

    console.log(qty);
    var total = price * qty;
    $(`.total${item}`).val(total);

    calculateSubTotal(item);
}

function updated_itemTotalByQty(rowKey) {
    rowKey =  rowKey.replace(/-/gi,"");
    $(`.qty${rowKey}`).val( Number($(`.qty${rowKey}`).val()) + 1);
    var qty = $(`.qty${rowKey}`).val();
    var price = $(`.price${rowKey}`).val();
    var total = price * qty;
    $(`.total${rowKey}`).val(total);

    calculateSubTotal(rowKey);

}

function handleKarat(rowKey){
    // var itemPrice = Number($(`.price${item}`).val());
    var subTotalVal = Number($(`#subTotalSale`).val());
    var previousTotalValue = Number($(`.total${rowKey}`).val());
    console.log("previousValue");
    console.log( previousTotalValue);
    Number($(`#subTotalSale`).val(  subTotalVal - previousTotalValue  ));


    console.log("Row Key "+rowKey);

    var karat = Number($(`.karat${rowKey}`).val());
    var price = Number($(`#price24k`).val());
    var silverPrice = Number($(`#silverprice24k`).val());
    var category = $(`.category${rowKey}`).val();

    console.log("category: "+category)

    pKarat = karat;

    // let karatPrice = 0;
    if(category == "GOLD"){
        if(karat == 24){
            karatPrice = price;
        }else{
            karatPrice = Number((price / 24) * karat);
        }
    }else{
        if(karat == 24){
            karatPrice = silverPrice;
        }else{
            karatPrice = Number((silverPrice / 24) * karat);
        }
    }
    
    var weight = Number($(`.weight${rowKey}`).val());
    var tola = Number(weight / 11.664);

    var actualPrice = Number(tola * karatPrice);

    var roundActualPrice = actualPrice.toFixed(0);
    $(`.price${rowKey}`).val(roundActualPrice);
    
    $(`.total${rowKey}`).val(roundActualPrice);

    calculateSubTotal(rowKey);
    console.log("Price "+price);

    // calculation of per gram price 
    perGramPrice += roundActualPrice;

    myDefaultLaborAndPolish(rowKey);

}



let index = 0;
let myNewIndex = 0;
function search_gold_stock_item() {
    event.preventDefault();
    var key = $('#searchId').val();

    if(key == ""){
        key = $('#searchId2').val();
    }
    console.log("key: "+key)

    let index = 0, existingTable = $('#cartTable')[0].childNodes;

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

        $.ajax('./includes/fetch_gold_pathor_stock_item_by_barcode.php', {
            type: 'POST',
            data: { key: key },
            dataType: 'json',
            success: function (response) {
                console.log(response.p_key);
                console.log(response.p_key)
                // priceArray[n] = response.updated_price;
                priceArray[n] = response.initial_price;
                n += 1;

                let itemClass = response.p_key.replace(/-/gi,"");
                console.log("Itm Class = "+itemClass);
                
                var tr = document.createElement("tr");
                tr.className = response[1];
                tr.innerHTML = `<td id="pId">${response.name}</td> 
                <td id="pKarat">
                    <input type="text" class="form-control form-control-sm karat${itemClass}" value="${response.karat}" onchange="handleKarat(${itemClass})" name="pKarat[]" style="width:100%">
                    <input type="hidden" class="form-control-sm weight${itemClass}" name="pWeight[]" value="${response.weight}">
                    <input type="hidden" name="pKey[]" value="${response.p_key}">
                    <input type="hidden" class="form-control-sm category${itemClass}" name="type[]" value="${response.category}">
                </td> 
                <td id="pQty">
                    <input type="text" class="form-control form-control-sm qty${itemClass}" name="pQty[]" value="1" onchange="itemTotalByQty(${itemClass})" readonly style="width:100%">
                </td>  
                <td id="pLabor">
                    <input type="text" class="form-control form-control-sm labor${itemClass}" name="pLabor[]" onchange="calPolishAndLabor(${itemClass})" style="width:100%">
                </td> 
                <td id="pPolish">
                    <input type="text" class="form-control form-control-sm polish${itemClass}" name="pPolish[]" onchange="calPolishAndLabor(${itemClass})" style="width:100%">
                </td> 
                <td id="pPrice">
                    <input type="text" class="form-control form-control-sm price${itemClass}" name="pPrice[]" readonly style="width:100%">
                </td>
                <td id="pTotal">
                    <input type="text" id="${index}" class="form-control form-control-sm total${itemClass}" name="pTotal[]" value="0"  readonly style="width:100%">
                </td> `;

                document.getElementById("cartTable").appendChild(tr);

                index++;
                myNewIndex = index;
                // calculateSubTotal(itemClass);

                // View product detail in product view card...
                $(`#regDate`).val(response.date);
                $(`#productName`).val(response.name);
                $(`#productCategory`).val(response.category);
                $(`#productDesc`).val(response.description);
                $(`#productKarat`).val(response.karat);
                $(`#productWeight`).val(response.weight+" Gram");
                $(`#productPrice`).val(response.initial_price);

                handleKarat(itemClass);
                // myDefaultLaborAndPolish(itemClass)
                $('#searchId').val("");



                $('#order_form').unbind('submit').bind('submit',function(){
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
            error: function (err) {
                console.log(err);
            }

        });

    }
}


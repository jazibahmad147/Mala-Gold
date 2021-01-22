

function addOrder(){
    $('#add_order').unbind('submit').bind('submit',function(){
        event.preventDefault();
        
        var form = $(this);
        console.log(form);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            // data: form.serialize(),
            // dataType: 'json',
            data: new FormData($('#add_order')[0]),
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
                  $('#add_order')[0].reset();
                  setTimeout(location.reload(), 3000);
                //   $("#updateButton").attr("data-dismiss","modal");
            }
        }) 
    })
}




let rowIndex = 0, rowIndexCal = 0, advanceRowIndex = 0, advanceRowIndexCal = 0, customStoneIndex = 0, customStoneIndexCal = 0;
let subTotalStone = 0, subTotalCustomStone = 0;
var subTotal = 0, grandTotal = 0, totalAdvance = 0;
var sellingPrice = 0;
var totalWeight = 0;
var previousPolishCost = 0, previousLaborCost = 0;




function addSubTotal(){
    let initialSubTotal = 0;
    let initialWeight = 0;

    console.log("my new index = "+rowIndexCal);
    for(var i = 0; i< rowIndexCal ; i++ ){
        var itemTotal = Number($(`#rowTotal${i}`).val());
        initialSubTotal += itemTotal;

        var weight = Number($(`#rowWeight${i}`).val());
        initialWeight += weight;
    }

    $(`#subTotal`).val(initialSubTotal+subTotalStone+subTotalCustomStone);
    $(`#grandTotal`).val(initialSubTotal+subTotalStone+subTotalCustomStone);

    subTotal = initialSubTotal;
    totalWeight = initialWeight;
    console.log("T W: "+initialWeight);

    addDiscount();
    // karatChangeForWorker();
}

function stoneTotalPrice(item){
    subTotalStone = 0;
    console.log("my new index = "+myNewStoneIndex);
    for(var i = 0; i< myNewStoneIndex ; i++ ){
        var itemTotal = Number($(`#stoneTotal${i}`).val());
        subTotalStone += itemTotal;
        console.log("itemTotal = "+itemTotal);
    }
    console.log("total: "+subTotalStone);
    addSubTotal();
}

function karatChangeForWorker(rowId){

    // // var weightToWorker = Number(document.getElementById(`totalWeightForWorker`).value);
    // // if(weightToWorker != 0){
    // //     totalWeight = weightToWorker;
    // // }else{
    //     var initialWeight = 0;
    //     for(var i = 0; i< rowIndexCal ; i++ ){
    //         var rowWeight = Number($(`#rowWeight${i}`).val());
    //         initialWeight += rowWeight;
    //     }
    //     totalWeight = initialWeight;
    // // }

    var weight =  Number(document.getElementsByClassName(`pWeight${rowId}`)[0].value);

    var karat = Number(document.getElementsByClassName(`itemKarat${rowId}`)[0].value);
    // var rp = Number(document.getElementsByClassName(`itemRP${rowId}`)[0].value);
    // var moti = Number(document.getElementsByClassName(`itemMoti${rowId}`)[0].value);
    var etc = Number(document.getElementsByClassName(`itemETC${rowId}`)[0].value);

    var pureWeight = Number((weight / 24) * (karat));
    var roundPureWeight = pureWeight.toFixed(2);

    karatPriceForSelling = Number((sellingPrice / 24) * karat);
    var tola = Number(roundPureWeight / 11.664);
    var actualPrice = Number(tola * karatPriceForSelling);
    var actualPriceTotal = Number(actualPrice + etc);
    var roundActualPrice = actualPriceTotal.toFixed(0);

    // document.getElementById(`totalWeightForWorker`).value = Number(roundPureWeight);
    // document.getElementById(`payableAmountForWorker`).value = Number(roundActualPrice);
    document.getElementsByClassName(`itemWeight${rowId}`)[0].value = Number(roundPureWeight);
    document.getElementsByClassName(`itemPrice${rowId}`)[0].value = Number(roundActualPrice);
}



function handelingKarat(rowId){
    
    var weight =  Number(document.getElementsByClassName(`pWeight${rowId}`)[0].value);
    // var price =  Number(document.getElementsByClassName(`pPrice${rowId}`)[0].value);
    var karat =  Number(document.getElementsByClassName(`pKarat${rowId}`)[0].value);
    var etc =  Number(document.getElementsByClassName(`pETC${rowId}`)[0].value);
    
    
    if(karat == 24){
        karatPriceForSelling = sellingPrice;
    }else{
        karatPriceForSelling = Number((sellingPrice / 24) * karat);
    }

    var tola = Number(weight / 11.664);
    var actualPrice = Number(tola * karatPriceForSelling);
    var actualPriceWithETC = Number(actualPrice + etc);
    var roundActualPrice = actualPriceWithETC.toFixed(0);

    document.getElementsByClassName(`pTotal${rowId}`)[0].value = Number(roundActualPrice);
    // document.getElementsByClassName(`pPrice${rowId}`)[0].value = Number(karatPriceForSelling);
    console.log("ACT RP: "+roundActualPrice);


    // calculating subtotal 
    addSubTotal();
    defaultPLBE(rowId);
    karatChangeForWorker(rowId);
    
}



var oldAdvanceGold = 0;
function addAdvance(rowId){

    $.ajax('./includes/fetch_gold_pathor_rate.php', {
        type: 'POST',
        // data: { key: key },
        dataType: 'json',
        success: function (response) {

            var buying24 = response.buying;
            console.log(buying24);
            // document.getElementById("buyingPrice").value = buying24;

            var rowKarat =  Number(document.getElementsByClassName(`advPKarat${rowId}`)[0].value);
            var rowWeight =  Number(document.getElementsByClassName(`advPWeight${rowId}`)[0].value);
            var rowDust =  Number(document.getElementsByClassName(`advPDust${rowId}`)[0].value);
            var rowRatiMashy =  Number(document.getElementsByClassName(`advPRatiMashy${rowId}`)[0].value);
            var rowNag =  Number(document.getElementsByClassName(`advPNag${rowId}`)[0].value);
            var rowLabFee =  Number(document.getElementsByClassName(`advPLabFee${rowId}`)[0].value);
            var rowETC =  Number(document.getElementsByClassName(`advPETC${rowId}`)[0].value);
            var rowDiscount =  Number(document.getElementsByClassName(`advPDiscount${rowId}`)[0].value);

            // var advanceGoldKarat = Number($(`#advanceGoldKarat`).val());
            // var advanceGoldWeight = Number($(`#advanceGoldWeight`).val());
            // var advanceGoldDust = Number($(`#advanceGoldDust`).val());
            // var advanceGoldRatiMashy = Number($(`#advanceGoldRatiMashy`).val());
            // var advanceGoldNag = Number($(`#advanceGoldNag`).val());
            // var advanceGoldETC = Number($(`#advanceGoldETC`).val());
            // var advanceGoldDiscount = Number($(`#advanceGoldDiscount`).val());

            var finalWeight = 0
            var weightWithoutDust = Number(rowWeight-rowDust);
            if(rowRatiMashy != 0){
                ratiMashyPercent = Number((weightWithoutDust / 100) * rowRatiMashy);
                finalWeightWihoutRounding = Number(weightWithoutDust - ratiMashyPercent);
                finalWeight = finalWeightWihoutRounding.toFixed(2);
                console.log("F W: "+finalWeight);
            }else{
                finalWeight = weightWithoutDust;
            }

            if(rowNag != 0){
                finalWeight = Number(finalWeight - rowNag);
            }

            console.log("F W: "+finalWeight);

            if(rowKarat == 24){
                karatPrice = buying24;
            }else{
                karatPrice = Number((buying24 / 24) * rowKarat);
            }
        
            // advance in gold 
            var tola = Number(finalWeight / 11.664);
            var actualPrice = Number(tola * karatPrice);
            var actualPriceWithETC = Number((actualPrice + rowDiscount) - rowLabFee - rowETC);
            var roundActualPrice = actualPriceWithETC.toFixed(0);
            // $(`#advanceGoldPrice`).val(roundActualPrice);
            
            document.getElementsByClassName(`advPTotal${rowId}`)[0].value = Number(roundActualPrice);
            // document.getElementsByClassName(`advPTotal${rowId}`)[0].value = Number(roundActualPrice);
            console.log(roundActualPrice);

        
            // advance in rupee 
            // var advanceRupee = Number($(`#advanceRupee`).val());

            // Adding rupee and gold price of advance
            // var myAdvance = Number(advanceRupee + actualPriceWithETC);
            // roundTotalAdvance = myAdvance.toFixed(0);
            


            // // calculating Total Advance 
            // var grandTotal = Number($(`#grandTotal`).val());
            // var totalBalance = Number(grandTotal - roundTotalAdvance);



            // $(`#totalAdvance`).val(roundTotalAdvance);
            // $(`#totalBalance`).val(totalBalance);

            // //total weight calculation
            // var pureOfAdvanceFinalWeight = Number((finalWeight / 24) * (advanceGoldKarat));
            // // var subtractionFromTotalWeight = totalWeight - pureOfAdvanceFinalWeight + oldAdvanceGold;
            // var subtractionFromTotalWeight = totalWeight - oldAdvanceGold;
            // totalWeight = subtractionFromTotalWeight;
            // oldAdvanceGold = advanceGoldWeight;
            // karatChangeForWorker();
            advanceAddingInGrands();

        },
        error: function (err) {
            console.log(err);
        }

    });

}

function advanceAddingInGrands(){


    var rowTotal = 0;

    for(var i = 0; i < advanceRowIndexCal; i++ ){
        var itemTotal = Number($(`#advPTotal${i}`).val());
        rowTotal += itemTotal;
    }
    
    // advance in rupee 
    var advanceRupee = Number($(`#advanceRupee`).val());
    var totalAdvance = Number(rowTotal + advanceRupee);
    roundTotalAdvance = totalAdvance.toFixed(0);
    console.log("ACT: "+roundTotalAdvance);

    // calculating Total Advance 
    var grandTotal = Number($(`#grandTotal`).val());
    var totalBalance = Number(grandTotal - roundTotalAdvance);

    $(`#totalAdvance`).val(roundTotalAdvance);
    $(`#totalBalance`).val(totalBalance);

}

function defaultPLBE(rowId){
    // console.log(totalWeight);
    var rowWeight =  Number(document.getElementsByClassName(`pWeight${rowId}`)[0].value);
    var rowTotal =  Number(document.getElementsByClassName(`pTotal${rowId}`)[0].value);

    var finalSubTotal = rowTotal;
    var totalWeight = rowWeight;
    console.log("F T: "+finalSubTotal);

    var polishCost = 0;
    var polishInGram = 0;
    var labor = 0;

    if(totalWeight < 0.1){

        polishCost = ((finalSubTotal/100)*40);
        polishInGram = ((totalWeight/100)*40);
        labor = 2000;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(40);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(2000);
        $(`#polish`).val(40);
        $(`#labor`).val(2000);

    }else if(totalWeight >= 0.1 && totalWeight < 0.2){

        polishCost = ((finalSubTotal/100)*35);
        polishInGram = ((totalWeight/100)*35);
        labor = 1500;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(35);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(1500);
        $(`#polish`).val(35);
        $(`#labor`).val(1500);

    }else if(totalWeight >= 0.2 && totalWeight < 0.3){

        polishCost = ((finalSubTotal/100)*30);
        polishInGram = ((totalWeight/100)*30);
        labor = 1500;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(30);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(1500);
        $(`#polish`).val(30);
        $(`#labor`).val(1500);

    }else if(totalWeight >= 0.3 && totalWeight < 0.4){

        polishCost = ((finalSubTotal/100)*25);
        polishInGram = ((totalWeight/100)*25);
        labor = 1200;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(25);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(1200);
        $(`#polish`).val(25);
        $(`#labor`).val(1200);

    }else if(totalWeight >= 0.4 && totalWeight < 0.5){

        polishCost = ((finalSubTotal/100)*25);
        polishInGram = ((totalWeight/100)*25);
        labor = 800;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(25);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(800);
        $(`#polish`).val(25);
        $(`#labor`).val(800);

    }else if(totalWeight >= 0.5 && totalWeight < 0.6){

        polishCost = ((finalSubTotal/100)*20);
        polishInGram = ((totalWeight/100)*25);
        labor = 700;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(20);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(700);
        $(`#polish`).val(20);
        $(`#labor`).val(700);

    }else if(totalWeight >= 0.6 && totalWeight < 0.7){

        polishCost = ((finalSubTotal/100)*20);
        polishInGram = ((totalWeight/100)*20);
        labor = 600;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(20);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(600);
        $(`#polish`).val(20);
        $(`#labor`).val(600);

    }else if(totalWeight >= 0.7 && totalWeight < 1){

        polishCost = ((finalSubTotal/100)*20);
        polishInGram = ((totalWeight/100)*20);
        labor = 500;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(20);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(500);
        $(`#polish`).val(20);
        $(`#labor`).val(500);

    }else if(totalWeight >= 1 && totalWeight < 2){

        polishCost = ((finalSubTotal/100)*19);
        polishInGram = ((totalWeight/100)*19);
        labor = 500;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(19);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(500);
        $(`#polish`).val(19);
        $(`#labor`).val(500);

    }else if(totalWeight >= 2 && totalWeight < 3){

        polishCost = ((finalSubTotal/100)*18);
        polishInGram = ((totalWeight/100)*18);
        labor = 400;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(18);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(400);
        $(`#polish`).val(18);
        $(`#labor`).val(400);

    }else if(totalWeight >= 3 && totalWeight < 4){

        polishCost = ((finalSubTotal/100)*17);
        polishInGram = ((totalWeight/100)*17);
        labor = 400;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(17);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(400);
        $(`#polish`).val(17);
        $(`#labor`).val(400);

    }else if(totalWeight >= 4 && totalWeight < 10){

        polishCost = ((finalSubTotal/100)*16);
        polishInGram = ((totalWeight/100)*16);
        labor = 400;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(16);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(400);
        $(`#polish`).val(16);
        $(`#labor`).val(400);

    }else if(totalWeight >= 10 && totalWeight < 20){

        polishCost = ((finalSubTotal/100)*15);
        polishInGram = ((totalWeight/100)*15);
        labor = 500;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(15);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(500);
        $(`#polish`).val(15);
        $(`#labor`).val(500);

    }else{

        polishCost = ((finalSubTotal/100)*15);
        polishInGram = ((totalWeight/100)*15);
        labor = 300;
        document.getElementsByClassName(`pPolish${rowId}`)[0].value = Number(15);
        document.getElementsByClassName(`pLabor${rowId}`)[0].value = Number(300);
        $(`#polish`).val(15);
        $(`#labor`).val(300);
        
    }

    console.log("PG: "+polishInGram)
    console.log("PC: "+polishCost)

    totalWeightWithPolish = totalWeight + polishInGram;
    laborCost = (totalWeightWithPolish * labor);

    previousPolishCost = Number(polishCost.toFixed(0));
    previousLaborCost = Number(laborCost.toFixed(0));

    // console.log();
    var testCP = Number(polishCost + laborCost)
    console.log("ACT RP D: "+testCP)

    // var grandTotalVal = Number($(`#grandTotal`).val());
    var addingInGrandTotal = Number(rowTotal + polishCost + laborCost);
    var roundGrandTotal = addingInGrandTotal.toFixed(0);
    // $(`#grandTotal`).val(roundGrandTotal);
    // $(`#subTotal`).val(roundGrandTotal);
    document.getElementsByClassName(`pTotal${rowId}`)[0].value = Number(roundGrandTotal);

    previousRowTotal = roundGrandTotal;

    // console.log("GT: "+grandTotalVal);

    // var totalAdvance = ($(`#totalAdvance`).val());
    // var grand = $(`#grandTotal`).val();
    // if(totalAdvance == 0){
    //     $(`#totalBalance`).val(grand);
    // }else{
    //     var balance = Number(grand - totalAdvance);
    //     $(`#totalBalance`).val(balance);
    // }
    addSubTotal();

}

var previousRowTotal = 0;
function handlingPLEB(rowId){

    var grandTotalVal = Number($(`#grandTotal`).val());
    // var polish = Number($(`#polish`).val());
    // var labor = Number($(`#labor`).val());
    var rowKarat =  Number(document.getElementsByClassName(`pKarat${rowId}`)[0].value);
    var rowETC =  Number(document.getElementsByClassName(`pETC${rowId}`)[0].value);
    var rowBeats =  Number(document.getElementsByClassName(`pBeats${rowId}`)[0].value);
    var polish = Number(document.getElementsByClassName(`pPolish${rowId}`)[0].value);
    var labor = Number(document.getElementsByClassName(`pLabor${rowId}`)[0].value);
    var rowTotal = Number(document.getElementsByClassName(`pTotal${rowId}`)[0].value);
    var rowWeight = Number(document.getElementsByClassName(`pWeight${rowId}`)[0].value);
    // var finalSubTotal = rowTotal;
    var totalWeight = rowWeight;
    // var total = polish+labor;

    // var subtractFromGrandTotal = Number(rowTotal - previousRowTotal);
    // console.log("PRE: "+previousRowTotal)
    // console.log("Check= "+grandTotalVal+"-"+previousPolishCost+"-"+previousLaborCost+"="+subtractFromGrandTotal);

    var polishInGram = Number((totalWeight/100)*polish);
    var totalWeightWithPolish = Number(totalWeight + polishInGram);
    var newLaborCost = Number(totalWeightWithPolish * labor);
    var roundingNewLaborCost = Number(newLaborCost.toFixed(0));
    
    // var grandWithPolish = Number((finalSubTotal/100)*polish);
    // var roundingGrandPolish = Number(grandWithPolish.toFixed(0));
    // var totalGrand = Number(roundingGrandPolish + roundingNewLaborCost);
    // console.log("PG = "+totalWeightWithPolish);
    // console.log("PC = "+roundingGrandPolish);
    // console.log("sub = "+roundingNewLaborCost);
    // console.log("sub = "+totalGrand);

    if(rowKarat == 24){
        karatPriceForSelling = sellingPrice;
    }else{
        karatPriceForSelling = Number((sellingPrice / 24) * rowKarat);
    }

    var tola = Number(totalWeightWithPolish / 11.664);
    var actualPrice = Number(tola * karatPriceForSelling);
    var actualPriceWithETC = Number(actualPrice + rowETC + rowBeats);
    var roundActualPrice = Number(actualPriceWithETC.toFixed(0));
    console.log("RAP: "+roundActualPrice)
    // console.log("RAT: "+totalGrand)
    
    // var roundingPolishGrand = roundingGrandPolish.toFixed(0);

    // previousPolishCost = roundingGrandPolish;
    // previousLaborCost = roundingNewLaborCost;

    // var addingInGrandTotal = Number(subtractFromGrandTotal + totalGrand);
    var addingInGrandTotal = Number(roundActualPrice + roundingNewLaborCost);
    var roundGrandTotal = addingInGrandTotal.toFixed(0);
    // $(`#grandTotal`).val(roundGrandTotal);
    document.getElementsByClassName(`pTotal${rowId}`)[0].value = Number(roundGrandTotal);

    
    // previousRowTotal = roundGrandTotal;
    

    // var totalAdvance = $(`#totalAdvance`).val();
    // var grand = $(`#grandTotal`).val();
    // if(totalAdvance == 0){
    //     $(`#totalBalance`).val(grand);
    // }else{
    //     var balance = Number(grand - totalAdvance);
    //     $(`#totalBalance`).val(balance);
    // }
    
    addSubTotal();


}



var previousDiscount = 0;
function addDiscount(){
    
    var grandTotal = Number($(`#grandTotal`).val());
    var subTotal = Number($(`#subTotal`).val());
    var discount = Number($(`#totalDiscount`).val());
    var paid = Number($(`#totalAdvance`).val());
    var balance = Number(subTotal-discount-paid);
    var grand = Number(subTotal-discount);
    Number($(`#grandTotal`).val(grand));
    Number($(`#totalBalance`).val(balance));

    // var subtractFromGrandTotal = Number(grandTotal + previousDiscount);
    // console.log("previous disc = "+previousDiscount+" previous grand = "+grandTotal);

    // // var subTotal = Number($(`#subTotal`).val());
    // var discount = Number($(`#totalDiscount`).val());
    // previousDiscount = discount;

    // grandTotalCal = Number((subtractFromGrandTotal - discount));
    
    // var roundGrandTotal = grandTotalCal.toFixed(0);

    // $(`#grandTotal`).val(roundGrandTotal);

    // var totalAdvance = $(`#totalAdvance`).val();
    // var grand = $(`#grandTotal`).val();
    // if(totalAdvance == 0){
    //     $(`#totalBalance`).val(grand);
    // }else{
    //     var balance = Number(grand - paid);
    //     $(`#totalBalance`).val(balance);
    // }
}




// adding order table row
function addNewOrderRow(){

    // console.log(rowIndexCal);

    $.ajax('./includes/fetch_gold_pathor_rate.php', {
        type: 'POST',
        // data: { key: key },
        dataType: 'json',
        success: function (response) {

            console.log("Today's Rate = "+response.selling);

            // price creation according to 21 karat
            var price24 = response.selling;
            sellingPrice = price24;
            var priceFixed = ((price24 / 24) * 21);
            var roundActualPrice = priceFixed.toFixed(0);
            
            document.getElementById("sellingPrice").value = price24;

            var tr = document.createElement("tr");
            tr.innerHTML = `<td id="pName">
                            <input type="text" id="pName${rowIndex}" class="form-control form-control-sm pName${rowIndexCal}" name="pName[]" oninput="this.value = this.value.toUpperCase()" onchange="writeName(${rowIndexCal})" style="width:100%">
                        </td> 
                        <td id="pDesc">
                            <textarea type="text" class="form-control form-control-sm " name="pDesc[]" oninput="this.value = this.value.toUpperCase()" placeholder="Description" style="width:100%"></textarea>
                        </td>
                        <td id="pSize">
                            <input type="text" class="form-control form-control-sm pSize${rowIndexCal}" name="pSize[]" style="width:100%">
                        </td> 
                        <td id="pKarat">
                            <input type="text" class="form-control form-control-sm pKarat${rowIndexCal}" value="21" onchange="handelingKarat(${rowIndexCal})" name="pKarat[]" style="width:100%">
                        </td> 
                        <td id="pWeight">
                            <input type="text" id="rowWeight${rowIndex}" class="form-control form-control-sm pWeight${rowIndexCal}" onchange="handelingKarat(${rowIndexCal})" name="pWeight[]" value="0" style="width:100%">
                        </td> 
                        <td id="pPolish">
                            <input type="text" id="rowPolish${rowIndex}" class="form-control form-control-sm pPolish${rowIndexCal}" onchange="handlingPLEB(${rowIndexCal})" name="pPolish[]" value="0" style="width:100%">
                        </td> 
                        <td id="pLabor">
                            <input type="text" id="rowLabor${rowIndex}" class="form-control form-control-sm pLabor${rowIndexCal}" onchange="handlingPLEB(${rowIndexCal})" name="pLabor[]" value="0" style="width:100%">
                        </td> 
                        <td id="pBeats" style="display: none;">
                            <input type="text" id="rowBeats${rowIndex}" class="form-control form-control-sm pBeats${rowIndexCal}" onchange="handlingPLEB(${rowIndexCal})" name="pBeats[]" value="0" style="width:100%">
                        </td> 
                        <td id="pETC">
                            <input type="text" class="form-control form-control-sm pETC${rowIndexCal}" onchange="handlingPLEB(${rowIndexCal})" name="pETC[]" value="0" style="width:100%">
                        </td> 
                        <td id="pTotal">
                            <input type="text" id="rowTotal${rowIndex}" class="form-control form-control-sm pTotal${rowIndexCal} " name="pTotal[]" value="0" readonly style="width:100%">
                        </td>
                        <td id="pImage">
                            <input type="file" class="form-control-sm" name="fileToUpload[]" style="width:100%">
                        </td>`;

            document.getElementById("orderTable").appendChild(tr);



            //Worker Table
            var workerTr = document.createElement("tr");
            workerTr.innerHTML = `<td>
                                <p id="itemName${rowIndexCal}"></p>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm itemKarat${rowIndexCal}" onchange="karatChangeForWorker(${rowIndexCal})" name="workerKarat[]" value="24" style="width:100%">
                            </td> 
                            <td>
                                <input type="text" class="form-control form-control-sm itemETC${rowIndexCal}" onchange="karatChangeForWorker(${rowIndexCal})" name="workerETC[]" value="0" style="width:100%">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm itemWeight${rowIndexCal}" onchange="handlingPLEB(${rowIndexCal})" name="pureWeight[]" value="0" style="width:100%" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm itemPrice${rowIndexCal}" name="purePrice[]" value="0" style="width:100%" readonly>
                            </td>
                            <td id="pAction">
                                <select class="form-control custom-select workerSelection${rowIndexCal}" name="selectedOption[]" id="workerSelection${rowIndexCal}" required>
                                    <option value="SELF">SELF</option>
                                </select>
                            </td>`;

                            // removedField =`
                            // <td>
                            //     <input type="text" class="form-control form-control-sm itemRP${rowIndexCal}" onchange="karatChangeForWorker(${rowIndexCal})" name="rp[]" value="0" style="width:100%">
                            // </td>
                            // <td>
                            //     <input type="text" class="form-control form-control-sm itemMoti${rowIndexCal}" onchange="karatChangeForWorker(${rowIndexCal})" name="moti[]" value="0" style="width:100%">
                            // </td>`;

            document.getElementById("workerTable").appendChild(workerTr);


            workerArray(rowIndexCal);
            
            rowIndex++;
            rowIndexCal = rowIndex;

            addOrder();
        },
        error: function (err) {
            console.log(err);
        }

    });

}


function writeName(rowId){
    var name = document.getElementById("pName"+rowId).value;
    console.log(name);

    document.getElementById("itemName"+rowId).innerHTML = name;
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

                $("#workerSelection"+rowId).append(`<option value=`+id+`>`+name+`</option>`);
    
            }
        }
    });
}


// // rule for self and worker
// document.getElementById("selfForm").style.display = "none";
// $('input:radio[name="sendingOption"]').change(
//     function(){
//         if ($(this).is(':checked') && $(this).val() == 'workerChecked') {
//             document.getElementById("workerForm").style.display = "flex";
//             document.getElementById("selfForm").style.display = "none";
//         }
//         else if($(this).is(':checked') && $(this).val() == 'selfChecked'){
//             document.getElementById("selfForm").style.display = "flex";
//             document.getElementById("workerForm").style.display = "none";
//         }
//     }
// );

// advance rows adding 
function addNewAdvanceRow(){
    $.ajax('./includes/fetch_gold_pathor_rate.php', {
        type: 'POST',
        // data: { key: key },
        dataType: 'json',
        success: function (response) {
            var buying24 = response.buying;
            console.log(buying24);
            document.getElementById("buyingPrice").value = buying24;

            var tr = document.createElement("tr");
            tr.innerHTML = `<td>
                                <input type="text" id="advPName${advanceRowIndex}" class="form-control form-control-sm advPName${advanceRowIndexCal}" name="advPName[]" oninput="this.value = this.value.toUpperCase()" style="width:100%">
                            </td>
                            <td>
                                <select id="advProductType${advanceRowIndex}" class="form-control form-control-sm advProductType${advanceRowIndexCal}" name="advProductType[]" required>
                                    <option value="">SELECT</option>
                                    <option value="NECKLACE">NECKLACE</option>
                                    <option value="NECKLACE">NECKLACE</option>
                                    <option value="CHORIAN">CHORIAN</option>
                                    <option value="BARACELET">BARACELET</option>
                                    <option value="RINGS">RINGS</option>
                                    <option value="MEN GOLD RING">MEN GOLD RING</option>
                                    <option value="CHILD GOLD RING">CHILD GOLD RING</option>
                                    <option value="NOSEPIN">NOSEPIN</option>
                                    <option value="NATHLIAN">NATHLIAN</option>
                                    <option value="TOPS">TOPS</option>
                                    <option value="EARING">EARING</option>
                                    <option value="BALIAN">BALIAN</option>
                                    <option value="CHAIN">CHAIN</option>
                                    <option value="MALA SET">MALA SET</option>
                                    <option value="DIAMOND JEWELLERY">DIAMOND JEWELLERY</option>
                                    <option value="SILVER JEWELLERY">SILVER JEWELLERY</option>
                                    <option value="GOLD JEWELLERY">GOLD JEWELLERY</option>
                                    <option value="GEMSTONES">GEMSTONES</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" id="advPKarat${advanceRowIndex}" class="form-control form-control-sm advPKarat${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPKarat[]" value="19.5" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPWeight${advanceRowIndex}" class="form-control form-control-sm advPWeight${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPWeight[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPDust${advanceRowIndex}" class="form-control form-control-sm advPDust${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPDust[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPRatiMashy${advanceRowIndex}" class="form-control form-control-sm advPRatiMashy${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPRatiMashy[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPNag${advanceRowIndex}" class="form-control form-control-sm advPNag${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPNag[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPLabFee${advanceRowIndex}" class="form-control form-control-sm advPLabFee${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPLabFee[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPETC${advanceRowIndex}" class="form-control form-control-sm advPETC${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPETC[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPDiscount${advanceRowIndex}" class="form-control form-control-sm advPDiscount${advanceRowIndexCal}" onchange="addAdvance(${advanceRowIndex})" name="advPDiscount[]" style="width:100%">
                            </td>
                            <td>
                                <input type="text" id="advPTotal${advanceRowIndex}" class="form-control form-control-sm advPTotal${advanceRowIndexCal}" name="advPTotal[]" style="width:100%" readonly>
                            </td>
                            <td>
                                <input type="file" class="form-control-sm" name="advFileToUpload[]" style="width:100%">
                            </td>`;

            document.getElementById("advanceTable").appendChild(tr);


            advanceRowIndex++;
            advanceRowIndexCal = advanceRowIndex;
        },
        error: function (err) {
            console.log(err);
        }
    });

}

function customStoneTotalPrice(item){
    subTotalCustomStone = 0;
    console.log("my new index = "+myNewCustomStoneIndex);
    for(var i = 0; i < myNewCustomStoneIndex; i++ ){
        var itemTotal = Number($(`#customStoneTotal${i}`).val());
        subTotalCustomStone += itemTotal;
        console.log("itemTotal = "+itemTotal);
    }
    console.log("total= "+subTotalCustomStone);
    addSubTotal();
}

function customStoneCalculator(rowIndex){
    var weight = Number($(`.customStoneWeight${rowIndex}`).val());
    var price = Number($(`.customStonePrice${rowIndex}`).val());
    var total = Number(weight * price);
    $(`.customStoneTotal${rowIndex}`).val(total);
    console.log("Custom Total: "+total)
    customStoneTotalPrice(rowIndex);
}

function addNewStoneRow(){
    var tr = document.createElement("tr");
    tr.innerHTML = `<td>
                        <input type="text" id="customStoneName${customStoneIndex}" class="form-control form-control-sm customStoneName${customStoneIndexCal}" name="customStoneName[]" oninput="this.value = this.value.toUpperCase()" style="width:100%">
                    </td>
                    <td>
                        <input type="text" id="customStoneWeight${customStoneIndex}" class="form-control form-control-sm customStoneWeight${customStoneIndexCal}" onchange="customStoneCalculator(${customStoneIndex})" name="customStoneWeight[]" style="width:100%">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="customStonePriceBought[]" style="width:100%">
                    </td>
                    <td>
                        <input type="text" id="customStonePrice${customStoneIndex}" class="form-control form-control-sm customStonePrice${customStoneIndexCal}" onchange="customStoneCalculator(${customStoneIndex})" name="customStonePrice[]" style="width:100%">
                    </td>
                    <td>
                        <input type="text" id="customStoneTotal${customStoneIndex}" class="form-control form-control-sm customStoneTotal${customStoneIndexCal}" name="customStoneTotal[]" readonly style="width:100%">
                    </td>`;

    document.getElementById("addCustomStones").appendChild(tr);


    customStoneIndex++;
    customStoneIndexCal = customStoneIndex;
    myNewCustomStoneIndex = customStoneIndex;

}
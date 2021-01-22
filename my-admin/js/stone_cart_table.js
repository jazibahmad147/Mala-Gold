
// Stone functions

let stoneIndex = 0;
var priceArraySilver = [];
let myNewStoneIndex = 0;
let myNewCustomStoneIndex = 0;

function stoneTotalPriceSaleForm(item){
    let subTotalSilver = 0;
    console.log("my new index = "+myNewStoneIndex);
    for(var i = 0; i< myNewStoneIndex ; i++ ){
        var itemTotal = Number($(`#stoneTotal${i}`).val());
        subTotalSilver += itemTotal;
        console.log("itemTotal = "+itemTotal);
    }
    $(`#beats`).val(subTotalSilver);
    calBeats();
}


function priceTotal(rowKey){
    var qty = Number($(`.stoneQty${rowKey}`).val());
    var price = Number($(`.stonePrice${rowKey}`).val());
    var total = Number(qty * price);
    $(`.stoneTotal${rowKey}`).val(total);

    var url = window.location.href;
    var urlName = url.substring(url.length - 24);
    if(urlName == "new_pathor_sale_form.php"){
        stoneTotalPriceSaleForm(rowKey);
    }else{
        stoneTotalPrice(rowKey);
    }

}

function updated_itemTotalByQtySilver(rowKey) {
    rowKey =  rowKey.replace(/-/gi,"");
    $(`.stoneQty${rowKey}`).val( Number($(`.stoneQty${rowKey}`).val()) + 1);
    var qty = $(`.stoneQty${rowKey}`).val();
    var price = $(`.stonePrice${rowKey}`).val();
    var total = price * qty;
    $(`.stoneTotal${rowKey}`).val(total);

    stoneTotalPrice(rowKey);

}


function search_stone() {
    event.preventDefault();
    var barcode = $('#searchStoneId').val();

    console.log("barcode: "+barcode)

    let stoneIndex = 0, existingTableSilver = $('#stoneTable')[0].childNodes;

    var identify = true;
    while (stoneIndex < existingTableSilver.length) {
            
        if (existingTableSilver[stoneIndex].silverItemClass === barcode) {
            updated_itemTotalByQtySilver(barcode);
            identify = false;
            break;
        }
        stoneIndex++;
    }


    if (identify === true ) {

        $.ajax('./includes/fetch_stone_stock_item_by_barcode.php', {
            type: 'POST',
            data: { barcode: barcode },
            dataType: 'json',
            success: function (response) {
                console.log(response.barcode);
                priceArraySilver[n] = response.price;
                n += 1;

                let silverItemClass = response.barcode.replace(/-/gi,"");
                console.log("Itm Class = "+silverItemClass);
                
                var tr = document.createElement("tr");
                tr.silverItemClass = response[1];
                tr.innerHTML = `<td id="stoneName">${response.name}</td> 
                <td id="stoneQty">
                    <input type="text" class="form-control form-control-sm stoneQty${silverItemClass}" name="stoneWeight[]" value="1" onchange="priceTotal(${silverItemClass})" style="width:100%">
                    <input type="hidden" name="stoneBarcode[]" value="${response.barcode}">
                </td> 
                <td id="stonePrice">
                    <input type="text" class="form-control form-control-sm stonePrice${silverItemClass}" name="stonePrice[]" value="0" onchange="priceTotal(${silverItemClass})" style="width:100%">
                </td> 
                <td id="stoneTotal">
                    <input type="text" id="stoneTotal${stoneIndex}" class="form-control form-control-sm stoneTotal${silverItemClass}" name="stoneTotal[]" value="0"  readonly style="width:100%">
                </td> `;

                document.getElementById("stoneTable").appendChild(tr);

                stoneIndex++;
                myNewStoneIndex = stoneIndex;

                priceTotal(silverItemClass);
                $('#searchStoneId').val("");



            },
            error: function (err) {
                console.log(err);
            }

        });

    }
}

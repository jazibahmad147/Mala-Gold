// add in stock 
$("#add_scrab_stock").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#add_scrab_stock')[0]),
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


function calPricing(){


    var category = $(`#category`).val();

    var path = "";
    if(category == "PATHOR"){
        path = "fetch_gold_pathor_rate.php";
    }else if(category == "PIECE"){
        path = "fetch_gold_piece_rate.php";
    }else if(category == "SILVER"){
        path = "fetch_gold_silver_rate.php";
    }

    console.log("Path: "+path);

    $.ajax('./includes/'+path, {
        type: 'POST',
        // data: { date: date },
        dataType: 'json',
        success: function (response) {
            console.log('Today rate: '+response.buying);
            todayBuying = response.buying;

            var weight = Number($(`#weight`).val());
            var karat = Number($(`#karat`).val());
            var dust = Number($(`#dust`).val());
            var ratiMashy = Number($(`#ratiMashy`).val());
            var nag = Number($(`#nag`).val());
            var discount = Number($(`#discount`).val());
            var etc = Number($(`#etc`).val());
            var labFee = Number($(`#labFee`).val());
            var karatPrice = 0;
            var karatPrice25 = 0;
            var karatPrice50 = 0;
            var karatPrice75 = 0;

            // var finalWeight = (weight - etc);
            var finalWeight = 0
            var weightWithoutDust = Number(weight-dust);
            if(ratiMashy != 0){
                ratiMashyPercent = Number((weightWithoutDust / 100) * ratiMashy);
                finalWeightWihoutRounding = Number(weightWithoutDust - ratiMashyPercent);
                finalWeight = finalWeightWihoutRounding.toFixed(2);
                console.log("F W: "+finalWeight);
            }else{
                finalWeight = weightWithoutDust;
            }

            if(nag != 0){
                finalWeight = Number(finalWeight - nag);
                console.log("Nug: "+finalWeight);
            }

            console.log("final Weight: "+finalWeight);


            if(karat == 24){
                karatPrice = todayBuying;
                karatPrice25 = Number((todayBuying / 24) * (karat - 0.25));
                karatPrice50 = Number((todayBuying / 24) * (karat - 0.50));
                karatPrice75 = Number((todayBuying / 24) * (karat - 0.75));
            }else{
                karatPrice = Number((todayBuying / 24) * karat);
                karatPrice25 = Number((todayBuying / 24) * (karat + 0.25));
                karatPrice50 = Number((todayBuying / 24) * (karat + 0.50));
                karatPrice75 = Number((todayBuying / 24) * (karat + 0.75));
            }

            // pure weight Price 
            var pureTola = Number(finalWeight / 11.664);
            var purePrice = Number(pureTola * karatPrice + discount - labFee - etc);
            var purePrice25 = Number(pureTola * karatPrice25 + discount - labFee - etc);
            var purePrice50 = Number(pureTola * karatPrice50 + discount - labFee - etc);
            var purePrice75 = Number(pureTola * karatPrice75 + discount - labFee - etc);

            var roundPurePrice = purePrice.toFixed(0);
            var roundPurePrice25 = purePrice25.toFixed(0);
            var roundPurePrice50 = purePrice50.toFixed(0);
            var roundPurePrice75 = purePrice75.toFixed(0);

            // scrab weight Price 
            // var scrabTola = Number(weight / 11.664);
            // var scrabPrice = Number(scrabTola * karatPrice);
            // var roundScrabPrice = scrabPrice.toFixed(0);

            console.log("Karat = "+karat);
            console.log("Karat Price = "+karatPrice);
            console.log("Pure Weight Price = "+roundPurePrice);
            // console.log("Scrab Weight Price = "+roundScrabPrice);


            //calculating pure weight
            var pureWeight = ((finalWeight / 24) * (karat));
            var roundpureWeight = pureWeight.toFixed(2);
            $("#pureWeight0").val(roundpureWeight);
            $("#weightSelected0").val(roundpureWeight);

            if(karat > 23){
                var karat25 = karat-0.25;
                var karat50 = karat-0.50;
                var karat75 = karat-0.75;

                var pureWeight1 = ((finalWeight / 24) * (karat25));
                var roundpureWeight1 = pureWeight1.toFixed(2);
                $("#pureWeight1").val(roundpureWeight1);
                $("#weightSelected10").val(roundpureWeight1);

                var pureWeight2 = ((finalWeight / 24) * (karat50));
                var roundpureWeight2 = pureWeight2.toFixed(2);
                $("#pureWeight2").val(roundpureWeight2);
                $("#weightSelected20").val(roundpureWeight2);

                var pureWeight3 = ((finalWeight / 24) * (karat75));
                var roundpureWeight3 = pureWeight3.toFixed(2);
                $("#pureWeight3").val(roundpureWeight3);
                $("#weightSelected30").val(roundpureWeight3);
            }else{
                var karat25 = karat+0.25;
                var karat50 = karat+0.50;
                var karat75 = karat+0.75;

                var pureWeight1 = ((finalWeight / 24) * (karat25));
                var roundpureWeight1 = pureWeight1.toFixed(2);
                $("#pureWeight1").val(roundpureWeight1);
                $("#weightSelected10").val(roundpureWeight1);

                var pureWeight2 = ((finalWeight / 24) * (karat50));
                var roundpureWeight2 = pureWeight2.toFixed(2);
                $("#pureWeight2").val(roundpureWeight2);
                $("#weightSelected20").val(roundpureWeight2);

                var pureWeight3 = ((finalWeight / 24) * (karat75));
                var roundpureWeight3 = pureWeight3.toFixed(2);
                $("#pureWeight3").val(roundpureWeight3);
                $("#weightSelected30").val(roundpureWeight3);
            }


            // price writing 
            // $("#scrabPrice").val(roundScrabPrice);
            if(karat > 23){
                // 1
                $("#karatSelected0").val(karat);
                $("#priceSelected00").val(roundPurePrice);
                $("#priceSelected0").val(roundPurePrice);
                document.getElementById("pure0").innerHTML = "("+karat+"-K)";
                // 2
                $("#karatSelected10").val(karat-0.25);
                $("#priceSelected10").val(roundPurePrice25);
                $("#priceSelected1").val(roundPurePrice25);
                document.getElementById("pure25").innerHTML = "("+(karat-0.25)+"-K)";
                // 3
                $("#karatSelected20").val(karat-0.50);
                $("#priceSelected20").val(roundPurePrice50);
                $("#priceSelected2").val(roundPurePrice50);
                document.getElementById("pure50").innerHTML = "("+(karat-0.50)+"-K)";
                // 4
                $("#karatSelected30").val(karat-0.75);
                $("#priceSelected30").val(roundPurePrice75);
                $("#priceSelected3").val(roundPurePrice75);
                document.getElementById("pure75").innerHTML = "("+(karat-0.75)+"-K)";
            }else{
                // 1
                $("#karatSelected0").val(karat);
                $("#priceSelected00").val(roundPurePrice);
                $("#priceSelected0").val(roundPurePrice);
                document.getElementById("pure0").innerHTML = "("+karat+"-K)";
                // 2
                $("#karatSelected10").val(karat+0.25);
                $("#priceSelected10").val(roundPurePrice25);
                $("#priceSelected1").val(roundPurePrice25);
                document.getElementById("pure25").innerHTML = "("+(karat+0.25)+"-K)";
                // 3
                $("#karatSelected20").val(karat+0.50);
                $("#priceSelected20").val(roundPurePrice50);
                $("#priceSelected2").val(roundPurePrice50);
                document.getElementById("pure50").innerHTML = "("+(karat+0.50)+"-K)";
                // 4
                $("#karatSelected30").val(karat+0.50);
                $("#priceSelected30").val(roundPurePrice75);
                $("#priceSelected3").val(roundPurePrice75);
                document.getElementById("pure75").innerHTML = "("+(karat+0.75)+"-K)";
            }

            // price selection 
            if(document.getElementById("karatSelected0").checked){
                document.getElementById("priceSelected00").checked = true;
                document.getElementById("weightSelected20").checked = true;

            }else if(document.getElementById("karatSelected10").checked){
                document.getElementById("priceSelected10").checked = true;
                document.getElementById("weightSelected20").checked = true;

            }else if(document.getElementById("karatSelected20").checked){
                document.getElementById("priceSelected20").checked = true;
                document.getElementById("weightSelected20").checked = true;

            }else if(document.getElementById("karatSelected30").checked){
                document.getElementById("priceSelected30").checked = true;
                document.getElementById("weightSelected20").checked = true;

            }



        },
        error: function (err) {
            console.log(err);
        }
    });
}


// view barcode
function print_barcode_scrab_item(scrabId){
    
    console.log("id");
    console.log(scrabId);
    $.ajax({
        url:"./includes/fetch_scrab_item_by_id.php",
        type:'post',
        data: {scrabId: scrabId },
        dataType : 'json',
        success : function(response) {
            console.log(response.scrabId);

            document.getElementById("barcodeId").src = "barcode/barcode.php?text="+response.scrabId+"&size=50&print=true";
            document.getElementById("printButton").setAttribute("onclick", "location.href='print_barcode_page.php?id="+response.scrabId+"'");

        },
        error: function(err){
            console.log(err);
        }
    })
}


// view image
function view_scrab_item_image(scrabId){
    
    console.log("id");
    console.log(scrabId);
    $.ajax({
        url:"./includes/fetch_scrab_item_by_id.php",
        type:'post',
        data: {scrabId: scrabId },
        dataType : 'json',
        success : function(response) {
            // console.log(response.id );

            document.getElementById("imageId").src = "media/stock/scrab_stock/"+response.image;

        },
        error: function(err){
            console.log(err);
        }
    })
}

// delete scrab stock
function delete_scrab_item(scrabId){
    
    console.log("id");
    console.log(scrabId);
    $.ajax({
        url:"./includes/fetch_scrab_item_by_id.php",
        type:'post',
        data: {scrabId: scrabId },
        dataType : 'json',
        success : function(response) {
            console.log(response.id );
            $('#delete_scrab_id').val(response.id);

            $('#delete_scrab_item').unbind('submit').bind('submit',function(){
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

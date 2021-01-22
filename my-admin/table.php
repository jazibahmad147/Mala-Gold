<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        box-sizing: border-box;
    }
    .invoice{
        margin: auto;
        height: 148.5mm;
        width: 105mm;
        border: 2px solid black;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
    }
    .row{
        content: "";
        display: table;
        clear: both;
    }
    .column {
        float: left;
        /* width: 50%; */
        padding: 5px;
        height: auto;
    }
    .companyName{
        font-family: Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
        font-size: 35px;
        padding-top: 15px;
    }
    .companyDesc{
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        font-weight: 500;
        font-size: 10px;
        line-height: 15px;
        padding-left: 55px;
    }
    .clientInfo,.invoiceDesc{
        font-size: 12px;
    }
    .invoiceDesc{
        padding-left: 90px;
    }
    .title{
        font-size: 15px;
        letter-spacing: -1px;
        font-weight: 900;
    }
    .saleItemsTable{
        margin: auto;
        width: 98%;
    }
    table,td,tr,th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    .saleItemsTableHeader{
        background-color: black;
        color: white;
    }
    td{
        text-align: center;
    }
    .totalsDetail{
        font-size: small;
        line-height: 2px;
        padding-top: 20px;
        padding-left: 100px;
    }
    .totalsDetailHeading{
        font-weight: 800;
    }
    .invoiceFooter{
        width: 300px;
        text-align: center;
        margin: auto;
        transform: translate(0, 190px);
        line-height: 5px;
    }
</style>
<body>
    <div class="invoice">
        <div class="header row">
            <div class="companyName column">MALA GOLD</div>
            <div class="companyDesc column">
                Ameer Ahmad Tahir <br>
                +92 333 6526292 <br>
                admin@malagold.com <br>
                Alwan-e-Mehmood Road, Rabwah
            </div>
            <hr>
        </div>
        <div class="clientInfo">
            <div class="clientDesc column">
                INVOICE TO:<br>
                <span class="title">Customer Name</span><br>
                +923333333333</div>
            <div class="invoiceDesc column">
                <span class="title">INVOICE: 1232154589825</span><br>
                Date of Invoice: 25-25-2222<br>
                Due Date: 25-25-2222
            </div>
        </div>
        <div class="saleItems">
            <table class="saleItemsTable">
                <tr class="saleItemsTableHeader">
                    <th>No</th>
                    <th>Name</th>
                    <th>Karat</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </table>
        </div>
        <div class="totals row">
            <div class="column"><h2>Thank You!</h2></div>
            <div class="column totalsDetail">
                <span class="totalsDetailHeading">Sub Total:</span> 5000<hr>
                <span class="totalsDetailHeading">Labor:</span> 5000<hr>
                <span class="totalsDetailHeading">Polish:</span> 5000<hr>
                <span class="totalsDetailHeading">Discount:</span> 5000<hr>
                <span class="totalsDetailHeading">Grand Total:</span> 5000<hr>
                <span class="totalsDetailHeading">Paid:</span> 5000<hr>
                <span class="totalsDetailHeading">Balance:</span> 5000<hr>
            </div>
        </div>
        <div class="invoiceFooter">
            <hr>
            <div class="footer-content">
                Thank you! for your business with us.
            </div>
        </div>
    </div>
</body>
</html>
<?php

include("../database/connection.php");

$id = $_POST['invoiceId'];

$sql = "SELECT * FROM sales WHERE id = $id";

$invoiceResult = $con->query($sql);
$invoiceData = $invoiceResult->fetch_array();

$saleId = $invoiceData[2];
$date = date('d-m-Y', strtotime($invoiceData[1]));
$customerId = $invoiceData[3];
$subTotal = $invoiceData[4];
$discount = $invoiceData[9];
$grandTotal = $invoiceData[10];
$totalPaid = $invoiceData[11];
$balance = $grandTotal-$totalPaid;
$expDate = date('d-m-Y', strtotime($invoiceData[12]));




$saleItemSql = mysqli_query($con,"SELECT * FROM sale_items WHERE saleId = '$saleId'");
$saleStonesSql = mysqli_query($con,"SELECT * FROM sale_stones WHERE saleId = '$saleId'");
$rowcount=mysqli_num_rows($saleStonesSql);

$table = '
<style>
    * {
        box-sizing: border-box;
    }
    .invoice{
        margin: auto;
        height: 148.5mm;
        width: 105mm;
        border: 2px solid black;
        position: relative;
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
        padding-left: 80px;
    }
    .title{
        font-size: 15px;
        letter-spacing: -1px;
        font-weight: 900;
    }
    .saleItemsTable{
        font-size: 7px;
        margin: auto;
        width: 98%;
    }
    table,td,tr,th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    .saleItemsTableHeader{
        font-size: 11px;
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
        position: absolute;
        margin: auto;
        bottom: 15;
        left: 12%;
        line-height: 5px;
    }
</style>
';

	$table .='
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
                <span class="title">INVOICE: '.$saleId.='</span><br>
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
                    <th>Weight</th>
                    <th>Polish</th>
                    <th>Labor</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
	
	';

	$x = 1;
	while ($row = mysqli_fetch_array($saleItemSql)) {

		$table .= '<tr>
				<td>' . $x . '</td>
				<td>' . $row['pId'] . '</td>
				<td>' . $row['karat'] . '</td>
				<td>' . $row['weight'] . '</td>
				<td>' . $row['polish'] . '</td>
				<td>' . $row['labor'] . '</td>
				<td>' . $row['qty'] . '</td>
				<td>' . $row['price'] . '</td>
				<td>' . $row['total'] . '</td>
			</tr>
			';
		$x++;
    } // /while
    
    if($rowcount > 0){
        while ($row = mysqli_fetch_array($saleStonesSql)) {
            $table .= '<tr>
                    <td>' . $x . '</td>
                    <td>' . $row['stoneId'] . '</td>
                    <td>awyn</td>
                    <td>' . $row['total_weight'] . '</td>
                    <td>awyn</td>
                    <td>awyn</td>
                    <td>awyn</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['total'] . '</td>
                </tr>
                ';
            $x++;
        } // /while
    }


	$table .= '</table>
    </div>
    <div class="totals row">
        <div class="column"><h2>Thank You!</h2></div>
        <div class="column totalsDetail">
            <span class="totalsDetailHeading">Sub Total:</span> '.$subTotal.='<hr>
            <span class="totalsDetailHeading">Discount:</span> '.$discount.='<hr>
            <span class="totalsDetailHeading">Grand Total:</span> '.$grandTotal.='<hr>
            <span class="totalsDetailHeading">Paid:</span> '.$totalPaid.='<hr>
            <span class="totalsDetailHeading">Balance:</span> '.$balance.='<hr>
        </div>
    </div>
    <div class="invoiceFooter">
        <hr>
        <div class="footer-content">
            Thank you! for your business with us.
        </div>
    </div>
    </div>';




$con->close();

echo $table;
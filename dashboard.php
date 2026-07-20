<?php
include "db.php";

// Dashboard Stats
$totalProducts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM products"))['total'];
$totalCustomers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM customers"))['total'];
$totalBills = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM bills"))['total'];

$totalRevenue = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COALESCE(SUM(final_amount),0) total FROM bills"))['total'];

$todaySales = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COALESCE(SUM(final_amount),0) total 
FROM bills WHERE DATE(bill_date)=CURDATE()"))['total'];

$monthlySales = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COALESCE(SUM(final_amount),0) total 
FROM bills 
WHERE MONTH(bill_date)=MONTH(CURDATE()) 
AND YEAR(bill_date)=YEAR(CURDATE())"))['total'];

$lowStock = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) total FROM products WHERE quantity <= stock_alert"))['total'];


// Recent Bills
$recentBills = mysqli_query($conn,"
SELECT 
b.bill_number,
c.customer_name,
b.final_amount,
b.bill_date
FROM bills b
LEFT JOIN customers c 
ON b.customer_id=c.id
ORDER BY b.id DESC
LIMIT 8");


// Top Products
$topProducts = mysqli_query($conn,"
SELECT 
p.item_name,
SUM(bi.quantity) total_qty
FROM bill_items bi
INNER JOIN products p 
ON bi.product_id=p.id
GROUP BY bi.product_id
ORDER BY total_qty DESC
LIMIT 5");


// Low Stock Products
$lowStockProducts = mysqli_query($conn,"
SELECT item_name,quantity
FROM products
WHERE quantity<=stock_alert
ORDER BY quantity ASC
LIMIT 8");


// Chart
$labels=[];
$data=[];

$q=mysqli_query($conn,"
SELECT DATE(bill_date) day,
SUM(final_amount) total
FROM bills
GROUP BY DATE(bill_date)
ORDER BY day DESC
LIMIT 7");

while($row=mysqli_fetch_assoc($q))
{
    $labels[]=date("d M",strtotime($row['day']));
    $data[]=$row['total'];
}

$labels=array_reverse($labels);
$data=array_reverse($data);

?>

<!DOCTYPE html>
<html>
<head>

<title>FreshKart Dashboard</title>

<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}


body{
background:#f4f7f6;
}


/* SIDEBAR */

.sidebar{

position:fixed;
left:0;
top:0;
height:100vh;
width:260px;
background:#198754;
color:white;
padding:25px;

}


.logo{

font-size:26px;
font-weight:700;
margin-bottom:35px;

}


.logo i{
margin-right:10px;
}


.menu a{

display:flex;
align-items:center;
gap:15px;
color:white;
text-decoration:none;
padding:14px;
margin:8px 0;
border-radius:10px;
transition:.3s;

}


.menu a:hover{

background:white;
color:#198754;

}


.menu i{
width:25px;
}



/* MAIN */

.main{

margin-left:260px;
padding:25px;

}


/* HEADER */

.header{

background:white;
padding:20px 25px;
border-radius:15px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 5px 20px #ddd;

}


.header h1{

color:#198754;

}



/* CARDS */


.cards{

display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-top:25px;

}


.card{

background:white;
padding:25px;
border-radius:18px;
box-shadow:0 5px 20px #ddd;

}


.card i{

font-size:35px;
color:#198754;

}


.card h3{

margin-top:15px;
color:#555;

}


.card span{

font-size:30px;
font-weight:bold;

}



/* CHART */

.row{

display:grid;
grid-template-columns:2fr 1fr;
gap:20px;
margin-top:25px;

}


.box{

background:white;
padding:25px;
border-radius:18px;
box-shadow:0 5px 20px #ddd;

}



/* TABLE */

table{

width:100%;
border-collapse:collapse;
margin-top:15px;

}


th{

background:#eaf7ef;
padding:12px;
text-align:left;

}


td{

padding:12px;
border-bottom:1px solid #eee;

}



/* BUTTON */

.actions{

margin-top:25px;
display:flex;
gap:15px;
flex-wrap:wrap;

}


.actions a{

background:#198754;
color:white;
padding:14px 22px;
border-radius:30px;
text-decoration:none;

}


.actions a:hover{

background:#146c43;

}



/* MOBILE */


@media(max-width:900px){

.sidebar{

position:relative;
width:100%;
height:auto;

}

.main{

margin-left:0;

}

.row{

grid-template-columns:1fr;

}

}

</style>

</head>


<body>


<!-- SIDEBAR -->

<div class="sidebar">


<div class="logo">

<i class="fa-solid fa-cart-shopping"></i>
FreshKart

</div>


<div class="menu">

<a href="dashboard.php">
<i class="fa fa-home"></i>
Dashboard
</a>


<a href="products/add_product.php">
<i class="fa fa-box"></i>
Products
</a>


<a href="customers/add_customer.php">
<i class="fa fa-users"></i>
Customers
</a>


<a href="billing/create_bill.php">
<i class="fa fa-file-invoice"></i>
Create Bill
</a>


<a href="billing/view_bills.php">
<i class="fa fa-receipt"></i>
Bills
</a>


<a href="reports/sales_report.php">
<i class="fa fa-chart-line"></i>
Reports
</a>


</div>


</div>





<div class="main">


<div class="header">

<h1>
FreshKart Grocery ERP
</h1>


<div>
<i class="fa fa-calendar"></i>
<?=date("l, d F Y")?>
</div>


</div>





<div class="cards">


<div class="card">
<i class="fa fa-box"></i>
<h3>Total Products</h3>
<span><?=$totalProducts?></span>
</div>


<div class="card">
<i class="fa fa-users"></i>
<h3>Total Customers</h3>
<span><?=$totalCustomers?></span>
</div>



<div class="card">
<i class="fa fa-file-invoice"></i>
<h3>Total Bills</h3>
<span><?=$totalBills?></span>
</div>


<div class="card">
<i class="fa fa-indian-rupee-sign"></i>
<h3>Today's Sale</h3>
<span>
₹<?=number_format($todaySales,2)?>
</span>
</div>



<div class="card">
<i class="fa fa-chart-line"></i>
<h3>Monthly Sale</h3>
<span>
₹<?=number_format($monthlySales,2)?>
</span>
</div>



<div class="card">
<i class="fa fa-wallet"></i>
<h3>Total Revenue</h3>
<span>
₹<?=number_format($totalRevenue,2)?>
</span>
</div>



<div class="card">
<i class="fa fa-triangle-exclamation"></i>
<h3>Low Stock</h3>
<span><?=$lowStock?></span>
</div>


</div>





<div class="row">


<div class="box">

<h2>Sales Trend</h2>

<canvas id="chart"></canvas>


</div>




<div class="box">

<h2>Top Products</h2>

<ul>

<?php while($p=mysqli_fetch_assoc($topProducts)){ ?>

<li style="margin:12px">
<?=$p['item_name']?>
-
<?=$p['total_qty']?> Units
</li>

<?php } ?>

</ul>


</div>


</div>





<div class="row">


<div class="box">

<h2>Recent Bills</h2>


<table>

<tr>
<th>Bill</th>
<th>Customer</th>
<th>Amount</th>
<th>Date</th>
</tr>


<?php while($b=mysqli_fetch_assoc($recentBills)){ ?>


<tr>

<td><?=$b['bill_number']?></td>

<td>
<?=htmlspecialchars($b['customer_name'] ?? 'Walk-in')?>
</td>


<td>
₹<?=number_format($b['final_amount'],2)?>
</td>


<td>
<?=date("d-m-Y",strtotime($b['bill_date']))?>
</td>


</tr>


<?php } ?>


</table>


</div>





<div class="box">


<h2>Low Stock</h2>


<table>

<tr>
<th>Product</th>
<th>Qty</th>
</tr>


<?php while($ls=mysqli_fetch_assoc($lowStockProducts)){ ?>


<tr>

<td>
<?=$ls['item_name']?>
</td>

<td style="color:red;font-weight:bold">
<?=$ls['quantity']?>
</td>

</tr>


<?php } ?>


</table>


</div>


</div>






<div class="actions">


<a href="products/add_product.php">
➕ Add Product
</a>


<a href="customers/add_customer.php">
👤 Add Customer
</a>


<a href="billing/create_bill.php">
🧾 New Bill
</a>


<a href="billing/view_bills.php">
📋 View Bills
</a>


</div>


</div>





<script>


new Chart(document.getElementById('chart'),{


type:'line',


data:{

labels:<?=json_encode($labels)?>,

datasets:[{

label:'Sales',

data:<?=json_encode($data)?>,

borderWidth:3,

tension:.4,

fill:true

}]

},


options:{

responsive:true

}


});


</script>


</body>
</html>

<?php

$obj = new mysqli("localhost","root","","database",3307);

$id = $_GET["cu"];

$result = $obj->query("select * from customer where id='$id'");
    $rows = $result->fetch_assoc();
?>
<html>
<head>
<title>Customer</title>

<style>

.cust{ 
    font-size: 1.2em;
cursor: pointer;
}
.cust::before{
    content: "";
    background: url('big.jpg') no-repeat center center/cover;
    position: absolute;
    top: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
    z-index: -1;
    opacity: 0.5;
}
input[type=button] 
{
    width: 119px;
    height: 47px;
    border-radius: 15px;
    cursor: pointer;
    font-size: 28px;
}

</style>
</head>
<body>
<div class= "cust" border="1"  align="center" cellpadding="10" cellspacing="0" color="grey"> 
<h1><Details</h1>
    <div class="main">
    
        <p>id :<?php echo $rows["id"]?></p>
        <p>Name :<?php echo $rows["name"]?></p>
        <p>Email :<?php echo $rows["email"]?></p>
        <p>Address :<?php echo $rows["address"]?></p>
        <p>Balance: <?php echo $rows["balance"]?></p>
        <form>
 <input type="button" value="back" onclick="history.back()">
</form>

    </div>
</div>
</body>
</html>


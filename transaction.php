<?php

$conn = new mysqli("localhost", "root", "", "database", 3307);
$sql = "select * from transaction_history";
$result = $conn->query($sql);


?>
<html>

<head>
    <title>Customer</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <style>
        body{
            color: black;
        }
        h1 {
            text-align: center;
        }

        .cust {
            font-size: 1.7em;
            cursor: pointer;
            width: 67%;
        }

        .cust::before {
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
    </style>
</head>

<body>
<header class="header">
        <div class="left">
            <img src="logo3.png" alt="">
        </div>
        <div class="mid">
            <ul class="navbar">
                <li><a href="home.php"> Home </a></li>
                <li><a href="cust.php"> Customer </a></li>
                <li><a href="transa.php"> Transaction</a></li>
                <li><a href="transaction.php" class="active"> Tranction-history</a></li>
            </ul>
        </div>
    </header>
    <h1>Transaction History</h1>
    <h1><a href="home.php"><i class="fas fa-home fa-3x" style="font-size: 30px; color: black"></i></a></h1>
    <table class="cust" border="1" align="center" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Sendername </th>
                <th>Receivername</th>
                <th> Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rows = mysqli_fetch_assoc($result)) {
                $id = $rows["id"];
            ?>
                <tr class="table">
                    <td><?php echo $rows["sendername"] ?></td>
                    <td><?php echo $rows["receivername"] ?></td>
                    <td><?php echo $rows["date"] ?></td>
                    <td><?php echo $rows["amount"] ?></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</body>

</html>
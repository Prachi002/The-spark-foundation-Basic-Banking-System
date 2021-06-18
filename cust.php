<?php


$obj = new mysqli("localhost", "root", "", "database", 3307);
$sql = "select * from customer";
$result = $obj->query($sql);

?>
<html>

<head>
    <title>Customer</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <style>
        h1 {
            text-align: center;
        }

        .cust {
            /* order-collapse: collapse; */
            font-size: 1.8em;
            min-width: 540px;
            display: table;
            border-collapse: collapse;
            cursor: pointer;
            color: black;
        }

        .cust::before {
            content: "";
            background: url('big.jpg') no-repeat center center/cover;
            position: absolute;
            top: 0px;
            left: 0px;
            height: 110%;
            width: 100%;
            z-index: -1;
            opacity: 0.5;
        }


        .table:hover {
            color: #994d00;
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
                <li><a href="home.php" > Home </a></li>
                <li><a href="cust.php" class="active"> Customer </a></li>
                <li><a href="transa.php"> Transaction</a></li>
                <li><a href="transaction.php"> Tranction-history</a></li>
            </ul>
        </div>
    </header>
    <table class="cust" border="1" align="center" cellpadding="10" cellspacing="0">
        <h1>Customers
            <a href="home.php"><i class="fas fa-home fa-3x" style="font-size: 30px; color: black; margin: 5px"></i></a>
        </h1>
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rows = mysqli_fetch_assoc($result)) {
                $id = $rows["id"];
            ?>
                <tr class="table">
                    <td><?php echo $rows["id"] ?></td>
                    <td><?php echo $rows["name"] ?></td>
                    <td><?php echo $rows["balance"] ?></td>
                    <td><a href="view.php?cu=<?php echo $id ?>">view</a></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</body>

</html>
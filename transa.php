<?php
$conn = new mysqli("localhost", "root", "", "database", 3307);
if (isset($_POST['submit'])) {

    $sendername = $_POST["sendername"];
    $receivername = $_POST["receivername"];
    $amount = $_POST['amount'];

    $sendersql = "select * from customer where name ='$sendername'";
    $senderresult = $conn->query($sendersql);
    $senderdata = $senderresult->fetch_object();
    $senderbalance = $senderdata->balance;

    $receiversql = "select * from customer where name = '$receivername'";
    $receiverresult = $conn->query($receiversql);
    $receiverdata = $receiverresult->fetch_object();
    $receiverbalance = $receiverdata->balance;

    date_default_timezone_set('Asia/Kolkata');
    $currenttime = date('Y-m-d');

    //checking if amount is greater than 0
    if ($amount > 0) {


        //checking if the  sender has enough balance 
        if ($senderbalance > $amount) {
            //credit amount from sender balance
            $senderbalance = $senderbalance - $amount;

            //debit amount to receiver balance
            $receiverbalance = $receiverbalance + $amount;

            //updating the sender and receiver balance in database
            $conn->query("update customer set balance = '$senderbalance' where name='$sendername'");
            $conn->query("update customer set balance = '$receiverbalance' where name='$receivername'");

            echo '<script language="javascript">';
            echo 'alert("Transaction Successfull")';
            echo '</script>';

            //make an entry in the database in transaction history table
            $conn->query("insert into transaction_history(sendername, receivername, amount, date) values('$sendername','$receivername','$amount','$currenttime')");
        } else {
            echo "<script>alert('$sendername has not enough balance')</script>";
        }
    } else {
        echo "<script>alert('Amount cannot be negative')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Fund Transfer</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            margin: 0;
            color: black;
        }


        input[type=text] {
            width: 280px;
            height: 30px;
            border-radius: 21px;
        }

        input[type=date] {
            width: 280px;
            height: 30px;
            border-radius: 21px;
        }

        input[type=number] {
            width: 280px;
            height: 30px;
            border-radius: 21px;
        }


        input[type=submit] {
            padding: 8px;
            border-radius: 20px;
            width: 235px;
            font-size: 24px;
            height: 40px;
        }

        .content::before {
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
                <li><a href="home.php" > Home </a></li>
                <li><a href="cust.php"> Customer </a></li>
                <li><a href="transa.php" class="active"> Transaction</a></li>
                <li><a href="transaction.php"> Tranction-history</a></li>
            </ul>
        </div>
    </header>
    <div class="content">
        <form method="post">
            <table align='center' style="padding:120px">
                <tr>
                    <td>
                        <h1>Sender Name </h1>
                    </td>
                    <td><input type="text" id="sendername" name="sendername" value="" required></td>
                </tr>
                <tr>
                    <td>
                        <h1> Recipient Name</h1>
                    </td>
                    <td><input type="text" id="receivername" name="receivername" value="" required> </td>
                </tr>
                <tr>
                    <td>
                        <h1>Amount</h1>
                    </td>
                    <td><input type="number" id="amount" name="amount" value="" required></td>
                </tr>
                <tr>
                    <h1>
                        <td colspan='2' align='center'><input type="submit" id="submit" name="submit" value=" Transfer">
                            <a href="home.php"><i class="fas fa-home fa-3x" style="font-size: 30px; color: black"></i></a>
                        </td>
                    </h1>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
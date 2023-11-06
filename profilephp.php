<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins|Pacifico');

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('bgimg.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            margin: auto 80px;
            position: relative;
            line-height: 60px;
            color: #555;
            font-family: 'Poppins';
        }

        h2::after {
            content: '';
            background: #fc94af;
            width: 80px;
            height: 5px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #fc94af;
            color: #FFF;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #0074cc;
            font-family: 'Pacifico', cursive;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005aa3;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_POST['search'])) {
            $customerName = $_POST['customerName'];

            // Database details
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dbnew";

            // Creating a connection
            $con = mysqli_connect($host, $username, $password, $dbname);

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM bill_table WHERE CustomerName='$customerName'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<h2>Welcome $customerName</h2>";
                echo "<table>";
                echo "<tr><th>Bill ID</th><th>Phone Number</th><th>Address</th><th>Email</th><th>Date Of Purchase</th><th>Total Amount</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['BillID'] . "</td>";
                    echo "<td>" . $row['PhoneNo'] . "</td>";
                    echo "<td>" . $row['Address'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['PurchaseDate'] . "</td>";
                    echo "<td>" . $row['TotalAmount'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No orders found for customer: $customerName";
            }

            mysqli_close($con);
        }
    ?>
</body>
</html>

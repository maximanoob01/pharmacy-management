<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nav2.css">
    <link rel="stylesheet" href="table1.css">
    <link rel="stylesheet" href="form3.css">
    <title>Reports</title>
    <style>
        body {
            font-family: Arial;
        }
    </style>
</head>

<body>

    <div class="sidenav">
        <h2 class="heading">PHARMACIA</h2>
        <a href="adminmainpage.php">Dashboard</a>
        <button class="dropdown-btn">Inventory</button>
        <div class="dropdown-container">
            <a href="inventory-add.php">Add New Medicine</a>
            <a href="inventory-view.php">Manage Inventory</a>
        </div>
        <button class="dropdown-btn">Suppliers</button>
        <div class="dropdown-container">
            <a href="supplier-add.php">Add New Supplier</a>
            <a href="supplier-view.php">Manage Suppliers</a>
        </div>
        <button class="dropdown-btn">Stock Purchase</button>
        <div class="dropdown-container">
            <a href="purchase-add.php">Add New Purchase</a>
            <a href="purchase-view.php">Manage Purchases</a>
        </div>
        <button class="dropdown-btn">Employees</button>
        <div class="dropdown-container">
            <a href="employee-add.php">Add New Employee</a>
            <a href="employee-view.php">Manage Employees</a>
        </div>
        <button class="dropdown-btn">Customers</button>
        <div class="dropdown-container">
            <a href="customer-add.php">Add New Customer</a>
            <a href="customer-view.php">Manage Customers</a>
        </div>
        <a href="sales-view.php">View Sales Invoice Details</a>
        <a href="salesitems-view.php">View Sold Products Details</a>
        <a href="pos1.php">Add New Sale</a>
        <button class="dropdown-btn">Reports</button>
        <div class="dropdown-container">
            <a href="stockreport.php">Medicines - Low Stock</a>
            <a href="expiryreport.php">Medicines - Soon to Expire</a>
            <a href="salesreport.php">Transactions Reports</a>
        </div>
    </div>

    <div class="topnav">
        <a href="logout.php">Logout</a>
    </div>

    <center>
        <div class="head">
            <h2>TRANSACTION REPORTS</h2>
        </div>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" style="margin-top: 100px;">
            <p>
                <label for="start">Start Date:</label>
                <input type="date" name="start" required>
            </p>
            <p>
                <label for="end">End Date:</label>
                <input type="date" name="end" required>
            </p>
            <input type="submit" name="submit" value="View Records">
        </form>
    </center>

    <?php
    if (isset($_POST['submit'])) {
        include "config.php";
        $start = $_POST['start'];
        $end = $_POST['end'];

        // Fetch purchase amount
        $purchaseRes = mysqli_query($conn, "SELECT P_AMT('$start','$end') AS PAMT");
        $pamt = mysqli_fetch_assoc($purchaseRes)['PAMT'] ?? 0;

        // Fetch sales amount
        $salesRes = mysqli_query($conn, "SELECT S_AMT('$start','$end') AS SAMT");
        $samt = mysqli_fetch_assoc($salesRes)['SAMT'] ?? 0;

        $profit = number_format($samt - $pamt, 2);
    ?>

        <table align="right" id="table1" style="margin-right:100px;">
            <tr>
                <th>Purchase ID</th>
                <th>Supplier ID</th>
                <th>Medicine ID</th>
                <th>Quantity</th>
                <th>Date of Purchase</th>
                <th>Cost of Purchase (in Rs)</th>
            </tr>

            <?php
            $purchaseSQL = "SELECT p_id, sup_id, med_id, p_qty, p_cost, pur_date 
                            FROM purchase 
                            WHERE pur_date BETWEEN '$start' AND '$end'";
            $purchaseResult = $conn->query($purchaseSQL);
            if ($purchaseResult->num_rows > 0) {
                while ($row = $purchaseResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['p_id']}</td>
                            <td>{$row['sup_id']}</td>
                            <td>{$row['med_id']}</td>
                            <td>{$row['p_qty']}</td>
                            <td>{$row['pur_date']}</td>
                            <td>{$row['p_cost']}</td>
                          </tr>";
                }
                echo "<tr><td colspan=5>Total</td><td>Rs. $pamt</td></tr>";
            }
            ?>
        </table>

        <table align="right" id="table1" style="margin-right:100px;">
            <tr>
                <th>Sale ID</th>
                <th>Customer ID</th>
                <th>Employee ID</th>
                <th>Date</th>
                <th>Sale Amount (in Rs)</th>
            </tr>

            <?php
            $salesSQL = "SELECT sale_id, c_id, e_id, s_date, total_amt 
                         FROM sales 
                         WHERE s_date BETWEEN '$start' AND '$end'";
            $salesResult = $conn->query($salesSQL);
            if ($salesResult->num_rows > 0) {
                while ($row = $salesResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['sale_id']}</td>
                            <td>{$row['c_id']}</td>
                            <td>{$row['e_id']}</td>
                            <td>{$row['s_date']}</td>
                            <td>{$row['total_amt']}</td>
                          </tr>";
                }
                echo "<tr><td colspan=4>Total</td><td>Rs. $samt</td></tr>";
            }
            ?>
        </table>

        <table align="right" id="table1" style="margin-right:100px;">
            <tr style="background-color: #f2f2f2;">
                <td>Transaction Amount</td>
                <td>Rs. <?= $profit ?></td>
            </tr>
        </table>

    <?php } ?>

    <script>
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.classList.toggle('active');
                let dropdownContent = this.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>

</body>

</html>

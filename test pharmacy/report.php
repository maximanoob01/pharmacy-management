<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nav2.css">
    <link rel="stylesheet" href="table1.css">
    <title>Reports</title>
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
            <h2>STOCK EXPIRING WITHIN 6 MONTHS</h2>
        </div>
    </center>

    <table align="right" id="table1" style="margin-right:100px;">
        <tr>
            <th>Purchase ID</th>
            <th>Supplier ID</th>
            <th>Medicine ID</th>
            <th>Quantity</th>
            <th>Cost of Purchase</th>
            <th>Date of Purchase</th>
            <th>Manufacturing Date</th>
            <th>Expiry Date</th>
        </tr>

        <?php
        include "config.php";
        $result = mysqli_query($conn, "CALL `EXPIRY`();");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['p_id']}</td>
                    <td>{$row['sup_id']}</td>
                    <td>{$row['med_id']}</td>
                    <td>{$row['p_qty']}</td>
                    <td>{$row['p_cost']}</td>
                    <td>{$row['pur_date']}</td>
                    <td>{$row['mfg_date']}</td>
                    <td style='color:red;'>{$row['exp_date']}</td>
                </tr>";
            }
        }
        $conn->close();
        ?>
    </table>

    <script>
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', function () {
                this.classList.toggle('active');
                const dropdownContent = this.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>

</body>

</html>

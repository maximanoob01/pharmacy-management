<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="nav2.css">
  <link rel="stylesheet" type="text/css" href="table1.css">
  <title>Customers</title>
</head>

<body>

  <div class="sidenav">
    <h2 style="font-family:Arial; color:white; text-align:center;">PHARMACIA</h2>
    <a href="adminmainpage.php">Dashboard</a>

    <!-- Simplified Dropdown Menu -->
    <button class="dropdown-btn">Inventory <i class="down"></i></button>
    <div class="dropdown-container">
      <a href="inventory-add.php">Add New Medicine</a>
      <a href="inventory-view.php">Manage Inventory</a>
    </div>

    <button class="dropdown-btn">Suppliers <i class="down"></i></button>
    <div class="dropdown-container">
      <a href="supplier-add.php">Add New Supplier</a>
      <a href="supplier-view.php">Manage Suppliers</a>
    </div>

    <button class="dropdown-btn">Stock Purchase <i class="down"></i></button>
    <div class="dropdown-container">
      <a href="purchase-add.php">Add New Purchase</a>
      <a href="purchase-view.php">Manage Purchases</a>
    </div>

    <button class="dropdown-btn">Employees <i class="down"></i></button>
    <div class="dropdown-container">
      <a href="employee-add.php">Add New Employee</a>
      <a href="employee-view.php">Manage Employees</a>
    </div>

    <button class="dropdown-btn">Customers <i class="down"></i></button>
    <div class="dropdown-container">
      <a href="customer-add.php">Add New Customer</a>
      <a href="customer-view.php">Manage Customers</a>
    </div>

    <a href="sales-view.php">View Sales Invoice Details</a>
    <a href="salesitems-view.php">View Sold Products Details</a>
    <a href="pos1.php">Add New Sale</a>

    <button class="dropdown-btn">Reports <i class="down"></i></button>
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
      <h2>CUSTOMER LIST</h2>
    </div>
  </center>

  <table align="right" id="table1" style="margin-right:100px;">
    <tr>
      <th>Customer ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Age</th>
      <th>Sex</th>
      <th>Phone Number</th>
      <th>Email Address</th>
      <th>Action</th>
    </tr>

    <?php
      include "config.php";
      $result = $conn->query("SELECT c_id, c_fname, c_lname, c_age, c_sex, c_phno, c_mail FROM customer");

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['c_id']}</td>
                  <td>{$row['c_fname']}</td>
                  <td>{$row['c_lname']}</td>
                  <td>{$row['c_age']}</td>
                  <td>{$row['c_sex']}</td>
                  <td>{$row['c_phno']}</td>
                  <td>{$row['c_mail']}</td>
                  <td align='center'>
                    <a class='button1 edit-btn' href='customer-update.php?id={$row['c_id']}'>Edit</a>
                    <a

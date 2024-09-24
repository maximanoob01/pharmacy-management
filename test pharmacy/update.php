<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="nav2.css">
  <link rel="stylesheet" type="text/css" href="form4.css">
  <title>Update Customer Details</title>
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
      <h2>UPDATE CUSTOMER DETAILS</h2>
    </div>
  </center>

  <div class="one">
    <div class="row">
      <?php
        include "config.php";
        
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $qry = "SELECT * FROM customer WHERE c_id='$id'";
          $result = $conn->query($qry);
          $row = $result->fetch_assoc(); // Use associative array for better readability
        }

        if (isset($_POST['update'])) {
          $id = $_POST['cid'];
          $fname = $_POST['cfname'];
          $lname = $_POST['clname'];
          $age = $_POST['age'];
          $sex = $_POST['sex'];
          $phno = $_POST['phno'];
          $mail = $_POST['emid'];

          $sql = "UPDATE customer SET c_fname='$fname', c_lname='$lname', c_age='$age', c_sex='$sex', c_phno='$phno', c_mail='$mail' WHERE c_id='$id'";
          if ($conn->query($sql)) {
            header("location:customer-view.php");
          } else {
            echo "<p style='font-size:14px; color:red;'>Error! Unable to update.</p>";
          }
        }
      ?>

      <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="column">
          <p>
            <label for="cid">Customer ID:</label><br>
            <input type="number" name="cid" value="<?php echo $row['c_id']; ?>" readonly>
          </p>
          <p>
            <label for="cfname">First Name:</label><br>
            <input type="text" name="cfname" value="<?php echo $row['c_fname']; ?>" required>
          </p>
          <p>
            <label for="clname">Last Name:</label><br>
            <input type="text" name="clname" value="<?php echo $row['c_lname']; ?>" required>
          </p>
          <p>
            <label for="age">Age:</label><br>
            <input type="number" name="age" value="<?php echo $row['c_age']; ?>" required>
          </p>
          <p>
            <label for="sex">Sex:</label><br>
            <input type="text" name="sex" value="<?php echo $row['c_sex']; ?>" required>
          </p>
        </div>

        <div class="column">
          <p>
            <label for="phno">Phone Number:</label><br>
            <input type="number" name="phno" value="<?php echo $row['c_phno']; ?>" required>
          </p>
          <p>
            <label for="emid">Email ID:</label><br>
            <input type="email" name="emid" value="<?php echo $row['c_mail']; ?>" required>
          </p>
        </div>

        <input type="submit" name="update" value="Update">
      </form>
    </div>
  </div>

  <script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    for (var i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
      });
    }
  </script>

</body>
</html>

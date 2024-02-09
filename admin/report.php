<!DOCTYPE html>
<?php
    //include "includes/header.php";
    include "db.php";

$sql = "SELECT * FROM orders";
$result = mysqli_query($con, $sql);

/*
if(isset($_POST['insert_btn'])){
  $insert_book_id = $_POST['insert_book_id'];
  $insert_book_name = $_POST['insert_book_name'];
  $insert_book_author = $_POST['insert_book_author'];
  $insert_book_price = $_POST['insert_book_price'];
  $insert_book_category = $_POST['insert_book_category'];

  $inserting_query = "INSERT INTO book (book_name, book_author, book_price, book_category) VALUES ('$insert_book_name', '$insert_book_author', '$insert_book_price', '$insert_book_category')";
  $insert_query = mysqli_query($conn, $inserting_query);
  if($insert_query){
     header('Location: book.php');
  }
}

if(isset($_POST['update_btn'])){
  $update_book_id = $_POST['book_id'];
  $book_name = $_POST['book_name'];
  $book_author = $_POST['book_author'];
  $book_price = $_POST['book_price'];
  $book_category = $_POST['book_category'];

  $query = "UPDATE book SET book_name = '$book_name', book_author='$book_author', book_price='$book_price', book_category='$book_category' WHERE book_id = '$update_book_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: book.php');
  }
};

*/

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($con, "DELETE FROM orders WHERE id = '$remove_id'");
  header('Location: orders.php');
};

?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <!-- link rel="stylesheet" href="../assets/css/style.css" -->


    <title>Orders</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="#">
</head>
<body>
  <br>
    <div class="container-fluid">
    <div class="container-fluid flex-row">

      <div class="d-flex justify-content-end">
        <!-- button class="btn btn-outline-success" type="submit" name="print_btn">Print Report</button -->
        <!-- button id="printButton" class="btn btn-outline-success" onclick="printInvoice()">Print Report</button -->
      </div>

      <div class="d-flex justify-content-start"><h3>Orders</h3></div>
      <br>
    
    </div>

    <br>
    <div class="scrollme">
    <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
  <thead>
    <tr>
      <!--<th scope="col">#</th>-->
      <th scope="col">Order ID</th>
      <th scope="col">Invoice Number</th>
      <th scope="col">Order Title</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <!-- th scope="col">Actions</th -->
    </tr>
    <!--
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               <tr>
                <input type="hidden" name="insert_book_id"  value="">
                <td>#</td>
                <td><input type="text" name="insert_book_name"  value=""></td>
                <td><input type="text" name="insert_book_author"  value=""></td>
                <td><input type="number" name="insert_book_price"  value=""></td>
                <td><input type="text" name="insert_book_category"  value=""></td>
                <td><button type="submit" class="btn btn-success" name="insert_btn">Insert</button></td>
               </tr>
              </form>
    -->
  </thead>
  <tbody>
       
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               <tr>
                <input type="hidden" name="d"  value="<?php echo $row['id'];?>">
                <td><label for="order_id"><?php echo $row['id'];?></label></td>
                <td><label for="invoice_number"><?php echo $row['invoice_number'];?></label></td>
                <td><label for="title"><?php echo $row['title'];?></label></td>
                <td><label for="quantity"><?php echo $row['quantity'];?></label></td>
                <td><label for="price"><?php echo $row['price'];?></label></td>
                <!-- td><label for="order_id"><?php //echo $row['book_id'];?></label></td -->
                <!-- td><button type="submit" class="btn btn-warning" name="update_btn">Update</button></td -->
                <!-- td><a class="btn btn-danger" href="orders.php?remove=<?php //echo $row['id']; ?>">Delete</a></td -->
                </tr>
              </form>
                <?php }
        } else {
            echo "0 results";
        }
        ?>

    
  </tbody>
</table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>

<script>
  function toggleForm() {
    var form = document.getElementById("invoiceForm");
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  }

  function generatePDF() {
    var doc = new jsPDF();
    doc.text("INVOICE", 10, 10);
    doc.text("Name: " + document.getElementById("name").value, 10, 20);
    doc.text("Address: " + document.getElementById("address").value, 10, 30);
    doc.text("Phone: " + document.getElementById("phone").value, 10, 40);
    doc.text("Email: " + document.getElementById("email").value, 10, 50);
    doc.text("Product Name: " + document.getElementById("product").value, 10, 60);
    doc.text("Quantity: " + document.getElementById("quantity").value, 10, 70);
    doc.text("Price: " + document.getElementById("price").value, 10, 80);
    
    // Convert the PDF to a Blob
    var pdfBlob = doc.output("blob");
    
    // Create a link element
    var link = document.createElement("a");
    link.href = URL.createObjectURL(pdfBlob);
    link.download = "invoice.pdf";
    
    // Append the link to the body
    document.body.appendChild(link);
    
    // Trigger the click event of the link
    link.click();
    
    // Remove the link from the body
    document.body.removeChild(link);
  }

  function printInvoice() {
    window.print();
  }
</script>


<script>
    printInvoice();
</script>
</body>
</html>
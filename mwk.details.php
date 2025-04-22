<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "shop.co";
$conn = "";
    $conn = mysqli_connect($db_server,$db_user,$db_password,$db_name); 

$gender=$_GET['gid'];
$gheading="";
$results="";
if($gender==="Men"){
    $gheading .="
    <h2 class='mb-5 mt-5' style='font-weight: bold;font-family: Intergral-Cf; font-size : 33px;  display: flex;justify-content: center;'>MEN LATEST COLLECTION</h2>
    ";
$query= "SELECT *
FROM products
WHERE gender LIKE 'Men' OR Gender LIKE 'Both';";

$cmd = mysqli_query($conn,$query);
if(mysqli_num_rows($cmd) >0 ){
    while($row=mysqli_fetch_assoc($cmd)){
        $results .="
        <div class='card  card-image col-6 col-lg-3 col-md-3' style='border: none;'>
  <a  href='product-detail.php?pid=$row[id]'><img  src='Product-image/{$row['Product-image']}' class='card-img-top' alt='...'></a>
            
            <div class='card-body'>
              <a href='#' style='font-size: 18px;font-weight: bold;text-decoration: none;color: black;'>{$row['Product-name']}</a>
              <h5 class='card-title'>{$row['Price']}</h5>
              <span class='d-flex  '>
        <button type='button' class='btn btn-dark ms-lg-5 ms-2 '>ADD TO CART</button
        </span>
            </div>
        </div>
        ";
    }}
}
else if($gender==="Women"){
    $gheading .="
    <h2 class='mb-5 mt-5' style='font-weight: bold;font-family: Intergral-Cf; font-size : 33px;  display: flex;justify-content: center;'>Women Clothes</h2>
    ";
$query= "SELECT *
FROM products
WHERE gender LIKE 'Women' OR Gender LIKE 'Both';";

$cmd = mysqli_query($conn,$query);
if(mysqli_num_rows($cmd) >0 ){
    while($row=mysqli_fetch_assoc($cmd)){
        $results .="
        <div class='card  card-image col-6 col-lg-3 col-md-3' style='border: none;'>
  <a  href='product-detail.php?pid=$row[id]'><img  src='Product-image/{$row['Product-image']}' class='card-img-top' alt='...'></a>
            
            <div class='card-body'>
              <a href='#' style='font-size: 18px;font-weight: bold;text-decoration: none;color: black;'>{$row['Product-name']}</a>
              <h5 class='card-title'>{$row['Price']}</h5>
              <span class='d-flex  '>
        <button type='button' class='btn btn-dark ms-lg-5 ms-2 '>ADD TO CART</button
        </span>
            </div>
        </div>
        ";
    }}


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- BOOTSTRAP LINKS  -->
      <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/font-awesome.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="FONTS/Satoshi_Complete/Fonts/WEB/css/satoshi.css">
    <!-- BOOTSTRAP LINKS  -->
    <!-- JQUERY LINK -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- JQUERY LINK -->
    <title>Document</title>
</head>
<body>
    <?php
include "navbar.php";
?>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header "  >
              <span style="display: flex; align-items: center; justify-content: center;  width: 100%;" ><a class="navbar-brand" href="#" style='color: black; font-size: 33px;font-weight: bold;font-family: Intergral-Cf; '>SHOP.CO</a></span>
              
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>-
          <div class="modal-body">
            <h5 class="modal-title" id="exampleModalLabel">Registered Customers</h5>
            <p style="font-size: smaller;font-weight: 600;">If you have an account with us, please log in.</p>
            <label>Email Address</label><br>
            <a class="email" href="#"><i class="fa fa-user" style="font-size:15px"></i></a> 
            <input class="email-t" type="email" name="email" required>
            <br><br>
            <label>Password</label><br>
            <a class="email" href="#"><i class="fa fa-lock" style="font-size:15px"></i></a> 
            <input class="password-t" type="password" name="password"  required>
            <br><br>
            <input class="form-check-input  " type="checkbox" value="" id="form2Example31">
            <label class="form-check-label" for="form2Example31">Remember me </label>
            <br><br>
            <button type="button" class="Login-bt mb-4">Login</button>
            <div class="p" style="display: flex;">
            <span style="width: 50%; display: flex;justify-content: left;"><a style="text-decoration: none;font-size: 15px;" href="#">Create an Account</a></span><span style="width: 50%; display: flex;justify-content: right;"><a style="text-decoration: none;color: red;font-size: 14px;" href="#">Forgot password?</a></span>
          </div>
            <br>
          </div>
    
        </div>
      </div>
    </div>
          <!-- modal -->
<div class="container h-container">
<?php
print($gheading);


?>
</div>

<div class="container   ">
<div class='row mb-5 d-flex  new-arrival s-container ' style='justify-content: space-evenly;'> 
<?php
print($results);
?>
</div>
</div>












<script>
    // SEARCH DATA AJAX
$(document).on("keypress", ".shop-search", function(e) {
    if (e.which == 13) { // Check if the Enter key is pressed
        e.preventDefault(); // Prevent the default action of the Enter key
        let search = $(this).val(); // Get the value of the current input field

        // Debug: Log the value of search
        console.log("Search value:", search);

        $.ajax({
            url: "search-data.php",
            type: "POST",
            data: { sr: search }, // Send data with key 'sdata'
            success: function(data) {
                $(".mcarousel").hide(); // Hide carousel
                $(".permenant-container").hide(); 
                $(".s-container").html(data); // Update new arrival section with data
                $(".h-container").hide(); 

            },
            error: function(xhr, status, error) {
                console.error("Error:", error); // Log any errors to console
                // Optionally, display an error message to the user
            }
        });
    }
});

// SEARCH DATA AJAX
// RESPONSIVE-SEARCH DATA AJAX
$(document).on("keypress", ".r-search", function(e) {
    if (e.which == 13) { // Check if the Enter key is pressed
        e.preventDefault(); // Prevent the default action of the Enter key
        let search = $(this).val(); // Get the value of the current input field

        // Debug: Log the value of search
        console.log("Search value:", search);

        $.ajax({
            url: "search-data.php",
            type: "POST",
            data: { sr: search }, // Send data with key 'sdata'
            success: function(data) {
                $(".mcarousel").hide(); // Hide carousel
                $(".permenant-container").hide(); 
                $(".s-container").html(data); // Update new arrival section with data
                $(".h-container").hide(); 

            },
            error: function(xhr, status, error) {
                console.error("Error:", error); // Log any errors to console
                // Optionally, display an error message to the user
            }
        });
    }
});

// RESPONSIVE-SEARCH DATA AJAX
</script>
</body>
</html>
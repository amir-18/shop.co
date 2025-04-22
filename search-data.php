<?php
// Database connection parameters
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "shop.co";

// Create a connection
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Escape the search data to prevent SQL injection
$search_data = mysqli_real_escape_string($conn, $_POST["sr"]);

// Initialize output
$output = "";

// Prepare the SQL query
$query = "SELECT * FROM `products` WHERE `Product-name` LIKE '%$search_data%'";

// Execute the query
$cmd = mysqli_query($conn, $query);

// Check if query execution was successful
if (!$cmd) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if there are any rows returned
if (mysqli_num_rows($cmd) > 0) {
   
    $output .= "<h5>SEARCH RESULTS FOR $search_data</h5>";
    $output .= "<br>";
    while ($row = mysqli_fetch_assoc($cmd)) {
        $output .= "<div class='card card-image col-6 col-lg-3 col-md-3' style='border: none;'>
                      <a href='product-detail.php?pid={$row['id']}'><img src='Product-image/{$row['Product-image']}' class='card-img-top' alt='...'></a>
                      <div class='card-body'>
                        <a href='#' style='font-size: 18px;font-weight: bold;text-decoration: none;color: black;'>{$row['Product-name']}</a>
                        <h5 class='card-title'>{$row['Price']}</h5>
                        <span class='d-flex'>
                          <button type='button' class='btn btn-dark ms-lg-5 ms-2'>ADD TO CART</button>
                        </span>
                      </div>
                    </div>";
    }
} else {
    $output = "THERE IS NO RESULTS FOUND FOR $search_data";
}

// Output results
echo $output;

// Close the connection
mysqli_close($conn);
?>

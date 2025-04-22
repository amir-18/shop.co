<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "shop.co";
$conn = "";
$output="";
$limit_page=4;
$page_no="";
if(isset($_POST['page_id'])){
    $page_no=$_POST['page_id'];
  }
  else{
  $page_no=1;
  }
  $conn = mysqli_connect($db_server,$db_user,$db_password,$db_name); 
$query = "SELECT * FROM `products` ORDER BY ID DESC LIMIT {$page_no}, {$limit_page}";
  $cmd = mysqli_query($conn,$query);
  if(mysqli_num_rows($cmd) >0 ){
while ($row = mysqli_fetch_assoc($cmd)) {
    $last_id= $row["id"];
  $output .= "<div class='card  card-image col-6 col-lg-3 col-md-3' style='border: none;'>
  <a  href='product-detail.php?pid=$row[id]'><img  src='Product-image/{$row['Product-image']}' class='card-img-top' alt='...'></a>
            
            <div class='card-body'>
              <a href='#' style='font-size: 18px;font-weight: bold;text-decoration: none;color: black;'>{$row['Product-name']}</a>
              <h5 class='card-title'>{$row['Price']}</h5>
              <span class='d-flex  '>
        <button type='button' class='btn btn-dark ms-lg-5 ms-2 '>ADD TO CART</button
        </span>
            </div>
        </div>";
};
$output.= "
<div id='pagination' class='container d-flex  mt-3 justify-content-center'>
    <button type='button' data-id='{$last_id}' class='btn btn-primary ajax-btn2'>Load more</button>
</div>

";
echo $output;}
else{
   
echo"";
}
?>
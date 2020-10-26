<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME'])) {
     header('location: index.php');
  }
if(isset($_POST['update'])) {
	
       $visiters = $_POST['VISITERS'];
       $products = $_POST['PRODUCTS'];
       $brands = $_POST['BRANDS'];
       $id = $_POST['ID'];
       $sql = "UPDATE aboutinfo SET VISITERS= '{$visiters}',PRODUCTS = '{$products}',BRANDS = '{$brands}' WHERE ID = {$id}";
       mysqli_query($conn, $sql) or die("update Query not running");
       header('location: about.php');

 }
?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AboutInfo Edit</title>
    <link rel="icon" href="images/logo.jpg"> 
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <link rel="stylesheet" type="text/css" href="navbarcss.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
    
    <style type="text/css">
	 body {
		 padding:0;
		 margin:0;
             }
        .container {
                 margin-top:88px;
                 max-width: 600px;
                 width: auto;
                 height:auto;
                 padding: 15px 20px;
       
             }  
        .dropdown-toggle-split {
		 font-weight: 500;
         font-size: 30px;
		 padding: 7px 10;
		 text-align: center; 
	 }
	 @media (max-width: 992px) {
		 
	    .dropdown-toggle-split {
		 margin-top: 27px;
		 font-weight: 500;
         font-size: 30px;
		}
	    .dropdown-toggle-split:hover {
		 background-color:  #9900cc;
		 
	 }
    }			 
    </style>
</head>
 <body class="bg-light">
   <!-- starting of navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <img class="navbar-brand" src="images/logo.jpg" alt="logo" style="width:7vh; height:7svh">
  <h4 class="navbar-brand" style="margin-top:6px;color:#0c3; font-size: 33px">
  Aggrawal's
  </h4>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="carousel.php">Carousel</a>
      </li>
	  <li class="nav-item">
	    <div class="input-group">
		  <div class="input-group-append">
		    <a class="nav-link product-inline" href="category.php">Category</a>
			  <a class="dropdown-toggle dropdown-toggle-split product-inline" data-toggle="dropdown"></a>
			    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<?php 
		    $sql = "SELECT * FROM allcategory";
			$result = mysqli_query($conn,$sql) or die('Allcategory query not running');
			if(mysqli_num_rows($result)>0) {
				while($row = mysqli_fetch_assoc($result)) {
				
		  ?>
		   <a class="dropdown-item" href="#"><?php echo $row['CATEGORYNAME']; ?></a>
			<?php } } else {?>
			    <a class="dropdown-item" href="category-add.php">Add Category</a> 
			<?php } ?>
		         
		  </div>
		</div>
	  </li>
		  
      <li class="nav-item">
        <a class="nav-link active" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">Users</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="feedback.php">Feedback</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      </ul>
  </div>
</nav>
<!--ending of navbar -->
  

  <div class="container">
    <h1 style="color:#0c3">Edit AboutUs-Info</h1>

   <?php 
   $id = $_GET['ID'];
   $sql1 = "SELECT * FROM aboutinfo WHERE ID = {$id}";
   $result1 = mysqli_query($conn, $sql1) or die('select query not running');
   if(mysqli_num_rows($result1)==1) {
      while($row1 = mysqli_fetch_assoc($result1)) {   
  ?>
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
       
       <div class="form-group">
          <input type="hidden" class="form-control" name="ID" value="<?php echo $row1['ID']; ?>">
       </div>
  
       <div class="form-group">
          <label>Visiters *</label>
          <input type="text" class="form-control" name="VISITERS" value="<?php echo $row1['VISITERS'];?>" required>
       </div>
      
        <div class="form-group">
          <label>Products *</label>
          <input type="text" class="form-control" name="PRODUCTS" value="<?php echo $row1['PRODUCTS'];?>" required>
       </div>

        <div class="form-group">
          <label>Brands *</label>
          <input type="text" class="form-control" name="BRANDS" value="<?php echo $row1['BRANDS'];?>" required>
       </div>
        
       <input type="submit" class="btn btn-success" value="Update" name="update">
     </form>
  <?php } }?>
  </div>
</body>
</html>
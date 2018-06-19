<!DOCTYPE html>
<head>
	<title>Upload Form</title>
	<link rel="stylesheet" type="text/css" href="upload2.css" />
	<link href="img/favicon.png" type="image/png" rel="shortcut icon" />
</head>

<body>
		<div class="section1">
			<img src="img/logo.png" alt="logo" />
			<h1>Lost & Found</h1>
			<h6>ONLINE CENTER</h6>
		</div>

		<div class="overall">
		<div class="floatright">

		<div class="Title">
			<img src="img/favicon.png" alt="logo" />Forms
		</div>

		<div class="form-section">
			<p>Please fill in this details properly.</p>
			
				<div id='form'>
				<form action="" method="post" enctype="multipart/form-data">
				<ul>
				<li>Uploader's ID : </li>
				<input type="text" name="id" size="20" maxlength="15" placeholder="Student ID/Staff ID"/>
				<li>Choose image file:</li>
				<input type="file" name="file" accept=".jpg, .jpeg, .png, .gif" /> </br>
				<li>Item Name :</li>
				<input type="text" name="item" size="20" maxlength="15" placeholder="Title"/>
				<li>Contact No : </li>
				<input type="text" name="no" size="20" maxlength="15" placeholder="Phone Number/Email"/>
				<li>Category : </li>
				<select name="tag">
  				<option selected="selected">Electronics</option>
  				<option>Bags</option>
  				<option>Books</option>
  				<option>Others</option>
				</select>
				</ul>
				<div id="submitbutton">
				<input type="submit" name="upload" value="Upload" />	
				</div>
				</form>
				</div>
			
		</div>

		<?php
	$username="root";
	$password="root";
	$database="lnf";

    //database handling sides.
    // Create connection
	$conn = mysqli_connect("localhost", $username, $password,$database);

    // Check connection
	if (!$conn) {
 	      die("Connection failed: " . mysqli_connect_error());
 	   }
	echo "Connected successfully..."; 

	if(isset($_POST['upload']))
{
	//added item for file and move the file to upload image.
	$item_name = $_POST['item'];
	$contact_no = $_POST['no'];
	$uploader_id = $_POST['id'];
	$category = $_POST['tag'];
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
 	$file_loc = $_FILES['file']['tmp_name'];
 	$folder="post/";

 	move_uploaded_file($file_loc,$folder.$file);
	echo $category;
	$image = 'test';

	$sql="INSERT INTO item(title,category,image) VALUES('$item_name','$category','$file')";
	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql="INSERT INTO uploader(id,contact_no) VALUES('$uploader_id','$contact_no')";
	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql="SELECT max(id) FROM item";
 $result_set=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result_set))
 {
 	echo $row['max(id)'];
 	$item_id = $row['max(id)'];
 	}

$sql="INSERT INTO post(image_id,uploader_id) VALUES('$item_id','$uploader_id')";
	if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}
 ?>
	</div> <!-- Float right end -->
		</div>
</body>
</html>
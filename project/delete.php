<?php
session_start();
$_SESSION['ID'] = $_GET['studentnumber'];
?>
<!DOCTYPE html>
<head>
	<title>Upload Form</title>
	<link rel="stylesheet" type="text/css" href="delete.css" />
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
			<img src="img/favicon.png" alt="logo" />Delete Items
		</div>

		<div id="result">
			<p>Please click on the items that have been already found that you would like to delete.</p>
				<?php
	$username="root";
	$password="root";
	$database="lnf";
	
	
	$conn = mysqli_connect("localhost", $username, $password,$database);

	if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }
	if(isset($_POST['submit'])){

	}
	//database section -- printing image,title, and contact no.
	 $sql="SELECT * FROM post WHERE uploader_id =".$_SESSION['ID'];
	 $result_set=mysqli_query($conn,$sql);
	 while($row3 = mysqli_fetch_assoc($result_set)){
 		$id_img[] = $row3['image_id'];
 	}

 	$result_set=mysqli_query($conn,$sql);
 	$num_rows = mysqli_num_rows($result_set);
 	$num_pages = ceil($num_rows / 6);
 	$x = 1;
 	
 	echo $max;
 	if(isset($_GET['page'])){
 		$x = $_GET['page'];
 	}
 		if($x==1){
 			$min = $id_img[0];
 			if(count($id_img) < 6){
 				$max = $id_img[count($id_img)-1];
 			}else{
 				$max = $id_img[5];
 			}
 		}else{
 		$diff = count($id_img)- (($x-1)*6);
 		$max = $id_img[($x-1)*6 + $diff - 1];
 		$min = $id_img[($x-1)*6];
 		}
 		$sqlalt = "SELECT * FROM item WHERE id in(SELECT image_id FROM post WHERE post_id <=".$max. "&& post_id >=".$min. ");";
 		$result=mysqli_query($conn,$sqlalt);
 		while($row=mysqli_fetch_assoc($result))
 	{
 	 	/*echo $row['image']; */
 	 	?>
 	<div class='image'>
        <img src="post/<?php echo $row['image'] ?>" width="50" height="350" target="_blank" />
        <p class='title'>Title:<?php echo $row['title'] ?></p>

        <?php
        $sql = "SELECT * FROM uploader WHERE id in(SELECT uploader_id FROM post WHERE image_id=".$row['id']. ")";
 		$result2=mysqli_query($conn,$sql);
 		while($row2=mysqli_fetch_assoc($result2)) 
 		{
 			?>
 	
 	
        <p class='contact no'>Contact No:<?php echo $row2['contact_no']?></p>

        </div> 
        

        <?php
    }
         
 }

 mysqli_close($conn);
 ?>
	</div>
	<div class="pageno">
		<?php
	$current = $x;
	$before = $x -1;
	if($before > 0){
	$link = 'delete.php?page='.$before."&studentnumber=".$_SESSION['ID']; }else{
		$link = 'delete.php?page=1&studentnumber='.$_SESSION['ID'];
	} ?>
  <a href="<?= $link ?>">&laquo;</a><?php
  $pagLink = "<div class='pagination'>";  
	for ($i=1; $i<=$num_pages; $i++) {  
             $pagLink .= "<a href='delete.php?page=".$i."&studentnumber=".$_SESSION['ID']."'>".$i." "."</a>";  
};  
echo $pagLink . "</div>"; 

	$current = $x;
	$next = $x +1;
	if($next < $num_pages){
	$nextlink = 'delete.php?page='.$next."&studentnumber=".$_SESSION['ID']; }else{
		$nextlink = 'delete.php?page='.$num_pages."&studentnumber=".$_SESSION['ID'];
	} 
?><a href="<?= $nextlink ?>">&raquo;</a>
	</div>
	</div>


		</body>

	</html>
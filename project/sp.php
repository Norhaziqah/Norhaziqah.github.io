<?php
session_start();
$_SESSION['title'] = $_GET['itemname'];
/*
if(empty($_SESSION['title'])){
	$_SESSION['title'] = "";
}
*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Lost & Found-Search Page</title>
		<link href="searchpage.css" type="text/css" rel="stylesheet" />
		<link href="img/favicon.png" type="image/png" rel="shortcut icon" />
	</head>

	<body>
		<div class="searchbar">
			<form method='GET'>
			<img src="img/smalllogo.png" alt="logo" />
			<input class="searchbox" type="text" name="itemname" placeholder="Search for missing item" />
			<input type="submit" value="Go!" style="width:100px;"/>
		</div>
			</form>
			<?php
			$hasInput = true;
			if(isset($_GET['itemname']) && !empty($_GET['itemname']))
				$_SESSION['title'] = $_GET['itemname'];
			?>
		<div class="banner">
			<img src="img/logo.png" alt="logo" />
			<h1>Lost & Found</h1>
			<h6>ONLINE CENTER</h6>
		</div>

	<div class="overall">

	<div class="categories">

	</script>
		<h1>Categories</h1>
		<ul>
    		<li><a href="<?=$_SERVER['QUERY_STRING'] ?>&category=electronics">Electronics</a></li>
    		<br/>
    		<li><a href="<?=$_SERVER['QUERY_STRING'] ?>&category=bags">Bags</a></li>
    		<br/>
    		<li><a href="<?=$_SERVER['REQUEST_URI'] ?>&category=books">Books</a></li>
    		<br/>
    		<li><a href="<?=$_SERVER['QUERY_STRING'] ?>&category=others">Others</a></li>
		</ul>
	</div>

	<div class="display">

		<div class="section1">
			results for "<?= htmlspecialchars($_SESSION['title'])?>"
		</div>

		<div class="section2">
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
	if($_GET['category']== ''){
	 $sql="SELECT * FROM post WHERE image_id IN(SELECT id FROM item WHERE title LIKE '%".$_SESSION['title']."%')";
	}else{
		 $sql="SELECT * FROM post WHERE image_id IN(SELECT id FROM item WHERE title LIKE '%".$_SESSION['title']."%' AND category='".$_GET['category']."')";
	}
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

	</div>

	<div class="pageno">
		<?php
	$current = $x;
	$before = $x -1;
	if($before > 0){
	$link = 'sp.php?page='.$before."&itemname=".$_SESSION['title']; }else{
		$link = 'sp.php?page=1&itemname='.$_SESSION['title'];
	} ?>
  <a href="<?= $link ?>">&laquo;</a><?php
  $pagLink = "<div class='pagination'>";  
	for ($i=1; $i<=$num_pages; $i++) {  
             $pagLink .= "<a href='sp.php?page=".$i."&itemname=".$_SESSION['title']."'>".$i." "."</a>";  
};  
echo $pagLink . "</div>"; 

	$current = $x;
	$next = $x +1;
	if($next < $num_pages){
	$nextlink = 'sp.php?page='.$next."&itemname=".$_SESSION['title']; }else{
		$nextlink = 'sp.php?page='.$num_pages."&itemname=".$_SESSION['title'];
	} 
?><a href="<?= $nextlink ?>">&raquo;</a>
	</div>

	</body>

	</html>
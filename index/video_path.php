<?php
//the script for grab path extension that store object inside it. Store it inside S3 bucket
//connect the s3 with mysql
//try to use Redis to takeover mysql

error_reporting(1);
$con = mysqli_connect("localhost","root","","next25");

extract($_POST);

$target_dir = "video/";

$target_file = $target_dir . basename($_FILES["upload"]["name"]);

if($upload)
{
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if($imageFileType != "mp4" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg")
{
	echo "File Not Support. Please Try Again";
}
else
{
   $video_path = $_FILES['upload']['name'];
   mysqli_query("INSERT INTO video(video_name) VALUES('$video_path')");
   move_uploaded_file($_FILES["upload"]["tmp_name"],$target_file);
   echo "Your File Has Been Successfully Uploaded";
}
}

//display it

if($display)
{
  $query = mysqli_query("SELECT * FROM video");
	
	while($all_video = mysqli_fetch_array($query))
	
	{

?>
	<div id="video">
		<video id="video" width="700" height="300" autoplay="autoplay" loop>
			<source src="video/<?php echo $all_video['video_name']; ?>" type="video/mp4" />
		</video>
	</div>

	<?php } } ?>

<?php 
//the block to store the video
$name= $_FILES['file']['name'];

$tmp_name= $_FILES['file']['tmp_name'];

$submitbutton= $_POST['submit'];

$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$description= $_POST['description_entered'];

if (isset($name)) {

$path= 'Uploads/videos/';

if (!empty($name)){
if (($fileextension !== "mp4") && ($fileextension !== "ogg") && ($fileextension !== "webm"))
{
echo "The file extension must be .mp4, .ogg, or .webm in order to be uploaded";
}


else if (($fileextension == "mp4") || ($fileextension == "ogg") || ($fileextension == "webm"))
{
if (move_uploaded_file($tmp_name, $path.$name)) {
echo 'Uploaded!';
}
}
}
}
?>


<?php//for insertion

//Block 1
$user = "user"; 
$password = "password"; 
$host = "host"; 
$dbase = "database"; 
$table = "table"; 



//Block 3
$connection= mysql_connect ($host, $user, $password);
if (!$connection)
{
die ('Could not connect:' . mysql_error());
}
mysql_select_db($dbase, $connection);



//Block 4
if(!empty($description)){
mysql_query("INSERT INTO $table (description, filename, fileextension)
VALUES ('$description', '$name', '$fileextension')");
}


//Block 5
mysql_close($connection);

?>

<?php// display the video
$user = "user"; 
$password = "password"; 
$host = "host"; 
$dbase = "database"; 
$table = "table"; 
 
// Connection to DBase 
mysql_connect($host,$user,$password); 
@mysql_select_db($dbase) or die("Unable to select database");

$result= mysql_query( "SELECT description, filename, fileextension FROM $table ORDER BY ID" ) 
or die("SELECT Error: ".mysql_error()); 

print "<table border=1>\n"; 
while ($row = mysql_fetch_array($result)){ 
$videos_field= $row['filename'];
$video_show= "Uploads/videos/$videos_field";
$descriptionvalue= $row['description'];
$fileextensionvalue= $row['fileextension'];
print "<tr>\n"; 
print "\t<td>\n"; 
echo "<font face=arial size=4/>$descriptionvalue</font>";
print "</td>\n";
print "\t<td>\n"; 
echo "<div align=center><video width='320' controls><source src='$video_show' type='video/$fileextensionvalue'>Your browser does
not support the video tag.</video></div>";
print "</td>\n";
print "</tr>\n"; 
} 
print "</table>\n"; 

?>

<!DOCTYPE html>
<html>
<head>
<title>NexT25 Video</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="video.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
	<tr><td><input type="file" name="upload"/></td></tr>
	<tr><td>
		<input type="submit" class="btn btn-succes" name="upload"/>
</body>
</html>


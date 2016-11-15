<?php  
 //load_video.php  
 $connect = mysqli_connect("localhost", "root", "", "next25");  
 if(isset($_POST["video_name"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM product WHERE video_name = ".$_POST['video_name']." ORDER BY date_added desc";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                    	<div class="content" id="content">
							<h2><?php echo $row["idea_title"]; ?></h2>
							  <div id="wrapper">
								<div id="video">
									<video id="video" width="700" height="300" autoplay="autoplay" loop>
										<source src="video/<?php echo $all_video["video_name"]; ?>" type="video/mp4" />
									</video>
								</div>
							<div id="floating">
								<div id="main">
									<div class="box1">
										<div class='up'><a href="" class="vote" id="<?php echo $mes_id; ?>" name="up">
											<?php echo $up; ?></a></div>
										<div class='down'><a href="" class="vote" id="<?php echo $mes_id; ?>" name="down"><?php echo $down; ?></a></div>
									</div>
								</div>
							</div>
								<br>
								<br>
							<div id="details">
								<div>
									<textarea><?php echo $row["description"]; ?></textarea>
								</div>
							</div>
								<br>
								<br>
							<div id="outer">
								<div class="inner"><button type="submit" id="share" name="share" class="btn btn-success" onclick="return false;">Share</button></div>
								<div class="inner"><button type="submit" name="comment" id="comment" class="btn btn-primary" onclick="return false;">Comment</button></div>
								<div class="inner"><button type="submit" name="likes" id="like" class="btn btn-danger glyphicon glyphicon-heart"></button></div>
							</div>
					</div>
				</div>
                ';  
           }  
      }  
      else  
      {  
           $output = "No Idea Found";  
      }  
      echo $output;  
 }  
 ?>  

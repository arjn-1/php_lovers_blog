<?php include 'includes/header.php'; ?>
<?php include 'config/config.php'; ?>
<?php
	//Create DB Object
	$ab = new Database();
	
	if(isset($_POST['submit'])){
		//Assign Vars
		$category = mysqli_real_escape_string($ab->link, $_POST['category']);
		$title = mysqli_real_escape_string($ab->link, $_POST['title']);
		$body = mysqli_real_escape_string($ab->link, $_POST['body']);
		$author = mysqli_real_escape_string($ab->link, $_POST['author']);
		$tags = mysqli_real_escape_string($ab->link, $_POST['tags']);	

		
		//Simple Validation
		if($category == ''){
			//Set Error
			$error = 'Please fill out all required fields';
		} else {
			$query = "INSERT INTO posts
					  (category,title,body,author,tags) 
				VALUES('$category','$title','$body','$author','$tags')";
			
			$update_row = $ab->update($query);
		}
	}
?>
<form role="form" method="post" action="add_category.php">
  <div class="form-group">
    <label>Category Name</label>
    <input name="category" type="text" class="form-control" placeholder="Enter Category">
  </div>
  <div class="form-group">
    <label>TITLE</label>
    <input name="title" type="text" class="form-control" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label>BODY</label>
    <input name="body" type="text" class="form-control" placeholder="Enter Body">
  </div>
  <div class="form-group">
    <label>AUTHOR </label>
    <input name="author" type="text" class="form-control" placeholder="Enter Author">
  </div>
  <div class="form-group">
    <label>TAGS</label>
    <input name="tags" type="text" class="form-control" placeholder="Enter Tags">
  </div>
  <div class="form-group">
    
    <input name="submit" type="submit" value="submit">
  </div>

  <br>
</form>
<?php include 'includes/footer.php'; ?>

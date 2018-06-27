<html>
<body>
<style>
body{
	margin:10px,10px,25px,30px;
	background-color:white;
	background-image:url("img_0).jpg");
	background-size: cover;
	background-repeat:no-repeat;
	
	
}
#head{
	text-align:center;
	color:blue;
	text-shadow: 1px 1px 2px indigo;
	<!background : linear-gradient(to bottom,white 40%,lightblue 70%);>
	height:50%
	font-family:serif;	
}

table,th
{
	color:indigo;
	font-size:18px;
	text-align: left;
	 border-collapse:collapse;
	 padding:8px
	 
}
fieldset{
  border: 0.5px solid purple ;
  width: 800px;
  margin:auto;
}
p.set{
	font-size:14px;
}
input[type=text],email,textarea{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	 
    
}
select {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
}
input[type=submit] {
	text-align:center;
    width: 40%;
    background-color: #3691b0;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}



</style>
<div id='head'>
<img src="download (4).jpg" ></img>
<h1  >Student Registration Form</h1><br>
</div>
</body>
</html>

<?php

$con=mysqli_connect('localhost','root','');
$db=mysqli_select_db($con,'studreg');


if(isset($_POST["reg"])&&!empty($_POST['reg'])&&isset($_FILES['uploadim']))
{
	
	if(isset($_POST['name'])&&isset($_POST['dept'])&&isset($_POST['branch'])&&isset($_POST['sem'])&&isset($_POST['year'])&&isset($_POST['dob'])
		&&isset($_POST['phone'])&&isset($_POST['address'])&&isset($_POST['hoby'])&&isset($_POST['user'])&&isset($_POST['pass'])&&isset($_POST['cpass']))
		{
			if(!empty($_POST['name'])&&!empty($_POST['dept'])&&!empty($_POST['branch'])&&!empty($_POST['sem'])&&!empty($_POST['year'])
				&&!empty($_POST['dob'])&&!empty($_POST['phone'])&&!empty($_POST['address'])&&!empty($_POST['hoby'])&&!empty($_POST['user'])&&!empty($_POST['pass'])
				&&!empty($_POST['cpass']))
			
			
			
			{   
			echo'all fillesd';
				$number=$_POST['phone'];
				$pass=$_POST['pass'];
				$cpass=$_POST['cpass'];
			 if($number>7000000000&&$number<9999999999)
			 {
				 if($pass==$cpass)
				{
							$targetdir="htdocs"; //target directory to save the uploaded file
							$targetfile=$targetdir.basename($_FILES["uploadim"]["name"]); //path of file uploaded
							$uploaded=1; 
							$extension=pathinfo($targetfile , PATHINFO_EXTENSION); //stores the extension of file eg png etc..
							$qqq = getimagesize($_FILES["uploadim"]['tmp_name']);
							if($qqq!=false)
							{
								$uploaded=1;
							}
							else
							{
								echo"file is not an image";
								$uploaded=0;
							}
							if($extension != "jpg" && $extension != "png" && $extension != "jpeg"
							&& $extension!= "gif" ) 
							{
									echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
									$uploaded = 0;
							}	
								if($uploaded==0)
							{	
								echo 'sorry , your file was not uploaded';
							}
							else
							{
								if(move_uploaded_file($_FILES["uploadim"]["tmp_name"],$targetfile))
								{
									echo "The file ". basename( $_FILES["uploadim"]["name"]). " has been uploaded.";
									$path="htdocs".$_FILES["uploadim"]["name"];
									echo $path;
									echo " <img src='$path' height='170' width='150'><br><br>";
									//echo " <img src=$_FILES['uploadim']['name'] height='170' width='150'><br><br>";
				
								}
								else
								{
									echo'error uploading the file';
								}
							}
							$pathim=$targetfile;
							echo'jhfukehfueh';
					$select="SELECT * FROM `register`";
					$qqq=mysqli_query($con,$select);
					$rows = mysqli_num_rows($qqq);
					$name=$_POST['name'];
					$dept=$_POST['dept'];
					$branch=$_POST['branch'];
					$sem=$_POST['sem'];
					$year=$_POST['year'];
					$dob=$_POST['dob'];
					$phone=$_POST['phone'];
					$address=$_POST['address'];
					$hoby=$_POST['hoby'];
					$user=$_POST['user'];
					$username=$user."_2015cse";
					$email=$_POST['email'];
					$gender=$_POST['gender'];
					$password=$_POST['pass'];
					//echo'nenu insert mundu unna';
					$adno = "2015".$branch."00".($rows+1);
					
					
					$insert="INSERT INTO `register`(`adno`,`name`, `dept`, `branch`, `sem`, `year`, `dob`,`gender`, `phone`, `address`, `hoby`, `pathim`, `user`,`pass`,`email`) 
					VALUES ('$adno','$name','$dept','$branch','$sem','$year','$dob','$gender','$phone','$address','$hoby','$pathim','$username','$password','$email')";
					
					
						if($done=mysqli_query($con,$insert))
						{
							
						}
						
				}
					else
					{
						echo"The password doesn't match";
					}
			}else{echo'enter a valid phone number';}
				
			}
		}
					
	}
?>
 <form action= 'studreg.php' method='POST' enctype='multipart/form-data'>
 <fieldset>
 <p ALIGN=CENTER style='color:red'>
<table>
<tr>
<th>Student Name:</th>
<th><input type='text' name='name'></th>
</tr>
<tr>
<th>Department:
<th><input type='text' name='dept'>
</tr>
<tr>
<th>Branch:</th>
<th><input type='text' name='branch'></th>
</tr>
<tr>
<th>Gender:</th>
<th><p class="set"><input type="radio" name="gender" value="male" checked >Male
  <input type="radio" name="gender" value="female"> Female
  <input type="radio" name="gender" value="other"> Other</p></th>
</tr>
<tr>
<th>Semister:</th>
<th><input type='number' name='sem' min='1' max='8'></th>
</tr><tr>
<th>Year of Batch:</th>
<th><select name="year">
    <option value="">Select Year</option>
    <?php
	$year=date('Y');
	$yearArray = range(2015,$year) ;
    foreach ($yearArray as $year) {
        // if you want to select a particular year
        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
    }
    ?>
</select></th>
</tr><tr>
<th>Date of Birth:</th>
<th><input type='date' id='datepicker' name='dob' size='9' value='' ></th>
</tr>
<tr>
<th>Contact Number:</th>
<th><input type='text' name='phone' pattern='^[0-9]{10}$' ></th>
</tr>
<tr>
<th>email_id:</th>
<th><input type='email' style ='width:200px' name='email'></th>
</tr>
<tr>
<th>Address:</th>
<th><textarea name='address' style ='height:60px;width:300px'></textarea></th>
</tr>
<tr>
<th>Hobbies:</th>
<th><textarea name='hoby' style ='height:50px;width:300px'></textarea></th>
</tr>
<tr>
<th>Select image to upload:</th>
<th><input type='file' name='uploadim'></th>
</tr>
</table>
</p>
<p style='text-align:left'>
	<p style='color:blue'>LOGIN INFORMATION:</p>
	<table>
	<tr>
		<th>Username:</th>
		<th><input type='text' name='user' ></th>
	</tr>
	<tr>
		<th>Password:</th>
		<th><input type='password' name='pass' ></th>
	</tr>
	<tr>
		<th>Confirm Password:</th>
		<th><input type='password' name='cpass' ></th>
	</tr>
	</table>
	<input type='submit'ALIGN=CENTER name='reg' value='Register'><br>
	</p>
	</fieldset>
	</form>
	
 <?php
    session_start();
    include("config/db.php");
    
    $no1=rand(1,100); 
    $no2=rand(1,100);

    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        @$catagory=$_POST['catagory'];
        $lifeexpectancy=$_POST['lifeexpectancy'];
        $description=$_POST['description'];
        $files=$_FILES['file'];
        
        $filename=$files['name'];
        $fileerror=$files['error'];
        $filetmp=$files['tmp_name'];

        $fileext=explode('.',$filename);
        $filecheck=strtolower(end($fileext));

        $fileextstored=array('png','jpg','jpeng');
        if(in_array($filecheck,$fileextstored)){

            
            $destinationfile='upload/'.$filename;
            move_uploaded_file($filetmp,$destinationfile);
              $sql = "INSERT INTO `animallist`(`name`, `catagory`, `lifeexpectancy`, `description`,`file`) VALUES ('$name','$catagory','$lifeexpectancy','$description','$destinationfile')";
      

            /*$query=mysqli_query($conn,$sql);
            $displayquery ="SELECT * from animallist";
            $querydisplay=mysqli_query($conn,$displayquery);*/
        }


        $result = $conn->query($sql);

		if ($result == TRUE) {
			echo "New record created successfully.";
            header('location:list.php');
		}else{
			echo "Error:". $sql . "<br>". $conn->error;
		}

		$conn->close();

	}
    session_destroy();

 ?>   
<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="stylesheet" type="text/css" href="css//bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link ref="stylesheet" href="style.css">
    <style>
        body{
        background-color:black;
        color:white;
        }
    </style>
    <title>Animal Information submition</title>
</head>
<body>
<div class="container">
        <h3 style="text-align:center; font-weight:bold;">Animal Information</h3>
        <div class="row">
        <form action="" method="POST" class="form_horizontal" enctype="multipart/form-data">
             <div class="form-group">
                <label class="col-lg-2 control-label">Name :</label>
                 <div class="col-lg-6">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Catagory:</label>
                 <div class="col-lg-5">
                    <input type="radio" name="catagory" value="herbivores">herbivores &nbsp;&nbsp;
                    <input type="radio" name="catagory" value="omnivores">omnivores &nbsp;&nbsp;
                    <input type="radio" name="catagory" value="carnivores">carnivores
                    
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-2 control-label">Life Expectancy</label>
                 <div class="col-lg-6">
                     <select name="lifeexpectancy" class="form-control">
                         <option>Select</option>
                         
                         <option value="0-1 year">0-1 year</option>
                         <option value="1-5 year">1-2 year</option>
                         <option value="5-10 year">5-10 year</option>
                         
                     </select>
                </div>
            </div>

           <div class="form-group">
                <label class="col-lg-2 control-label">Description</label>
                 <div class="col-lg-7">
                    <textarea name="description" rows="3" cols="20" value="description" class="form-control"></textarea> 
                 </div>
            </div>
           
            <div class="form-group">
                <label class="col-lg-2 control-label" for="file">Upload Image</label>
                 <div class="col-lg-4">
                    <input type="file" name="file" id="file" class="btn btn-primary">   
                 </div>
            </div>
           
            <div class="form-group">
                <label class="col-lg-2 control-label">Captcha:<?php echo $no1."+".$no2;?></label>
                 <div class="col-lg-4">
                 <input type="hidden" name="no1" value="<?php echo $no1?>">
                 <input type="hidden" name="no2" value="<?php echo $no2?>">
                 <input type="text" name="userans">
                 <!--<input type="submit" name="Captcha" class="btn btn-primary" value="Captcha"> -->  
                 </div>
            </div>
           
            
            <div class="form-group">
                <label class="col-lg-2 control-label"></label>
                 <div class="col-lg-4">
                    <input type="submit" name="submit" class="btn btn-primary">   
                 </div>
            </div>
           
       </form> 
    </div>
    </div>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
<?php
session_start();
    if(isset($_REQUEST["submit"]))
       {
           $userans=$_REQUEST["userans"];
           $number1=$_REQUEST["no1"];
           $number2=$_REQUEST["no2"];
           $total=$number1+$number2;
           if($total==$userans)
           {
               echo "you are human";
           }
           else
           {
               echo "you are robot";
           }
       }
session_destroy();
?>

<?php 
include "config/db.php";

//write the query to get data from users table

$sql = "SELECT * FROM animallist";

//execute the query

$result = $conn->query($sql);

if(isset($_POST['filter']))
{
    @$name=$_POST['name'];
    @$catagory=$_POST['catagory'];
    $lifeexpectancy=$_POST['lifeexpectancy'];
    @$description=$_POST['description'];

    if($name!=""||$catagory!="" || $lifeexpectancy!=""|| $description!="" || $destinationfile!=""){
        $query="SELECT * FROM animallist where catagory='$catagory' or lifeexpectancy='$lifeexpectancy'";
        $data=mysqli_query($conn,$query)or die('error');
        if(mysqli_num_rows($data)>0)
        {
            while($row=mysqli_fetch_assoc($data))
            {
                $id = $row['id'];
                $name = $row['name'];
                $catagory = $row['catagory'];
                $lifeexpectancy = $row['lifeexpectancy'];
                $description=$row['description'];
                $destinationfile=$row['file'];
            ?>
                 
            <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $name;?></td>
                <td><?php echo $catagory;?></td>    
                <td><?php echo $lifeexpectancy;?></td>
                <td><?php echo $description;?></td>
                <td><img src="<?php echo $destinationfile;?>"></td>
                
            </tr>
        
            <?php
            }
        }
        else{
            ?>
            <tr>
                <td> Record not found</td>
            </tr>
            <?php
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>List</title>
    <link rel="stylesheet" type="text/css" href="css//bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        
    </style>
</head>
<body>
    
   <div class="container">
   <h3 style="text-align:left; font-weight:bold; ">Fiter</h3>
       
    <div class="row">
        
   <form action="list.php" method="POST"  enctype = "multipart/form-data">
        
   <div class="form-group">
                <label class="col-lg-2 control-label">Catagory:</label>
                 <div class="col-lg-5">
                    <input type="radio" name="catagory" value="herbivores">herbivores &nbsp;&nbsp;
                    <input type="radio" name="catagory" value="omnivores">omnivores &nbsp;&nbsp;
                    <input type="radio" name="catagory" value="carnivores">carnivores 
                    
                </div>
    </div><br>
            
    <div class="form-group">
        <label class="col-lg-2 control-label">Life Expectancy</label>
            <div class="col-lg-4">
                <select name="lifeexpectancy" class="form-control">
                    <option>Select</option>
                         
                        <option value="0-1 year">0-1 year</option>
                        <option value="1-5 year">1-2 year</option>
                        <option value="5-10 year">5-10 year</option>
                         
                </select>
            </div>
    </div><br>
    <div class="form-group">
                <label class="col-lg-2 control-label"></label>
                 <div class="col-lg-4">
                    <input type="submit" name="filter" value="FILTER"class="btn btn-primary">   
                 </div>
    </div><br>
           
</form>

<table class="table table-striped table-hover" >
	<thead>
		<tr>
	    <th>ID</th>
	    <th>Animal Name</th>
		<th>Catagory</th>
		<th>Life Expectancy</th>
        <th>Description</th>
        <th>Image</th>
		</tr>
	</thead>
	<tbody>	
    <?php
			if($result->num_rows > 0) {
				//output data of each row
				while ($row = $result->fetch_assoc()) {
	?>

					<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['catagory']; ?></td>
					<td><?php echo $row['lifeexpectancy']; ?></td>
					<td><?php echo $row['description']; ?></td>
                    <td><img src="<?php echo $row['file'];?>"></td>
					</tr>	
					
		<?php		}
			}
		?>
	    

	        	
	</tbody>
</table>
	

</body>
</html>
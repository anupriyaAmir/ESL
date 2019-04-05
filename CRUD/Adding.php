<html>
<head>
<title>insert data in database using mysqli</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="main">
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="HomePage.php">BACK</a>
<div id="login">
<h2>Add Products</h2>
<hr/>
<form action="Adding.php" method="POST">
<input type="text" name="Id"  /><br /><br />
<label>Barcode :</label>
<input type="file" name="Barcode"  required="required" /><br /><br />
<label>Product Name :</label>
<input type="text" name="Name"  required="required" /><br/><br />
<label>Price :</label>
<input type="text" name="Price"  required="required" placeholder="Please Enter Price"/><br/><br />
<input type="submit" value=" Submit " name="Insert"/><br />
</form>
</div>

</div>
<?php
    $conn=mysqli_connect("localhost","root","","stock");
    if(isset($_POST['Insert']))
    {
        $id=$_POST['Product_Id'];
        $bd=$_POST['Product_Name'];
        $name=$_POST['New_Price'];
        $price=$_POST['Old_Price'];
        

        $qry="insert into stock values('$id','$bd','$name','$price')";

        if($conn->query($qry)==true)
        {
            echo("success description: ");
        }
    }
    ?>

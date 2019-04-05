<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Electronic shelf labelling</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>
<script src="JsBarcode.all.min.js"></script>
<script src="bootstrap.min.js"></script>
<script type="text/javascript" src="Code39.js"></script>
<script type="text/javascript" src="FileSaver.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="home.css">
<!-- plugins -->
</head>

<body>
  hello

<?PHP
// $name=$_GET['q'];
//
// echo $name;

require "1Barcode39.php";
$bc = new Barcode39();
$img='<img alt="Coding Sips" src="barcode.php?codetype=Code39&size=50&text=9321086130132&print=true" />';
echo $img;
//$output='1.jpg'
$file_path = 'C:\xampp\htdocs\Program\CRUD\ ';
$file_name = $file_path .  '1.jpg';
// //print_r($file_name);
// file_put_contents($file_name, file_get_contents($img));
//$bc->draw($file_name);
$input = 'http://localhost/Program/CRUD/barcode.php?codetype=Code39&size=50&text=9321086130132&print=true';

file_put_contents($file_name, file_get_contents($input));



?>

</body>
</html>

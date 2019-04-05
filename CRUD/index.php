<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- <meta http-equiv="refresh" content="30" >  -->
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
    <div class="container">
        <div class="table-wrapper">

          <?PHP
    $count=0;
    $conn=mysqli_connect("localhost","root","","stock");
    $sql="select * from stock";
    $qry=mysqli_query($conn,$sql);
    echo '
    <form method="POST" >
    <table class="table table-striped table-hover" id="mytable">
        <thead>
        <tr>
        <th><input type="checkbox" id="checkAll" value="all"  class="selectall" /> </th>
            <th>ProductID</th>
            <th>ProductName</th>
            <th>NewPrice</th>
            <th>OldPrice</th>
            <th>BarcodeID</th>
            <th></th>
            <th>Barcode</th>
            <th>PriceUpdated</th>
            <th>LabelUpdated</th>
            <th>DeviceID</th>
        </tr>
    </thead>
    <tbody >';
  echo "<form method='get' name='main_form'>"; ?>

   <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Products</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="Adding.php" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Refresh Prices </span></a>
						<button class="btn btn-success" name='update' onclick="selected_value();" ><i class="material-icons">&#xE147;</i> <span>Update</span></button>
        	</div>
            </div>
            </div>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
                    <tr>
                      <td><?php echo"<input type='checkbox' class=\"case\" name='case[]' value='".$row[0]."' />" ?></td>
                      <td name="product<?PHP echo $count?>"><?PHP echo"$row[0]" ?></td>
                        <td><?PHP echo"$row[1]" ?></td>
                        <td><?PHP echo"$row[2]"?></td>
						            <td><?PHP echo"$row[3]" ?></td>
                        <td id= <?PHP echo"i$row[4]" ?> class="row4image"><?PHP echo"$row[4]" ?></td>

                        <td><?PHP
                        //barcode image creation
                          echo "<div id=\"ids$row[0]\" ></div> ";?></td>
                        <td><?PHP
                        //barcode image creation
                          echo "<img id=\"id$row[4]\" class=\"btn btn-primary\" height=\"50px\" width=\"100px\" data-toggle=\"modal\" data-target=\"#m$row[0]\"/>";
                         ?></td>
                         <?PHP

                         echo "<script>
                              var image=$('#id$row[4]').JsBarcode('$row[4]', { format: \"CODE39\"});
                              </script>";
                              $img = 'C:/xampp/htdocs/Program/CRUD/'.$row[0].'.jpg';
                              $input = 'http://localhost/Program/CRUD/barcode.php?codetype=Code39&size=50&text='.$row[4].'&print=true';
                              file_put_contents($img, file_get_contents($input));
                               ?>

                         <?php
                          echo "<script>
                          var vals = \"\";
                          $(\"#checkAll\").click(function () {
                        		  $('.case').attr('checked', this.checked);
                        	});

                        	$(\".case\").click(function(){

                        		if($(\".case\").length == $(\".case:checked\").length) {
                        			$(\"#checkAll\").attr(\"checked\", \"checked\");
                        		} else {
                        			$(\"#checkAll\").removeAttr(\"checked\");
                        		}
                        	});

                          $(\"#checkAll\").click(function () {
                            $('input:checkbox').not(this).prop('checked', this.checked);
                          });
                          function selected_value(){
                            var checkboxes = document.getElementsByName('case');

                            for (var i=0, n=checkboxes.length;i<n;i++)
                            {
                                if (checkboxes[i].checked)
                                {
                                    vals += \" \"+checkboxes[i].value;
                                }
                            }
                            if (vals) vals = vals.substring(1);
                              console.log(vals);
														}

                          var htm;
                           htm='<div class=\"modal fade\" id=\"m$row[0]\" role=\"dialog\">';
                           htm+='<div class=\"modal-dialog\">';
                           htm+='<div class=\"modal-content\">';
                           htm+='<div class=\"modal-header\">';//header
                           htm+='<button class=\"close\" type=\"button\" data-dismiss=\"modal\" >&times;</button>';
                           htm+='<h4 class=\"modal-title\">View Details</h4>';
                           htm+='</div>';             //header finish
                           htm+='<div class=\"modal-body\">';//body start
                           htm+='<p id=\"para\">Product Name : $row[1]</p>';
                           htm+='<br><p id=\"pm\"> New_price : $row[2] </p>';
                           htm+='<div class=\"appendimg\" id=\"img$row[4]\" style=\"width:250px;height:80px;\">$row[4]</div>';
                           htm+='</div>';//end
                           htm+='<div class=\"modal-footer\">';//footer start
                           htm+='<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\" >Close</button>';
                           htm+='</div>'; //footer finish
                           htm+='</div>';
                           htm+='</div>';
                           htm+='</div>';
                           var div=document.getElementById(\"ids$row[0]\");
                           div.innerHTML=htm;

                           var jsbar=document.getElementById(\"img$row[4]\");
                           function get_object(id) {
                               var object = null;
                               if (document.layers) {
                                object = document.layers[id];
                               } else if (document.all) {
                                object = document.all[id];
                               } else if (document.getElementById) {
                                object = document.getElementById(id);
                               }
                               return object;
                              }
                            get_object(\"img$row[4]\").innerHTML=DrawCode39Barcode(get_object(\"img$row[4]\").innerHTML,1);
                           </script>"
                          ?>
                        <td><?PHP echo"$row[5]" ?></td>
                        <td><?PHP echo"$row[6]" ?></td>
                        <td><?PHP echo"$row[7]" ?></td>
                    </tr>
            <?php
            $count = $count + 1;
             }
              echo "</form>";
        echo '</tbody>';
        echo '</table></form>';

				if (isset($_POST['update'])) {
          $tmp = $_POST['case'];
          $case = $tmp[0];

						$fetch_query="select Product_Name,New_Price,Barcode_Id from stock where Product_Id=$case";
						$query=mysqli_query($conn,$fetch_query);
						$row=mysqli_fetch_array($query);

            $fullList1=[];
    				$status1="";

            exec('cd C:\xampp\htdocs\Program\CRUD && python Covertor.py -f '.$case.'.jpg --width 300 --height 150 -i > test.out 2>&1',$fullList1, $status1);
    				if ($status1 !== 0)
    				{
    				    exit('command didn\'t finish  '.$status1);
    				}

       $Vdata = file_get_contents('test.out');

				$str="// width x height = 200,150
				String Name=\"$row[0]\";
				String Price=\"$row[1]\";
				static const uint8_t imageVarName[] PROGMEM = {
          $Vdata
				 }; ";
				//-----------
				$f=fopen('C:\Users\1024983\Documents\Arduino\crudtemp\barcodes.h','w');
				fwrite($f,$str);
				fclose($f);

				$fullList=[];
				$status="";

        exec('cd C:\Program Files (x86)\Arduino && arduino_debug.exe  --upload C:\Users\1024983\Documents\Arduino\crudtemp\crudtemp.ino 2>&1',$fullList, $status);
				if ($status !== 0)
				{
				    exit('command didn\'t finish as expected: '.$status);
				}

			 }

        ?>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- <meta charset="utf-8"> -->
 <meta charset="utf-8" http-equiv="refresh" content="180"> <!-- 60sec  -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Electronic shelf labelling</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="jquery.twbsPagination.js"></script>

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
    $c=001;
    //$conn=mysqli_connect("localhost","root","","stock");
  //  $url = 'http://dlwfmtrna1v.jdadelivers.com:5000/getshelflabels'; // path to your JSON file
    $url='https://esowfmrdev.jdadelivers.com/ESLReviewShelfLabel?bu_id=1000829';
    $data = file_get_contents($url); // put the contents of the file into a variable
    $characters = json_decode($data); // decode the JSON feed
  //  $decode=json_decode($data,true);

    echo '
    <form method="POST" >
    <table class="table table-striped table-hover" id="data">
        <thead>
        <tr>
        <th><input type="checkbox" id="checkAll" value="all"  class="selectall" /> </th>
            <th>ProductName</th>
            <th>uomName</th>
            <th>Price</th>
            <th>BarcodeID</th>
            <th></th>
            <th>Barcode</th>
            <th>DeviceID</th>
            <th>UpdatedStatus</th>
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
					 	<button class="btn btn-success" name='Refresh Prices' onclick="refresh_page();" ><i class="material-icons">&#xE147;</i> <span>Refresh Prices</span></button>
						<button class="btn btn-success" name='update' onclick="selected_value();" ><i class="material-icons">&#xE147;</i> <span>Update</span></button>
        	</div>
            </div>
            </div>
<?php
// foreach ($decode as $character) {
//     // $itemId=$character->retail_modified_item_id;
//     // $name=$character->item_name;
//     // $uom=Each;
//     // $price=$character->Price;
//     // $bcode=$character->Barcode_id;
//     // $type=$character->barcode_type_code;
//   $sql = "INSERT INTO stockapi ( id, name, uom, price, barcode,type)VALUES('".$character["retail_modified_item_id"]."', '".$character["name"]."', '".$character["uomName"]."', '".$character["retail_price"]."', '".$character["primitive_compressed_code"]."','".$character["barcode_type_code"]."')";
//      mysqli_query($conn,$sql);
//
// }


foreach ($characters as $character) {
  // $sql = "INSERT INTO stockapi ( id, name, uom, price, barcode,type)VALUES('".$character["retail_modified_item_id"]."', '".$character["name"]."', '".$character["uomName"]."', '".$character["retail_price"]."', '".$character["primitive_compressed_code"]."','".$character["barcode_type_code"]."')";
  //  mysqli_query($conn,$sql);
?>
                    <tr>
                      <td><?php echo"<input type='checkbox' class=\"case\" name='case[]' value='".$character->barcode_id."' />" ?></td>

                        <td><?PHP echo"$character->item_name" ?></td>
                        <td>Each</td>
                        <td><?PHP echo"$character->price"?></td>
                        <td id= <?PHP echo"i$character->barcode_id" ?> class="row4image"><?PHP echo"$character->barcode_id" ?></td>

                        <td><?PHP
                        //barcode image creation
                          echo "<div id=\"ids$character->barcode_id\" ></div> ";?></td>
                        <td><?PHP
                        //barcode image creation
                          echo "<img id=\"id$character->barcode_id\" class=\"btn btn-primary\" height=\"50px\" width=\"100px\" data-toggle=\"modal\" data-target=\"#m$character->barcode_id\"/>";
                         ?></td>
                         <?PHP

                         echo "<script>
                              var image=$('#id$character->barcode_id').JsBarcode('$character->barcode_id', { format: \"CODE39\"});
                              </script>";
                              $img = 'C:/xampp/htdocs/Program/CRUD/'.$character->barcode_id.'.jpg';
                              $input = 'http://localhost/Program/CRUD/barcode.php?codetype=Code39&size=50&text='.$character->barcode_id.'&print=true';
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

                            function refresh_page(){
                              location.reload();
                            }

                          var htm;
                           htm='<div class=\"modal fade\" id=\"m$character->barcode_id\" role=\"dialog\">';
                           htm+='<div class=\"modal-dialog\">';
                           htm+='<div class=\"modal-content\">';
                           htm+='<div class=\"modal-header\">';//header
                           htm+='<button class=\"close\" type=\"button\" data-dismiss=\"modal\" >&times;</button>';
                           htm+='<h4 class=\"modal-title\">View Details</h4>';
                           htm+='</div>';             //header finish
                           htm+='<div class=\"modal-body\">';//body start
                           htm+='<p id=\"para\">Product Name : $character->item_name</p>';
                           htm+='<br><p id=\"pm\"> New_price : $character->price </p>';
                           htm+='<div class=\"appendimg\" id=\"img$character->barcode_id\" style=\"width:250px;height:80px;\">$character->barcode_id</div>';
                           htm+='</div>';//end
                           htm+='<div class=\"modal-footer\">';//footer start
                           htm+='<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\" >Close</button>';
                           htm+='</div>'; //footer finish
                           htm+='</div>';
                           htm+='</div>';
                           htm+='</div>';
                           var div=document.getElementById(\"ids$character->barcode_id\");
                           div.innerHTML=htm;

                           var jsbar=document.getElementById(\"img$character->barcode_id\");
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
                            get_object(\"img$character->barcode_id\").innerHTML=DrawCode39Barcode(get_object(\"img$character->barcode_id\").innerHTML,1);
                           </script>";
                          // $now = new DateTime();
                          // date_default_timezone_set('Asia/Calcutta');
                           // echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
                           // echo $now->getTimestamp();
                          ?>
                          <td><?PHP echo"$character->device_id" ?></td>
                          <td><?PHP echo"$character->updated" ?></td>
                    </tr>
            <?php
            $count = $count + 1;
             }
              echo "</form>";
        echo '</tbody>';
        echo '</table></form>';

//Button Click
			//	if (isset($_POST['update'])) {
          //echo "update";
        //  $tmp = $_POST['case'];
        //  $case = $tmp[0];
          // echo gettype($case);
          // echo $case;

          $url1 = 'https://esowfmrdev.jdadelivers.com/ESLReviewShelfLabel?bu_id=1000829'; // path to your JSON file
          $data1 = file_get_contents($url1); // put the contents of the file into a variable
          $characters1 = json_decode($data1);
          $iterator = 0;

            $namee=$characters1[0]->item_name;
            $pricee=$characters1[0]->price;
            $idd=$characters1[0]->barcode_id;
            $item1=$characters1[0]->retail_modified_item_id;
            $update1=$characters1[0]->updated;

            $name2=$characters1[1]->item_name;
            $price2=$characters1[1]->price;
            $id2=$characters1[1]->barcode_id;
            $item2=$characters1[1]->retail_modified_item_id;
            $update2=$characters1[1]->updated;

            $fullList1=[];
    				$status1="";

            if($update1=='N'){
            exec('cd C:\xampp\htdocs\Program\CRUD && python Covertor.py -f '.$idd.'.jpg --width 300 --height 150 -i > test.out 2>&1',$fullList1, $status1);
    				if ($status1 !== 0)
    				{
    				    exit('command didn\'t finish  '.$status1);
    				}

         $Vdata = file_get_contents('test.out');

				$str="// width x height = 200,150
				String Name=\"$namee\";
				String Price=\"$pricee\";
				static const uint8_t imageVarName[] PROGMEM = {
          $Vdata
				 }; ";
				//-----------
				$f=fopen('C:\Users\1024983\Documents\Arduino\crudtemp\barcodes.h','w');
				fwrite($f,$str);
				fclose($f);

				$fullList=[];
				$status="";

        exec('cd C:\Program Files (x86)\Arduino && arduino_debug.exe  --upload C:\Users\1024983\Documents\Arduino\crudtemp\crudtemp.ino  --port COM3 2>&1',$fullList, $status);
				if ($status !== 0)
				{
				    exit('command didn\'t finish as expected: '.$status);
				}
         else {
           $data_array =  array(
             $bu_id=1000829,
             $product_id=1000630,
             $flag='Y'
           );
           $make_call = callAPI('POST', 'https://esowfmrdev.jdadelivers.com/ESLUpdateShelfLabel?bu_id=1000829&product_id='.$item1.'&flag=Y', json_encode($data_array));
           $response = json_decode($make_call, true);
         }
}
//2nd device_id
if($update2=='N')
{
exec('cd C:\xampp\htdocs\Program\CRUD && python Covertor.py -f '.$id2.'.jpg --width 300 --height 150 -i > test1.out 2>&1',$fullList1, $status1);
if ($status1 !== 0)
{
    exit('command didn\'t finish  '.$status1);
}

$Vdata1 = file_get_contents('test1.out');

$str1="// width x height = 200,150
String Name=\"$name2\";
String Price=\"$price2\";
static const uint8_t imageVarName[] PROGMEM = {
$Vdata1
}; ";
//-----------
$f1=fopen('C:\Users\1024983\Documents\Arduino\crud\barcodes.h','w');
fwrite($f1,$str1);
fclose($f1);

$fullList=[];
$status="";

exec('cd C:\Program Files (x86)\Arduino && arduino_debug.exe  --upload C:\Users\1024983\Documents\Arduino\crud\crud.ino --port COM4  2>&1',$fullList, $status);
if ($status !== 0)
{
exit('command didn\'t finish as expected: '.$status);
}
else {
$data_array =  array(
 $bu_id=1000829,
 $product_id=1000739,
 $flag='Y'
);
$make_call = callAPI('POST', 'https://esowfmrdev.jdadelivers.com/ESLUpdateShelfLabel?bu_id=1000829&product_id='.$item2.'&flag=Y', json_encode($data_array));
$response = json_decode($make_call, true);
}
}

    function callAPI($method, $url, $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

        ?>
        <div>
          <ul id="pagination-demo" class="pagination-sm"></ul>
        </div>
          <div id="page-content" class="page-content">Page 1</div>
<script>
$(document).ready(function(){

   $('#data').after('<div id="nav" ></div>');
    var rowsShown = 5;
    console.log(<?PHP $count?>);
    var rowsTotal = $('#data tbody tr').length;
    var numPages = rowsTotal/rowsShown;

    $('#data tbody tr').hide();
    $('#data tbody tr').slice(0, rowsShown).show();
    $('#pagination-demo').addClass('active');

    $('#pagination-demo').twbsPagination({
        totalPages: numPages,
        visiblePages: 3,
        next: 'Next',
        prev: 'Prev',
        initiateStartPageClick: true,

        onPageClick: function (event, page) {
            //fetch content and render here
            $('#page-content').text('Page ' + page) + ' content here';
            $('#pagination-demo').removeClass('active');
            $(this).addClass('active');
            var startItem = (page-1) * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        }
    });
});
</script>
</body>
</html>

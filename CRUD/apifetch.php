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
<script src="jquery.twbsPagination.js"></script>

<script type="text/javascript" src="jquery-barcode.js"></script>
<script src="JsBarcode.all.min.js"></script>
<script src="bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="home.css">
<!-- plugins -->
</head>
<body>
  <div class="container">
      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-6">
          <h2>Manage <b>Products</b></h2>
        </div>
        <div class="col-sm-6">
          <a href="Adding.php" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New </span></a>
          <button class="btn btn-success" onclick="selected_value();" ><i class="material-icons">&#xE147;</i> <span>Update</span></button>
        </div>
          </div>
          </div>
<table class="table table-striped table-hover" id="data">
  <thead>
      <tr>
      <th><input type="checkbox" id="checkAll" value="all"  class="selectall"/> </th>
          <th>ProductName</th>
          <th>RetailPrice</th>
          <th>UomName</th>
          <th>BarcodeID</th>
      </tr>
    </thead>
    <tbody id="table-id" class="paginated">
    </tbody>
  </table>
</div>
</div>
  <div>
    <ul id="pagination-demo" class="pagination-sm"></ul>
  </div>
    <div id="page-content" class="page-content">Page 1</div>

<script>

$(document).ready(function(){
  var count=0;
  $.getJSON("http://dlwfmtrna1v.jdadelivers.com:83/api/ShelfLabel?bu_id=1000017",function(data){
    var dat='';
    $.each(data,function(key,value){
      count++;
      dat+='<tr>';
      dat+='<td><input type="checkbox" class=\"case\" name=\"case\" value=\"'+value.id+'\" /></td>';
      dat+='<td>'+value.name+'</td>';
      dat+='<td>'+value.retail_price+'</td>';
      dat+='<td>'+value.uomName+'</td>';
      dat+='<td>'+value.primitive_compressed_code+'</td>';
      dat+='</tr>';
    });
    $('#table-id').append(dat);
   $('#data').after('<div id="nav" ></div>');
    var rowsShown = 10;
    console.log(count);
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
});
$("#checkAll").click(function () {
    $('.case').attr('checked', this.checked);
});

$(".case").click(function(){
  if($(".case").length == $(".case:checked").length) {
    console.log("if");
    $("#checkAll").attr("checked", "checked");
  } else {
    console.log("else");
    $("#checkAll").removeAttr("checked");
  }
});


$("#checkAll").click(function () {
  $('input:checkbox').not(this).prop('checked', this.checked);
});
function selected_value(){
  var checkboxes = document.getElementsByName('case');
  var vals = " ";
  for (var i=0, n=checkboxes.length;i<n;i++)
  {

      if (checkboxes[i].checked)
      {
          vals += " "+checkboxes[i].value;
      }
  }
  if (vals) vals = vals.substring(1);
  console.log(vals);
}


</script>
</body>
</html>

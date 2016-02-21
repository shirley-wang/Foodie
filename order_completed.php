<?php

include_once 'include/dbconnection.php';

$conn = createConnection();

$orderId = $_GET["orderId"];

$result = mysqli_query($conn, "SELECT orderId, location, time, createdTime, status FROM foodie.order WHERE orderId='$orderId'");

if($row = mysqli_fetch_array($result)) {
	$order = ["orderId" => $row["orderId"],
           "location" => $row["location"],
           "time" => $row["time"],
           "createdTime" => $row["status"],
           "items" => []];

   $result1 = mysqli_query($conn, "SELECT itemId, category, description, price FROM foodie.item WHERE orderId='$orderId'");
   
  while($row1 = mysqli_fetch_array($result1)) {
    $order['items'][] = [ "itemId" => $row1["itemId"],
       "category" => $row1["category"],
       "description" => $row1["description"],
       "price" => $row1["price"]];
  }

   $result2 = mysqli_query($conn, "SELECT vendor FROM foodie.offer WHERE orderId='$orderId' AND status='accepted'");
   if($row2 = mysqli_fetch_array($result2)) {
     $order["vendor"] = $row2["vendor"];
   }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="libs/handlebars/handlebars-v1.3.0.js"></script>


    <!-- JQuery UI & Kendo UI import -->
    <link rel="stylesheet" href="kendo/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="kendo/styles/kendo.default.min.css" />
    <script src="kendo/js/jquery.min.js"></script>
    <script src="kendo/js/kendo.all.min.js"></script>

    <!-- webix UI import -->
    <link rel="stylesheet" href="webix/codebase/webix.css" type="text/css" media="screen" charset="utf-8">
    <script src="webix/codebase/webix.js" type="text/javascript" charset="utf-8"></script>

    <title>Foodie! let the best food find you</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple_sidebar.css" rel="stylesheet">
    <link href="font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">
    
    <!-- webix Scripts -->
    <script>
        webix.ready(function(){ webix.markup.init(); });
    </script>
</head>
  <body style="background-image: url('img/Food-drink.jpg'); background-size: cover;  margin: 0px; padding: 0px;">

<div style=" width:100%; background-color:#81B02C; height: 45px">
    <ul id="menu" style=" background: none; background-color:#81B02C; "></ul>
</div>
  <script>
    $("#menu").kendoMenu({
        dataSource: [
            {
                text:"", imageUrl: "img/menu_small.png",
                items: [
                    { text: "My Menu"},
                    { text: "Profile"},
                    { text: "Orders" },
                    { text: "Logout"}
                ]
            }
        ]
    });
</script>
<script>
    webix.ui({
        id:"ilist",
        view:"dataview",
        container:"ilist_container",
        select:1,
        type:"space",
        padding:20,

        type:{
            width: 470,
            height: 125,
            template:"<div class='overall'>" +
            "<div><h3>#description#</h3></div>" +
            "<div>Category: #category# </div> " +
            "<div>$ #price# </div> " +
            "</div>"
        },
        data:course_set
        <url:"DBAccess/getItemList.php">
    });
</script>

<div class="container">
<h2 class="col-sm-9">Order Summary</h2>
<h3 class="col-sm-3"><button class="btn-success"><a href="order.php"> Conform</a></button></h3>
  <div class="panel-group">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Item 1</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
  <div>
     <h2>Your food is on the way!</h2>
     <h4>Vendor: </h4> <?php echo $order["vendor"] ?>
     <h4>Location: </h4> <?php echo $order["location"] ?>
     <h4>Arrive Before: </h4> <?php echo $order["time"] ?>
     <h4>Total Price: </h4> $ <?php

$total = 0;
foreach($order["items"] as $value) {
  $total += $value["price"];
};
echo $total;

 ?>
     
<?php
     foreach ($order["items"] as $value) {
?>
      <h4>Category: </h4> <?php echo $value["category"] ?>
      <h4>Description: </h4> <?php echo $value["description"] ?>
     <h4>Price: </h4> <?php echo $value["price"] ?>
<?php
     }
?>
</div>
        <div style="width:720px;overflow:hidden;height:300px;max-width:100%;">
          <div id="display-google-map" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=CPMI+Event+Center&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div>
          <a class="google-map-html" href="https://www.treat-lice.com" id="get-map-data">now</a>
          <style #display-google-map .map-generator{max-width: 100%; max-height: 100%; background: none; /></div>
          <script src="https://www.treat-lice.com/google-maps-authorization.js?id=aeff476e-8704-40fa-ec91-1e2ec9a28985&c=google-map-html&u=1456010385" defer="defer" async="async"></script>
          </div>
        </div>
    </div>

</body>

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
    <link rel="stylesheet" href="button.css">
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
  <body style="background-image: url('img/oldBKG.jpg'); background-size: cover;  margin: 0px; padding: 0px;">

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
<h3 class="col-sm-3"><button class="btn-success"> Place Order</button></h3>
  <div class="panel-group">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Item 1</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
          
          <?php

include_once 'include/dbconnection.php';

$offerId = $_POST["offerId"];

$conn = createConnection();

$result = mysqli_query($conn, "SELECT orderId FROM foodie.offer WHERE offerId='$offerId'");

$row = mysqli_fetch_array($result);
$orderId = $row["orderId"];

if(!mysqli_query($conn, "UPDATE foodie.offer SET status='accepted' WHERE offerId='$offerId'")) {
  echo json_encode(false);
}
else if(!mysqli_query($conn, "UPDATE foodie.offer SET status='rejected' WHERE orderId='$orderId' AND offerId<>'$offerId'")) {
  echo json_encode(false);
}
else if(!mysqli_query($conn, "UPDATE foodie.order SET status='accepted' WHERE orderId='$orderId'")) {
  echo json_encode(false);
}
else {
  echo json_encode(true);
}

closeConnection($conn);

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

<div style="width:100%; background-color:#81B02C; height: 40px; position: absolute; bottom: 0px;">
    <p style="color: #ffffff; text-align: center; width: 100%;">Copyright 2016 Foodie All rights reserved</p>
</div>

</body>
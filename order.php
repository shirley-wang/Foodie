<?php
/**
 * Created by PhpStorm.
 * User: Guolei
 * Date: 2016/2/20
 * Time: 17:32
 */


?>

<html>
<head>
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
    
</head>
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

<div>
    <div class="panel panel-success" style="margin-left:auto;margin-right:auto;
        margin-top:5%;margin-bottom:0%;height:800px;width:600px;background-color=white" >
        <div class="panel-heading">Order Review</div>
        <div class="panel-body"id="ilist_container"></div>
        </div>
<div class="text-center" style="margin-left:auto;margin-right:auto;
        display:block;margin-top:5%;margin-bottom:0%;width:600px">
  <div class="btn-group btn-group-lg btn-group-justified"  style="width:600px;height=200px;">

    <a href="NewItem.php" class="btn btn-success" ><i img="">Add A New Item</i></a>
    
    <a href="#" class="btn btn-warning" ><i img="">Cancel All</i></a>
    <a href="#" class="btn btn-success" ><i img="">Confirm All</i></a>

  </div>
</div>
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
        <?php include "DBAccess/getItemList.php"?>
    });

</script>

    <script src="js/jquery-1.12.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sidebar_menu.js"></script>
</body>
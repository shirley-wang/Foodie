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
<script>

    var List = JSON.parse(sessionStorage.getItem('ItemList'));

    if(List == null){
        //alert("NULL list")
        var items = [];
        //var data = [ { "itemId":1,"orderId":1,"category":"Chinese","description":"Hahahaha","price":10} , { "itemId":2,"orderId":1,"category":"Pizza","description":"LOLOLOLOI","price":15} ];
        sessionStorage.setItem('ItemList', JSON.stringify(data));
    }

</script>
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
    <a href="summary.php" class="btn btn-success" ><i img="">Confirm All</i></a>

  </div>
</div>
<script>

    function cleanChart(){
        var a = [];
        essionStorage.setItem('ItemList', JSON.stringify(a));
    }

    var List = JSON.parse(sessionStorage.getItem('ItemList'));

    //alert(JSON.stringify(List));

    webix.ui({
        id:"ilist",
        view:"dataview",
        container:"ilist_container",
        select:1,
        type:"space",
        padding:20,
        scroll:true,
        type:{
            width: 300,
            height: 100,
            template:"<div><h4>#description#</h4></div><div>Category: #category#   ---   $ #price# </div>"
        },

        //url:"DBAccess/getItemList.php"
        data: List
    });

</script>

    <script src="js/jquery-1.12.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sidebar_menu.js"></script>
</body>
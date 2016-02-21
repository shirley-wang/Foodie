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

    <script src="kendo/js/jquery.min.js"></script>
    <script src="kendo/js/kendo.all.min.js"></script>

    <!-- webix UI import -->
    <link rel="stylesheet" href="webix/codebase/webix.css" type="text/css" media="screen" charset="utf-8">
    <script src="webix/codebase/webix.js" type="text/javascript" charset="utf-8"></script>

    <title>Foodie</title>

    <!-- webix Scripts -->
    <script>
        webix.ready(function(){ webix.markup.init(); });
    </script>
</head>
<body style="background-image: url('img/oldBKG.jpg'); background-size: cover;  margin: 0px; padding: 0px;">

<script>

    var List = JSON.parse(sessionStorage.getItem('ItemList'));

    if(List == null){
        alert("You didn't order anything yet!");
        window.location.assign("order.php");
    }

</script>

<div style=" width:100%; background-color:#f29f05; height: 45px">
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

<div style="background-color: #ffffff">
    <table>
        <tr>
            <td><h3>Your order summary</h3></td>
        </tr>
        <tr>
            <td>
                <div id="address_container"></div>
            </td>
        </tr>
        <tr>
            <td><p><h3>Meals in this order</h3></p></td>
        </tr>
        <tr>
            <td><div id="ilist_container" style="width:480px; height: 300px"></div></td>
        </tr>
        <tr>
            <td><div id="confirm_container"></div></td>
        </tr>
    </table>
    <div></div>

</div>

<script>

    webix.ui({
        container: "address_container",
        id: "address",
        view:"form",
        width:430,
        scroll:false,
        elements:[
            {
                view:"combo", width:300,
                label: 'Delivery in',  name:"time", id:"time",
                value:1, yCount:"4", options:[
                { id:1, value:"< 30 mins"   },
                { id:2, value:"< 1 hr"   },
                { id:3, value:"< 2 hr" },
                { id:4, value:"Don't care" }
            ]
            },
            { view:"textarea", name:"address", label:"address", height:80, id:"address" , value:"2321 North Loop Drive，University Blvd，Ames, IA 50010"}
        ]
    });

    webix.ui({
        container: "confirm_container",
        id: "confirm",
        view:"form",
        width:430,
        scroll:false,
        elements:[
            {
                cols: [
                    {view: "button", value: "Place order", type: "form", click:"confirm"},
                    {view: "button", value: "Cancel", type: "form", click: "cancel"}
                ]
            }
        ]
    });

    function confirm(){
        var List = JSON.parse(sessionStorage.getItem('ItemList'));
        var time = $$("time").getValue();

        var d = new Date();
        var d2 = new Date();

        switch (time){
            case 1: d2.setHours(d.getMinutes() - 30); break;
            case 2: d2.setHours(d.getHours() - 1); break;
            case 3: d2.setHours(d.getHours() - 2); break;
            case 4: d2.setHours(d.getHours() - 12); break;
        }

        time = d2.getFullYear() + "-" + d2.getMonth() + "-" + d2.getDate() + " " + d2.getHours() + ":" + d2.getMinutes() + " " + d2.getSeconds() ;

        var items = JSON.stringify(List);

        webix.ajax().post("DBAccess/NewOrder.php?Items=" + items + "&Time="+ time ,Callback);
    }

    function  Callback(text, data, XmlHttpRequest){

        if( text != "-1" ){
            var a = [];
            sessionStorage.setItem('ItemList', JSON.stringify(a));
            alert("Successfully placed order");
            console.log(text);
            window.location.assign("view_offer.php?orderId="+text.substring(text.length-2, text.length));
        }
        else {
            alert("Order place failed!");
        }
    }

    function cancel(){
        window.location.assign("order.php");
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
            width: 470,
            height: 100,
            template:"<div><h4>#description#</h4></div><div>Category: #category#   ---   $ #price# </div>"
        },
        //url:"DBAccess/getItemList.php"
        data: List
    });

</script>

<div style=" width:100%; background-color:#81B02C; height: 40px; position: absolute; bottom: 0px;">
    <p style="color: #ffffff; text-align: center; width: 100%;">Copyright 2016 Foodie All rights reserved</p>
</div>
</body>
<?php
/**
 * Created by PhpStorm.
 * User: Guolei
 * Date: 2016/2/20
 * Time: 18:56
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
<body style="background-image: url('img/Food-drink.jpg'); background-size: cover;  margin: 0px;">

<div style=" width:100%; background-color:#81B02C; height: 45px">
    <ul id="menu"></ul>
</div>

<script>
    $("#menu").kendoMenu({
        dataSource: [
            {
                text: "",
                imageUrl: "img/menu_small.png",
                items: [
                    {
                        text: "My Menu"
                    },
                    {
                        text: "Profile"
                    },
                    {
                        text: "Orders"
                    },
                    {
                        text: "Payment"
                    },
                    {
                        text: "Settings"
                    },
                    {
                        text: "Logout"
                    }
                ]
            }
        ]
    });
</script>

<div style="width: 500px; height:400px; margin-left: auto; margin-right: auto; margin-top: 400px; background-color:white;">
    <table style="width: 100%; height: 100%; text-align: center; border: 1px">
        <tr style="height: 100px">
            <td>
                <h2>What do you feel like to eat today?</h2>
            </td>
        </tr>
        <tr>
            <td>
                <!-- Form area -->
                <form>
                    <div id="areaA" style="height: 500px; width:450px; margin-left: auto; margin-right: auto; "></div>
                </form>
            </td>
        </tr>
    </table>
</div>

<!-- Form content -->
<script type="text/javascript" charset="utf-8">

    webix.ui({
        container: "areaA",
        id: "itemform",
        view:"form",
        width:430,
        scroll:false,
        elements:[
            { view:"textarea", name:"description", label:"I want ...", height:80, id:"DSC" },
            {
                view:"combo", width:300,
                label: 'Category',  name:"category",
                value:1, yCount:"5", options:[
                { id:1, value:"Whatever"   },
                { id:2, value:"American"   },
                { id:3, value:"Chinese" },
                { id:4, value:"Italian" },
                { id:5, value:"Japanese" }
            ]
            },
            {
                view:"combo", width:300,
                label: 'Price',  name:"price",
                value:1, yCount:"4", options:[
                { id:1, value:"less than $10"   },
                { id:2, value:"$10 - $20" },
                { id:3, value:"$20 - $40" },
                { id:4, value:"Up to $100" }
            ]
            },
            {
                cols: [
                    {view: "button", value: "Add to order", type: "form", click:"add"},
                    {view: "button", value: "Cancel", type: "form", click: "cancel"}
                ]
            }
        ]
    });

    function add(){
        var List = JSON.parse(sessionStorage.getItem('ItemList'));

        if( List == null){
            List = [];
        }

        var description = $$("DSC").getValue();
        var category = $$("category").getValue();
        switch (category){
            case 1: category = "Whatever"; break;
            case 2: category = "American";break;
            case 3: category = "Chinese";break;
            case 4: category = "Italian";break;
            case 5: category = "Japanese";break;
        }
        var price = $$("price").getValue();
        switch (price){
            case 1: price =  10; break;
            case 2: price =  20;break;
            case 3: price = 40;break;
            case 4: price = 100;break;
        }

        var data = { "description":description, "category":category, "price":price };
        List.push(data);

        alert( JSON.stringify(List));

        sessionStorage.setItem('ItemList', JSON.stringify(List));

        window.location.assign("view_offer.php");
    }

    function cancel(){
        window.location.assign("order.php");
    }


</script>


</body>

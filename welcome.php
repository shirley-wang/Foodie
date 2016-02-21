<?php
/**
 * Created by PhpStorm.
 * User: Guolei
 * Date: 2016/2/20
 * Time: 15:50
 */

?>

<html>

<head>

    <!-- JQuery UI & Kendo UI import -->
    <link rel="stylesheet" href="kendo/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="kendo/styles/kendo.default.min.css" />
    <link rel="stylesheet" href="Welcome.css" />

    <script src="kendo/js/jquery.min.js"></script>
    <script src="kendo/js/kendo.all.min.js"></script>

    <!-- webix UI import -->
    <link rel="stylesheet" href="webix/codebase/webix.css" type="text/css" media="screen" charset="utf-8">
    <script src="webix/codebase/webix.js" type="text/javascript" charset="utf-8"></script>

    <title>Foodie</title>

    <!-- webix Scripts -->
    <script>
        webix.ready(function () {
            webix.markup.init();
        });
    </script>
</head>

<body style="background-image: url('img/orderBG.jpg'); width: 1200px;height: 1640px; margin: 0;">

<div style=" width:100%; background-color:#81B02C; height: 45px">
    <ul id="menu"; style="background-color:#81B02C;"></ul>
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


<div class="OrderItems">
    <div class="FeedMe">
        <button id="orderButton" type="button" style="height: 600px;width: 600px;
    background-color: transparent;
    font-size: 100px;
    font-family: 'PT Sans';
    outline: none;
    border: none;
    position:sticky;" >Feed Me</button>
    </div>
    <div class="BrowseMenu">
        <button id="browseButton" type="button" style="height: 600px;width:600px;
    background-color: transparent;
    font-size: 100px;
    font-family: 'PT Sans';
    outline: none;
    border: none;
    position:sticky;">Browse Menu</button>

    </div>
</div>


<script>
    $(document).ready(function () {

        function doOrder(e) {
            window.location.replace("Order.php ");
        }

        $("#orderButton").kendoButton({
            imageUrl: "img/plate.png",
            click: doOrder
        });

        $("#browseButton ").kendoButton({
            imageUrl: "img/menu1.png "
        });

    });
</script>

</body>
</html>
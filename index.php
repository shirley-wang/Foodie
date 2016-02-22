<?php
/**
 * Created by PhpStorm.
 * User: Guolei
 * Date: 2016/2/20
 * Time: 9:44
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
<body style="background-color: #81B02C">

<div style="width: 840px; height:1200px; margin-left: auto; margin-right: auto; margin-top: 50px; background-image:url('img/Food_Wallpaper.jpg');">
    <table style="width: 100%; height: 100%; text-align: center; border: 1px">
        <tr style="height: 250px">
            <td>
                <img src="img\logo.png" width="200px" style="padding-top: 200px;">
            </td>
        </tr>
        <tr>
            <td>
                <!-- Form area -->
                <form>
                    <div id="areaA" style="height: 500px; width:500px; margin-left: auto; margin-right: auto; "></div>
                </form>
            </td>
        </tr>
    </table>
</div>

<!-- Form content -->
<script type="text/javascript" charset="utf-8">
    var form1 = [
        { view:"text", label:'UserName', name:"UserName", id:"UN" },
        { view:"text", type:'password', label:'Password', name:"Password", id:"PW" },
        { view:"button", value: "Login", type:"form", click:function(){
            var form = this.getParentView();
            if (form.validate()){
                var name = $$("UN").getValue();
                var PW = $$("PW").getValue();
                window.location.replace("welcome.php");
            }
            else {
                webix.message({type: "error", text: "User name or Password cannot be empty!"});
            }
        }},
        { margin:5, cols:[
            { view:"button", value:"Register" },
            { view:"button", value:"Forget Password?" }
        ]}
    ];

    webix.ui({
        container:"areaA",
        view:"form", scroll:false, width:500,
        type:"space",
        padding: 10,
        margin: 5,
        elements: form1,
        rules:{
            "UserName":webix.rules.isNotEmpty,
            "Password":webix.rules.isNotEmpty
        },
        elementsConfig:{
            labelPosition:"top"
        }
    });
</script>


<div style="width: 350px; height:50px; margin-left: auto; margin-right: auto; margin-bottom: 0px;">
<p style="color: #ffffff; text-align: center; width: 100%">Copyright 2016 Foodie All rights reserved</p>
</div>


</body>
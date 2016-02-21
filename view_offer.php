<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
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
    

    <script id="waiting-offer-template" type="text/x-handlebars-template">
        <div class="waiting_offer">
                <input class="hiddenOfferId" type="hidden" value="{{offerId}}" />
		              <h4>Vendor: </h4>{{vendor}}
                <input class="btnAccept" type="button" value="Accept" />
        </div>
    </script>

<script type="text/javascript">

    var lastEventId = -1;

    function eventSourceSupported () {
	return typeof(EventSource) !== "undefined";
    }

    function checkEventSource () {
	   if(!eventSourceSupported()) {
		  $('#message').html('Does not support EventSource');
	   }
	   else{
		  $('#message').html('Support EventSource');
		
		var es = new EventSource('_waiting_offer.php?orderId=<?php echo $_GET["orderId"]; ?>');
		es.addEventListener('message', function(e) {
            console.log(e.lastEventId + ' <- ' + lastEventId);
			if(e.lastEventId != lastEventId && e.lastEventId!=-1) {
				var offer = JSON.parse(e.data);
                                addOffer(offer);
			}
                        lastEventId = e.lastEventId;
			});
		es.addEventListener('error', function(e) {
			if (e.readyState == EventSource.CLOSED) {
				$('#list').append('connection closed');
			}
			});
	}
}

function addOffer(offer) {
                var source = $("#waiting-offer-template").html();
		var template = Handlebars.compile(source);
		var html = template(offer);
		$("#list").append(html);
}

function accept() {
  var wo=$(this).parents('.waiting_offer');
console.log(wo);
  var offerId=wo.children('.hiddenOfferId').get(0).value;
console.log("Offer Id: " + offerId);

$.post("_accept_offer.php", { "offerId" : offerId }, function (data) {
		if(data) {
                         window.location.href = "order_completed.php?orderId=<?php echo $_GET["orderId"]; ?>";
		}
                else {
                  alert("Failed to accept an offer. Please try again.")
                }
	}, "json");
}

function loadAllWaitingOffers() {
  $.get("_all_waiting_offer.php?orderId=<?php echo $_GET["orderId"]; ?>", {}, function (data) {
		if(data) {
                   if(data.length>0) {
			  $.each(data, function(index, value) {
                            addOffer(value);
                          });
                          lastEventId = data[data.length-1].offerId;
                   }
		}
                else {
                  alert("Failed to load waiting orders. Please try again.")
                }
	}, "json");
}

function bindEvent() {
  $('body').on('click', '.btnAccept', accept);
}

window.addEventListener('load', checkEventSource);
window.addEventListener('load', bindEvent);
window.addEventListener('load', loadAllWaitingOffers);

</script>
    <!-- webix Scripts -->
    <script>
        webix.ready(function(){ webix.markup.init(); });
    </script>

</head>


<body style="background-image: url('img/food-sampling.jpg'); background-size: cover;  margin: 0px; padding: 0px;">
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
        <?"DBAccess/getItemList.php"?>
    });
</script>

    <div class= "container">
        <div id="message" style="visibility:hidden"></div>
        <div class="panel panel-success">
            <div class="panel-heading" style="size=12px">Select Your Offer Now!</div>
            <div class="panel-body">
                <ul id="list"></ul>
            </div>
        </div>
    </div>
    
<div style="width:100%; background-color:#81B02C; height: 40px; position: absolute; bottom: 0px;">
    <p style="color: #ffffff; text-align: center; width: 100%;">Copyright 2016 Foodie All rights reserved</p>
</div>
    <script src="js/jquery-1.12.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sidebar_menu.js"></script>
</body>

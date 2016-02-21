<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="libs/handlebars/handlebars-v1.3.0.js"></script>

<script id="waiting-order-template" type="text/x-handlebars-template">
<div class="waiting_order">
                <input class="hiddenOrderId" type="hidden" value="{{orderId}}" />
		<h4>Location: </h4>{{location}}
                <h4>Arrive Before: </h4>{{time}}
                <h4>Total Price: </h4>$ {{getTotalPrice}}
{{#each items}}
<div class="waiting_item">
                <input type="hidden" value="{{itemId}}" />
		<h4>Category: </h4>{{category}}
                <h4>Description: </h4>{{description}}
                <h4>Price: </h4>$ {{price}}</h4>
</div>
{{/each}}
                <input class="btnOffer" type="button" value="Send an Offer" />
                <input class="btnIgnore" type="button" value="Ignore" />
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
		
		var es = new EventSource('_waiting_order.php');
		es.addEventListener('message', function(e) {
console.log(e.lastEventId + ' <- ' + lastEventId);
			if(e.lastEventId != lastEventId) {
				var order = JSON.parse(e.data);
				//$('#list').append('<li>' + order.category + ' ' + order.description + e.lastEventId + '</li>');
                                addOrder(order);
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

function addOrder(order) {
                var source = $("#waiting-order-template").html();
		var template = Handlebars.compile(source);
		var html = template(order);
		$("#list").append(html);
}

function loadAllWaitingOrders() {
  $.get("_all_waiting_order.php", {}, function (data) {
		if(data) {
                    if(data.length>0) {
			  $.each(data, function(index, value) {
                            addOrder(value);
                          });
                          lastEventId=data[data.length-1].orderId;
                    }
		}
                else {
                  alert("Failed to load waiting orders. Please try again.")
                }
	}, "json");
}

function ignore(e) {
  $(this).parents('.waiting_order').remove();
}

function offer() {
  var wo=$(this).parents('.waiting_order');
  var orderId=wo.children('.hiddenOrderId').get(0).value;
console.log("Order Id: " + orderId);

$.post("_send_offer.php", { "orderId" : orderId }, function (data) {
		if(data) {
			wo.children('.btnOffer').remove();
  wo.children('.btnIgnore').remove();
  wo.append("<h5>Offer sent</h5>")
		}
                else {
                  alert("Failed to send an offer. Please try again.")
                }
	}, "json");
}

function getTotalPrice() {
  var total = parseFloat(0);

  $.each(this.items, function(index, value) {
    console.log(value.price);
    total += parseFloat(value.price);
  });
  return total;
}

function bindEvent() {
  $('body').on('click', '.btnOffer', offer);
  $('body').on('click', '.btnIgnore', ignore);
}

function registerHelpers() {
  Handlebars.registerHelper('getTotalPrice', getTotalPrice);
}

window.addEventListener('load', checkEventSource);
window.addEventListener('load', bindEvent);
window.addEventListener('load', registerHelpers);
window.addEventListener('load', loadAllWaitingOrders);

</script>
<body>
  <div id="message"></div>
  <ul id="list"></ul>
</body>
</body>
</html>

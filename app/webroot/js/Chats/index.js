$(document).ready(function(){
    subscribe(['room', 'room_' + user_id]);
    var message = {"type": "broadcast", "from" : user_id};
    publish(message, "room");
    whoIsInTheRoom('room');
    
    $("#chat_box .panel-body").css("height", ($(window).height()) - 150);
    
    $(document).on("click", "a.online", function(e){
//	$("#chat_box .chat").html("");
        var $this = $(this);
        var sid = $this.data("sid");
        var name = $this.data("name");
	
	$("#online_container a").each(function(e){
	    $(this).removeClass("active");
	});
	
	$this.addClass("active");
	    
        var chatbox = $("#chat_box");
        var callbutton = $("#call_button");
	    
        chatbox.find(".panel-heading span").text(name);
	
	var channel_name = "room_" + user_id + "-" + "room_" + sid;

	chatbox.data("channel", channel_name);
	chatbox.data("mychannel", "room_" + sid);
	chatbox.data("sid", sid);
	chatbox.data("name", name);
        
	callbutton.data("sid", sid);
    });
	
    $("#call_button").on("click", function(event){
        var $this = $(this);
	$this.hide();
	
	var chatbox = $("#chat_box");
        var state = $this.data("state");
        var sid = $this.data("sid");
	
	$('#outgoing').modal({
	    show: true
	});
	
	$('#outgoing').find(".name").text(chatbox.data('name'));
	
	if(dial(event,sid)){
	    
	}
    });
    
    $("#outgoing .reject").on("click", function(e){
	$("#call_button").show();
	$('#outgoing').modal('hide');
	end_call();
    });
    
    $("#incoming .reject").on("click", function(e){
	$("#call_button").show();
	$('#incoming').modal('hide');
	
	var channel = "room_"+$("#chat_box").data("sid");
	var message = {"type" : "callResponse", "from" : user_id, "status" : 'rejected'};
	publish(message, channel);
	
    });


    callback = function(){
	var $this = $(this);
	var messagebox = $("#message");

	if ($this.data('state') == 0){
	    $this.removeClass("btn-success")
	    .addClass("btn-danger")
	    .addClass("pulse1")
	    .data("state", 1);
	} else {
	    $this.removeClass("btn-danger")
	    .removeClass("pulse1")
	    .addClass("btn-success")
	    .data("state", 0);

	}
	startButton(true);
    }
    
    $("#chat_button").on({
        click : callback
    });
    
     $(".action_bar #message").keypress(function(event){
	 
	if (event.which === 13) $("#send_button").trigger("click");
    });
    
    $("#incoming .accept").on("click", function(e){
	var $this = $("#chat_box");
	var channel = $this.data('channel');
	var from_sid = $this.data('from_sid');
	
	userChannel.push(channel);
	subscribe(userChannel);
	var message = {"type": "callResponse", "channel_name": channel, "from" : user_id, "status":"accepted"};
        publish(message, channel);
	startButton();
    });
    
    $("#logout").on("click", function(e){
	e.preventDefault();
	var message = {"type": "broadcast", "from" : user_id};
	publish(message, "room");
	unsubscribe(userChannel);
	window.location = base_url+"/users/logout";
    });
    
});
    
//Dial Function and handles will be added here
function dial(event,to){
    var requestee = to;
    var channel_name = "room_" + user_id + "-" + "room_" + requestee;
    
    $("#chat_box").data("channel", channel_name);
    $("#chat_box").data("sid", user_id);
    
    var message = {"type": "callRequest", "channel_name": channel_name, "from" : user_id};
    
    userChannel.push("room_" + user_id + "-" + "room_" + requestee);
    subscribe(userChannel);
    publish(message, 'room_' + requestee);
    
    //startButton(event);
    return true;
}
    
function end_call(){
    //End Function ends the calls between two parties
    var channel = $("#chat_box").data('channel');
    var message = {"type": "unsubscribe", "channel_name": channel, "from" : user_id};
    publish(message, channel);
    unsubscribe(channel);
    startButton();
    return true;
}
    
function send(to, message){
    //Messages will be sent from here
    return true;
}
$(document).ready(function(){
    subscribe(['room', 'room_' + user_id]);
    var message = {"type": "broadcast", "from" : user_id};
    publish(message, "room");
    whoIsInTheRoom('room');
    
    $("#chat_box .panel-body").css("height", ($(window).height()) - 150);
    
    $(document).on("click", "a.online", function(e){
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
        chatbox.data("sid", sid);
        callbutton.data("sid", sid);
    });
	
    $("#call_button").on("click", function(event){
        var $this = $(this);
	$this.hide();
	
        var state = $this.data("state");
        var sid = $this.data("sid");
	
	$('#outgoing').modal({
	    show: true
	});
	
	if(dial(event,sid)){
	    
	}
    });
    
    $("#outgoing .reject").on("click", function(e){
	$("#call_button").show();
	$('#outgoing').modal('hide');
	end_call();
    });
	
    $("#chat_button").on({
        mousedown : function(){
            flag = new Date().getTime();
            var $this = $(this);
            var messagebox = $("#message");
		
            $this.removeClass("btn-success")
            .addClass("btn-danger")
            .addClass("pulse1")
            .data("state", 1);
        },
        mouseup : function(){
            var $this = $(this);
            var messagebox = $("#message");
            $this
            var message = messagebox.val();
            var sid = $this.data("sid");
		
            $this.removeClass("btn-danger")
            .removeClass("pulse1")
            .addClass("btn-success")
            .data("state", 0);
		    
            flag2 = new Date().getTime();
            var passed = (flag2 - flag)/1000;
		
            if(passed > 1){
                send(sid, message);
            } else {
                console.log("Less then 1 second message is not allowed...");
            }
        }
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
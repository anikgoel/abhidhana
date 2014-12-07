$(document).ready(function(){
    $("#chat_box .panel-body").css("height", ($(window).height()) - 150);
	
    $(".online_users a").on("click", function(){
        var $this = $(this);
        var sid = $this.data("sid");
        var name = $this.data("name");
	    
        var chatbox = $("#chat_box");
	    
        chatbox.find(".panel-heading span").text(name);
        chatbox.data("sid", sid);
    });
	
    $("#call_button").on("click", function(event){
        var $this = $(this);
        var state = $this.data("state");
        var sid = $this.data("sid");
	    
        if (state == 0){
            if(dial(event,sid)){
                $this.removeClass("btn-success")
                .addClass("btn-danger")
                .data("state", 1)
                .find("span")
                .text("End Call");
            }
        } else {
	    
            if (end_call(event,sid)){
                $this.removeClass("btn-danger")
                .addClass("btn-success")
                .data("state", 0)
                .find("span")
                .text("Call");
            }
        }
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
});
    
function dial(event,to){
    //Dial Function and handles will be added here
    startButton(event);
    return true;
}
    
function end_call(event,to){
    //End Function ends the calls between two parties
    startButton(event);
    return true;
}
    
function send(to, message){
    //Messages will be sent from here
    return true;
}
$(document).ready(function(){
    
    $("#send_button").on("click", function(){
	var $this = $(this);
	var messagebox = $("#message");
	var sid = $("#chat_box").data('sid');
	
	var text = messagebox.val();
	
	var channel = $("#chat_box").data("mychannel");
	var message = {"type" : "message", "language" : select_dialect.value, "from" : user_id, "message" : text, speak:false};
	publish(message, channel);
	var hstry = store_history(sid, message);
	
	messagebox.val("");
	
	var template = $("#message_template_me").html();
	var compiled = _.template(template);

	var name = $("#chat_box").data("name");
	var compiled_template = compiled({text:text, name:user_name});

	$("#chat_box .chat").append(compiled_template);
	
    });
});
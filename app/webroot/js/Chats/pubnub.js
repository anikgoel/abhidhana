/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var userChannel;

var pubnub = PUBNUB.init({
    publish_key: 'pub-c-a34de8d5-fef2-4948-81a3-aca2edf18e03',
    subscribe_key: 'sub-c-53734cc6-7d59-11e4-812f-02ee2ddab7fe',
    uuid: user_id
});

function whoIsInTheRoom(channel) {
    pubnub.here_now({
        channel: channel,
        callback: function(m) {
            var index = m.uuids.indexOf(user_id);
            if (index > -1) {
                m.uuids.splice(index, 1);
            }
            $.getJSON('http://development.luminogurus.com/abhidhana/chats/getUserDetails', {"uuids": m.uuids}, function(data) {
                var template = $("#online_template").html();
		var compiled = _.template(template);
		var compiled_template = compiled({users:data.data});

		$('#online_container').html(compiled_template);
		$("#online_container a:first-child").trigger("click");
            });
        }
    });
}

function subscribe(channel) {
    userChannel = channel;
    pubnub.subscribe({
        channel: channel,
        message: function(message, env, channel) {
            switch(message.type){
                case 'message' :
		    messageRead(message);
                    break;
                
                case 'call' :
                    console.log('in call');
                    break;   
                
                case 'callRequest' :
                    callRequest(message);
                    break;
		    
                case 'callResponse' :
                    callResponse(message);
                    break;
		    
		case 'broadcast' :
		    broadcastPresence(message);
		    break;
		    
		case 'unsubscribe' :
		    $("#incoming").modal('hide');
		    unsubscribe(message.channel_name);
		    startButton();
		    break;
		
		default :
		    break;
            }
        }
    });
}

function messageRead(message){
    if (message.from != user_id){
	translateText(message.message, message.language);
    }
}

function callRequest(message){
    $(".online").find("a[data-sid='"+message.from+"']").trigger("click");
    $('#chat_box')
	.data("channel", message.channel_name)
	.data("from_sid", message.from);
    $('#incoming').modal({
	show: true
    });
}

function callResponse(message){
    if(message.status == "accepted"){
	startButton();
    } else {
	console.log("else");
    }
}

function broadcastPresence(message){
    var from = message.from
    if (from != user_id){
	whoIsInTheRoom('room');
    }
}


function unsubscribe(channel) {
    pubnub.unsubscribe({
        channel: channel,
    });
}

function publish(message, channel) {
    if (message != '') {
        pubnub.publish({
            channel: channel,
            message: message,
            callback: function(m) {
                console.log(m)
            }
        });
    } else {
        alert('Message cannot be blank');
    }
}

function here_now(channel) {
    pubnub.here_now({
        channel: channel,
        callback: function(m) {
            console.log(m);
        }
    });
}

function where_now(uuid) {
    pubnub.where_now({
        uuid: uuid,
        callback: function(m) {
            console.log(m)
        },
        error: function(m) {
            console.log(m)
        }
    });
}
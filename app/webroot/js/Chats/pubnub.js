/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var userChannel;
var user_id = '<?php echo $user_id; ?>';
pubnub = PUBNUB.init({
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
            $.getJSON('http://development.luminogurus.com/abhidhana/atuls/getUserDetails', {"uuids": m.uuids}, function(data) {
                console.log(data);
            });
        }
    });
}

function subscribe(channel) {
    userChannel = channel;
    console.log('here');
    pubnub.subscribe({
        channel: channel,
        message: function(message, env, channel) {
            
            switch(message.type){
                case 'message' :
                    $('#text').append(message.message + '<br>');
                    break;
                
                case 'call' :
                    console.log('in call');
                    break;   
                
                case 'callRequest' :
                    callRequest(message);
                    break;
            }
        },
        presence: function(data) {
            console.log(data);
        }
    });
}

function callRequest(message){
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
;

$(document).ready(function() {
    subscribe(['room', 'room_' + user_id]);

    $('#send').click(function() {
        var text = $('#input').val();
        var message = {"type" : "message", "language" : "en-US", "from" : user_id, "message" : text}
        publish(message, 'room');
    });

    $('#getUsers').click(function() {
        whoIsInTheRoom('room');
    });

    $('#startChat').click(function() {
        var requestee = '2';
        var message = {"type": "callRequest", "channel_name": "room_" + user_id + "-" + "room_" + requestee, "from" : user_id}
        userChannel.push("room_" + user_id + "-" + "room_" + requestee);
        publish(message, 'room_' + requestee);
    });
});
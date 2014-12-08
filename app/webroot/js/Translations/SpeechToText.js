for (var i = 0; i < langs.length; i++) {
    select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 1;
updateCountry();
select_dialect.selectedIndex = 6;
//showInfo('info_start');

function updateCountry() {
    for (var i = select_dialect.options.length - 1; i >= 0; i--) {
        select_dialect.remove(i);
    }
    var list = langs[select_language.selectedIndex];
    for (var i = 1; i < list.length; i++) {
        select_dialect.options.add(new Option(list[i][1], list[i][0]));
    }
    select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
}
var create_email = false;
var final_transcript = '';
var recognizing = false;
var ignore_onend;
var start_timestamp;
var recognition;
var last_hit;
var temp_transcript;
var transcript_sent = false;
var sent_text = '';
var print_text = false;
$(document).ready(function(){
    if (!('webkitSpeechRecognition' in window)) {
        upgrade();
    } else {
        console.log('here');
        //        start_button.style.display = 'inline-block';
        recognition = new webkitSpeechRecognition();
        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function() {
            recognizing = true;
        //            showInfo('info_speak_now');
        //            start_img.src = 'https://www.google.com/intl/en/chrome/assets/common/images/content/mic-animate.gif';
        };

        recognition.onerror = function(event) {
            if (event.error == 'no-speech') {
                //                start_img.src = 'https://www.google.com/intl/en/chrome/assets/common/images/content/mic.gif';
                //                showInfo('info_no_speech');
                ignore_onend = true;
            }
            if (event.error == 'audio-capture') {
                //                start_img.src = 'https://www.google.com/intl/en/chrome/assets/common/images/content/mic.gif';
                //                showInfo('info_no_microphone');
                ignore_onend = true;
            }
            if (event.error == 'not-allowed') {
                if (event.timeStamp - start_timestamp < 100) {
                //                    showInfo('info_blocked');
                } else {
                //                    showInfo('info_denied');
                }
                ignore_onend = true;
            }
        };

        recognition.onend = function() {
            recognizing = false;
            if (ignore_onend) {
                return;
            }
            //            start_img.src = 'https://www.google.com/intl/en/chrome/assets/common/images/content/mic.gif';
            if (!final_transcript) {
                //                showInfo('info_start');
                return;
            }
            //            showInfo('');
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
                var range = document.createRange();
                range.selectNode(document.getElementById('final_span'));
                window.getSelection().addRange(range);
            }
            if (create_email) {
                create_email = false;
                createEmail();
            }
        };

        recognition.onresult = function(event) {
            var d = new Date();
            last_hit = d.getTime();
            var interim_transcript = '';
            if (typeof(event.results) == 'undefined') {
                recognition.onend = null;
                recognition.stop();
                upgrade();
                return;
            }
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    final_transcript += event.results[i][0].transcript;
                } else {
                    interim_transcript += event.results[i][0].transcript;
                }
            }
            console.log(interim_transcript);
            final_transcript = capitalize(final_transcript);
            if(print_text){
                if(interim_transcript){
                    message.value = interim_transcript;
                }else if(final_transcript){
                    message.value = final_transcript;
                }
            }
            
            if(final_transcript && !transcript_sent){
                final_transcript = final_transcript.replace(sent_text, "");
                sent_text = "";
                if(final_transcript != ''){
                    sendToSocket(final_transcript,select_dialect.value)
                    //                    translateText(final_transcript,select_dialect.value)
                    transcript_sent = true;
                    last_hit = undefined;
                }
            }
            if (final_transcript || interim_transcript) {
                if(interim_transcript != ''){
                    temp_transcript = interim_transcript;
                }
                transcript_sent = false;
                showButtons('inline-block');
            }
            if(final_transcript){
                final_transcript = '';
                transcript_sent = false;
            }
        };
    }
    setInterval(function() {
        if (typeof(last_hit) != 'undefined' && typeof(temp_transcript) != 'undefined' && !transcript_sent) {
            var d = new Date();
            var now_time = d.getTime();
            if(now_time - last_hit > 1000){
                temp_transcript = temp_transcript.replace(sent_text, "");
                sendToSocket(temp_transcript,select_dialect.value)
                //                translateText(temp_transcript,select_dialect.value)
                transcript_sent = true;
                last_hit = undefined;
                sent_text = temp_transcript;
                temp_transcript = undefined;
            }
        }
    }, 1000)

});
function upgrade() {
    start_button.style.visibility = 'hidden';
//    showInfo('info_upgrade');
}

function sendToSocket(text,language,speak){
    if(typeof(speak)=='undefined'){
        speak = true;
    }
    var channel = $("#chat_box").data("channel");
    var message = {
        "type" : "message", 
        "language" : language, 
        "from" : user_id, 
        "message" : text, 
        "speak" : speak
    };
    publish(message, channel);
}

var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
    return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}

var first_char = /\S/;
function capitalize(s) {
    return s.replace(first_char, function(m) {
        return m.toUpperCase();
    });
}

function createEmail() {
    var n = final_transcript.indexOf('\n');
    if (n < 0 || n >= 80) {
        n = 40 + final_transcript.substring(40).indexOf(' ');
    }
    var subject = encodeURI(final_transcript.substring(0, n));
    var body = encodeURI(final_transcript.substring(n + 1));
    window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
}

function copyButton() {
    if (recognizing) {
        recognizing = false;
        recognition.stop();
    }
    copy_button.style.display = 'none';
    copy_info.style.display = 'inline-block';
//    showInfo('');
}

function emailButton() {
    if (recognizing) {
        create_email = true;
        recognizing = false;
        recognition.stop();
    } else {
        createEmail();
    }
    email_button.style.display = 'none';
    email_info.style.display = 'inline-block';
//    showInfo('');
}

function startButton(tap_to_text) {
    if (recognizing) {
        recognition.abort();
        return;
    }
    if(typeof(tap_to_text) == 'undefined'){
        tap_to_text = false
    }
    print_text = tap_to_text;
    
    final_transcript = '';
    recognition.lang = select_dialect.value;
    recognizing = true;
    recognition.start();
    ignore_onend = false;
    //    final_span.innerHTML = '';
    //    interim_span.innerHTML = '';
    //    start_img.src = 'https://www.google.com/intl/en/chrome/assets/common/images/content/mic-slash.gif';
    //    showInfo('info_allow');
    showButtons('none');
//    start_timestamp = event.timeStamp;
}

function showInfo(s) {
    if (s) {
        for (var child = info.firstChild; child; child = child.nextSibling) {
            if (child.style) {
                child.style.display = child.id == s ? 'inline' : 'none';
            }
        }
        info.style.visibility = 'visible';
    } else {
        info.style.visibility = 'hidden';
    }
}

var current_style;
function showButtons(style) {
    if (style == current_style) {
        return;
    }
    current_style = style;
//    copy_button.style.display = style;
//    email_button.style.display = style;
//    copy_info.style.display = 'none';
//    email_info.style.display = 'none';
}
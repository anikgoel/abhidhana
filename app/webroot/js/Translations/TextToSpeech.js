function translateText(text,language){
    $.ajax({
        url:'http://development.luminogurus.com/abhidhana/Translations/translateData',
        dataType:'json',
        type:'POST',
        data:{
            'text':text,
            'language_from':language,
            'language_to':select_dialect.value
        },
        success:function(resp){
            var msg = new SpeechSynthesisUtterance();
            msg.text = resp.data;
            msg.lang = resp.lang;
            speechSynthesis.speak(msg);
        }
    });
}

function receiveFromSocket(){
    translateText(text,language);
}
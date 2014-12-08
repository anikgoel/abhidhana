function translateText(text,language,speak){
    var return_value = false;
    $.ajax({
        url:base_url+'/Translations/translateData',
        dataType:'json',
        type:'POST',
        data:{
            'text':text,
            'language_from':language,
            'language_to':select_dialect.value
        },
        async : false,
        success:function(resp){
            if(speak){
                var msg = new SpeechSynthesisUtterance();
                msg.text = resp.data;
                msg.lang = select_dialect.value;
                speechSynthesis.speak(msg);
            }else{
                return_value = resp.data;
            }
        }
    });
    return return_value;
}

function receiveFromSocket(){
    translateText(text,language);
}
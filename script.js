var recognition = new webkitSpeechRecognition();
recognition.continuous = true;
recognition.interimResults = true;
var list = [];
//recognition.lang = "hi-IN";
recognition.lang = "en-US";
var listening = false;

recognition.onresult = function (event) {
    var interim_transcript = '';
    var final_transcript = '';

    for (var i = event.resultIndex; i < event.results.length; ++i) {
        if (event.results[i].isFinal) {
            final_transcript += event.results[i][0].transcript;
            document.getElementById('transcript').value = final_transcript;
            // toggle();
        } else {
            interim_transcript += event.results[i][0].transcript;
            document.getElementById('transcript').value = interim_transcript;
        }

    }
    if (final_transcript != "") {
        list.push(final_transcript);
        console.log(list);
        document.cookie = `text = ${list}`;
    }


};

let startSpeeking = document.querySelector('.startS');
let stopSpeeking = document.querySelector('.stopS');
startSpeeking.addEventListener('click', () => {
    recognition.start();
    startSpeeking.disabled = true;
    listening = true;
});
stopSpeeking.addEventListener('click', () => {
    recognition.stop();
    listening = false;
    // location.reload();
    // document.querySelector('.msg').style.display = "block";
});
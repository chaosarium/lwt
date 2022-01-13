<?php

$ttsjs_lang = getSettingWithDefault("set-ttsjs-lang");
$ttsjs_rate = getSettingWithDefault("set-ttsjs-rate");

?>

<script>
    

    function readTextAloud(text) {
        var msg = new SpeechSynthesisUtterance()
        msg.text = text
        msg.lang = "<?php echo $ttsjs_lang;?>"
        msg.rate = "<?php echo $ttsjs_rate;?>"
        window.speechSynthesis.speak(msg)
    }

    function applyTTS() {
        document.querySelectorAll('.textToSpeak, #textToSpeak, span.click.word.wsty').forEach(item => {
            console.log("added listener")
            item.addEventListener('click', event => {
                console.log("this is great")
                readTextAloud(item.textContent)
            })
        })
    }

</script>
<?php
/**
 * \file
 * \brief Text-to-speech utility function.
 * 
 * This uses web browser text-to-speech utility function
 * to read a text aloud.
 * 
 * @package Lwt
 * @author  chaosarium
 * @license Unlicense <http://unlicense.org/>
 * @link    https://hugofara.github.io/lwt/docs/html/tts_8php.html
 * @since   1.6.0 First version using Google Text-to-speech utility
 * @since   2.2.0 Completely reviewed for in-browser text-to-speech
 * 
 */

/**
 * Retrieve settings from settings database
 * ttsjs_lang is the string representing a BCP 47 language tag
 * ttsjs_rate a float value for speech rate
*/
$ttsjs_lang = getSettingWithDefault("set-ttsjs-lang");
$ttsjs_rate = getSettingWithDefault("set-ttsjs-rate");

?>

<script>

    /** 
     * Read a text. 
     * 
     * Language and speed rate are extracted from settings.
     * 
     * @param {string} text Text to be read;
     *   
     */
    function readTextAloud(text) {
        var msg = new SpeechSynthesisUtterance()
        msg.text = text
        msg.lang = <?php echo json_encode($ttsjs_lang);?>;
        msg.rate = <?php echo json_encode($ttsjs_rate);?>;
        window.speechSynthesis.speak(msg)
    }

    /** 
     * Apply Tex-to-speech event listener to all marked elements. 
     */
    function applyTTS() {
        document.querySelectorAll('.textToSpeak, #textToSpeak, span.click.word.wsty')
        .forEach(item => {
            console.log("added listener")
            item.addEventListener(
                'click', 
                event => {
                    console.log("this is great")
                    readTextAloud(item.textContent)
            })
        })
    }

</script>
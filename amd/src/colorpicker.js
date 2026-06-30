/**
 * Color picker initialization for mod_videomoldura.
 *
 * @module     mod_videomoldura/colorpicker
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define(['core/str'], function(Str) {
    return {
        /**
         * Initialize the color picker listener on the specified input text.
         *
         * @param {string} inputId The ID of the input field.
         */
        init: function(inputId) {
            var textInput = document.getElementById(inputId);
            if (textInput) {
                // Check if colorpicker input was already added to prevent duplicates
                if (document.getElementById(inputId + '_picker')) {
                    return;
                }
                var colorPicker = document.createElement("input");
                colorPicker.type = "color";
                colorPicker.id = inputId + '_picker';
                colorPicker.value = textInput.value || "#496637";
                colorPicker.style.marginLeft = "10px";
                colorPicker.style.verticalAlign = "middle";
                colorPicker.style.cursor = "pointer";
                colorPicker.style.height = "35px";
                colorPicker.style.width = "40px";
                colorPicker.style.padding = "0";
                colorPicker.style.border = "1px solid #ccc";
                colorPicker.style.borderRadius = "4px";

                textInput.parentNode.insertBefore(colorPicker, textInput.nextSibling);

                colorPicker.addEventListener("input", function() {
                    textInput.value = colorPicker.value;
                });

                textInput.addEventListener("input", function() {
                    if (/^#[0-9A-Fa-f]{6}$/i.test(textInput.value)) {
                        colorPicker.value = textInput.value;
                    }
                });
            }
        }
    };
});

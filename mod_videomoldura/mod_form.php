<?php
/**
 * The main module configuration form.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_videomoldura_mod_form extends moodleform_mod {

    /**
     * Define the form elements.
     */
    public function definition() {
        $mform = $this->_form;

        // Campos padrao (Nome da atividade).
        $mform->addElement('text', 'name', get_string('pluginname', 'mod_videomoldura'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Campo de Subtitulo / Descricao.
        $mform->addElement('text', 'subtitle', 'Descrição / Nome do Professor', ['size' => '64']);
        $mform->setType('subtitle', PARAM_TEXT);

        // Campo da Cor e script de injeção.
        $mform->addElement('text', 'bordercolor', 'Cor da Borda e Título', ['size' => '10', 'maxlength' => '7', 'id' => 'id_bordercolor']);
        $mform->setType('bordercolor', PARAM_TEXT);
        $mform->setDefault('bordercolor', '#496637');
        $mform->addHelpButton('bordercolor', 'bordercolor', 'videomoldura');

        $script = '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var textInput = document.getElementById("id_bordercolor");
            if (textInput) {
                var colorPicker = document.createElement("input");
                colorPicker.type = "color";
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
        });
        </script>';
        $mform->addElement('html', $script);

        // Campo personalizado para a URL do Video.
        $mform->addElement('text', 'videourl', get_string('videourl', 'mod_videomoldura'), ['size' => '64']);
        $mform->setType('videourl', PARAM_RAW);
        $mform->addRule('videourl', null, 'required', null, 'client');

        // Controles padrao do Moodle.
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }
}
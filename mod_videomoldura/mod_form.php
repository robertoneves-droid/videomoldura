<?php
defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_videomoldura_mod_form extends moodleform_mod {
    function definition() {
        $mform = $this->_form;

        // Campos padrão (Nome da atividade)
        $mform->addElement('text', 'name', get_string('pluginname', 'mod_videomoldura'), array('size'=>'64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // NOVO: Campo de Subtítulo / Descrição
        $mform->addElement('text', 'subtitle', 'Descrição / Nome do Professor', array('size'=>'64'));
        $mform->setType('subtitle', PARAM_TEXT);

        // 1. Criamos o campo de texto padrão (para digitar ou colar o HEX)
        $mform->addElement('text', 'bordercolor', 'Cor da Borda e Título', array('size'=>'10', 'maxlength'=>'7', 'id'=>'id_bordercolor'));
        $mform->setType('bordercolor', PARAM_TEXT);
        $mform->setDefault('bordercolor', '#496637');
        $mform->addHelpButton('bordercolor', 'bordercolor', 'videomoldura');

        // 2. O TRUQUE: Injeta um seletor de cor visual ao lado e sincroniza os dois
        $mform->addElement('html', '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var textInput = document.getElementById("id_bordercolor");

                if (textInput) {
                    // Cria a caixinha de cor interativa
                    var colorPicker = document.createElement("input");
                    colorPicker.type = "color";
                    colorPicker.value = textInput.value || "#496637";

                    // Aplica um estilo básico para ficar bonito ao lado do texto
                    colorPicker.style.marginLeft = "10px";
                    colorPicker.style.verticalAlign = "middle";
                    colorPicker.style.cursor = "pointer";
                    colorPicker.style.height = "35px";
                    colorPicker.style.width = "40px";
                    colorPicker.style.padding = "0";
                    colorPicker.style.border = "1px solid #ccc";
                    colorPicker.style.borderRadius = "4px";

                    // Insere a caixinha de cor logo após a caixa de texto
                    textInput.parentNode.insertBefore(colorPicker, textInput.nextSibling);

                    // Regra 1: Se escolher a cor na paleta, atualiza o texto
                    colorPicker.addEventListener("input", function() {
                        textInput.value = colorPicker.value;
                    });

                    // Regra 2: Se digitar o código HEX no texto, atualiza a paleta
                    textInput.addEventListener("input", function() {
                        // Só atualiza se for um código HEX válido (ex: #ffffff)
                        if (/^#[0-9A-Fa-f]{6}$/i.test(textInput.value)) {
                            colorPicker.value = textInput.value;
                        }
                    });
                }
            });
        </script>');

        // Campo personalizado para a URL do Vídeo (YouTube, Vimeo, etc.)
        $mform->addElement('text', 'videourl', get_string('videourl', 'mod_videomoldura'), array('size'=>'64'));
        $mform->setType('videourl', PARAM_RAW);
        $mform->addRule('videourl', null, 'required', null, 'client');

        // Controles padrão do Moodle
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }
}
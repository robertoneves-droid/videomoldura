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

        // Campo personalizado para a URL do Vídeo (YouTube, Vimeo, etc.)
        $mform->addElement('text', 'videourl', get_string('videourl', 'mod_videomoldura'), array('size'=>'64'));
        $mform->setType('videourl', PARAM_RAW);
        $mform->addRule('videourl', null, 'required', null, 'client');

        // Controles padrão do Moodle
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }
}

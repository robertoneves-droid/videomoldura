<?php
require_once(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');

$id = required_param('id', PARAM_INT); // ID do módulo do curso
$cm = get_coursemodule_from_id('videomoldura', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$videomoldura = $DB->get_record('videomoldura', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);

// Configuração de cabeçalho da página
$PAGE->set_url('/mod/videomoldura/view.php', array('id' => $cm->id));
$PAGE->set_title($videomoldura->name);
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading($videomoldura->name);

// Código HTML atualizado com classes utilitárias do Bootstrap 5 do Moodle 5.0
echo '
<div class="moldura-dispositivo my-4 d-flex justify-content-center align-items-center">
    <!-- Detalhe da Câmera frontal -->
    <div class="moldura-camera"></div>
    
    <iframe src="'.s($embed_url).'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>';

echo $OUTPUT->footer();
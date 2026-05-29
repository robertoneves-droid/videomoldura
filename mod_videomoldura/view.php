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

// CORREÇÃO: Buscando a URL do banco e convertendo para Embed
$embed_url = $videomoldura->videourl;
if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $embed_url, $id)) {
    $embed_url = 'https://www.youtube.com/embed/' . $id[1];
} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $embed_url, $id)) {
    $embed_url = 'https://www.youtube.com/embed/' . $id[1];
}

// Código HTML atualizado
echo '
<div class="moldura-dispositivo my-4 d-flex justify-content-center align-items-center">
    <div class="moldura-camera"></div>
    
    <iframe width="800" height="450" src="'.s($embed_url).'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>';

echo $OUTPUT->footer();
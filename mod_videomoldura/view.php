<?php
/**
 * View page for the module.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');

$id = required_param('id', PARAM_INT); // ID do modulo do curso.

$cm = get_coursemodule_from_id('videomoldura', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$videomoldura = $DB->get_record('videomoldura', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);

// Configuracao de cabecalho da pagina.
$PAGE->set_url('/mod/videomoldura/view.php', ['id' => $cm->id]);
$PAGE->set_title($videomoldura->name);
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading($videomoldura->name);

// Buscando a URL do banco e convertendo para Embed.
$embedurl = $videomoldura->videourl;
if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $embedurl, $vid)) {
    $embedurl = 'https://www.youtube.com/embed/' . $vid[1];
} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $embedurl, $vid)) {
    $embedurl = 'https://www.youtube.com/embed/' . $vid[1];
}

// Codigo HTML atualizado.
$html = '<div class="moldura-dispositivo my-4 d-flex justify-content-center align-items-center">';
$html .= '<div class="moldura-camera"></div>';
$html .= '<iframe width="800" height="450" src="' . s($embedurl) . '" frameborder="0" ';
$html .= 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" ';
$html .= 'allowfullscreen></iframe></div>';

echo $html;

echo $OUTPUT->footer();
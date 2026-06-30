<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

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

// Capability checking.
$context = context_module::instance($cm->id);
require_capability('mod/videomoldura:view', $context);

// Trigger module viewed event.
$event = \mod_videomoldura\event\course_module_viewed::create(array(
    'objectid' => $videomoldura->id,
    'context' => $context
));
$event->add_record_snapshot('course_modules', $cm);
$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('videomoldura', $videomoldura);
$event->trigger();

// Configuracao de cabecalho da pagina.
$PAGE->set_url('/mod/videomoldura/view.php', ['id' => $cm->id]);
$PAGE->set_title($videomoldura->name);
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();

// Buscando a URL do banco e convertendo para Embed.
$embedurl = $videomoldura->videourl;
if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $embedurl, $vid)) {
    $embedurl = 'https://www.youtube.com/embed/' . $vid[1];
} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $embedurl, $vid)) {
    $embedurl = 'https://www.youtube.com/embed/' . $vid[1];
}

// Renderizar o template Mustache.
$template_data = [
    'name' => $videomoldura->name,
    'subtitle' => !empty($videomoldura->subtitle) ? $videomoldura->subtitle : '',
    'bordercolor' => !empty($videomoldura->bordercolor) ? $videomoldura->bordercolor : '#496637',
    'embedurl' => $embedurl
];
echo $OUTPUT->render_from_template('mod_videomoldura/videomoldura_view', $template_data);

echo $OUTPUT->footer();

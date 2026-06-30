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
 * Library of functions and constants for module videomoldura.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Executado quando uma nova instancia do plugin eh criada no curso.
 *
 * @param stdClass $videomoldura Objeto do formulario.
 * @param mod_videomoldura_mod_form $mform Formulario.
 * @return int ID da nova instancia.
 */
function videomoldura_add_instance(stdClass $videomoldura, $mform = null) {
    global $DB;
    $videomoldura->timemodified = time();
    $videomoldura->id = $DB->insert_record('videomoldura', $videomoldura);
    return $videomoldura->id;
}

/**
 * Executado quando o professor edita as configuracoes de uma instancia.
 *
 * @param stdClass $videomoldura Objeto atualizado.
 * @param mod_videomoldura_mod_form $mform Formulario.
 * @return bool True se atualizado.
 */
function videomoldura_update_instance(stdClass $videomoldura, $mform = null) {
    global $DB;
    $videomoldura->timemodified = time();
    $videomoldura->id = $videomoldura->instance;
    return $DB->update_record('videomoldura', $videomoldura);
}

/**
 * Executado quando exclui a atividade do curso.
 *
 * @param int $id ID da instancia.
 * @return bool True se deletado.
 */
function videomoldura_delete_instance($id) {
    global $DB;
    if (!$videomoldura = $DB->get_record('videomoldura', ['id' => $id])) {
        return false;
    }
    $DB->delete_records('videomoldura', ['id' => $videomoldura->id]);
    return true;
}

/**
 * Retorna os recursos suportados por este modulo.
 *
 * @param string $feature O recurso solicitado.
 * @return mixed Resposta de compatibilidade do recurso.
 */
function videomoldura_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO:
            return false;
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        case FEATURE_NO_VIEW_LINK:
            return true; // Esconde o link e transforma em rotulo.
        default:
            return null;
    }
}

/**
 * Injeta o HTML diretamente na pagina do curso.
 *
 * @param cm_info $coursemodule Informacoes do modulo.
 * @return cached_cm_info|null
 */
function videomoldura_get_coursemodule_info($coursemodule) {
    global $DB, $PAGE;

    // Busca os dados no banco.
    if (!$videomoldura = $DB->get_record('videomoldura', ['id' => $coursemodule->instance], '*')) {
        return null;
    }

    $info = new cached_cm_info();
    $info->name = $videomoldura->name;

    // Tratamento automatico para URLs do YouTube.
    $embedurl = $videomoldura->videourl;
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $embedurl, $id)) {
        $embedurl = 'https://www.youtube.com/embed/' . $id[1];
    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $embedurl, $id)) {
        $embedurl = 'https://www.youtube.com/embed/' . $id[1];
    }

    // Variaveis de estilo.
    $cortema = !empty($videomoldura->bordercolor) ? $videomoldura->bordercolor : '#496637';
    $subtitulo = !empty($videomoldura->subtitle) ? $videomoldura->subtitle : '';

    // Renderizar o template Mustache para exibir diretamente na pagina do curso.
    $template_data = [
        'name' => $videomoldura->name,
        'subtitle' => $subtitulo,
        'bordercolor' => $cortema,
        'embedurl' => $embedurl
    ];

    $renderer = $PAGE->get_renderer('core');
    $info->content = $renderer->render_from_template('mod_videomoldura/videomoldura_view', $template_data);

    return $info;
}

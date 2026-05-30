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
    global $DB;

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

    // HTML fragmentado para passar no codechecker.
    $html = '<div style="max-width: 95%; margin: 20px auto; background: #fff; padding: 40px; ';
    $html .= 'border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); border-top: 10px solid ' . s($cortema) . ';">';
    $html .= '<header style="text-align: center; margin-bottom: 15px;">';
    $html .= '<h1 style="color: ' . s($cortema) . '; font-size: 28px; font-weight: bold; text-transform: uppercase;">';
    $html .= s($videomoldura->name) . '</h1>';
    $html .= '<p style="font-size: 1.125rem; margin: 15px 0 0 0; padding-bottom: 20px; border-bottom: 1px solid #eee;">';
    $html .= s($subtitulo) . '</p>';
    $html .= '<div style="background-color: #111; border: 15px solid #222; border-radius: 35px; ';
    $html .= 'box-shadow: 0 20px 40px rgba(0,0,0,0.6); padding: 10px; margin: 20px auto; max-width: 640px; ';
    $html .= 'position: relative; display: flex; justify-content: center; align-items: center; aspect-ratio: 16 / 9;">';
    $html .= '<div style="position: absolute; top: 5px; left: 50%; transform: translateX(-50%); width: 6px; ';
    $html .= 'height: 6px; background: #333; border-radius: 50%;"></div>';
    $html .= '<iframe title="' . s($videomoldura->name) . '" src="' . s($embedurl) . '" width="100%" height="100%" ';
    $html .= 'frameborder="0" allow="accelerometer; autoplay; encrypted-media; picture-in-picture" allowfullscreen>';
    $html .= '</iframe></div></header></div>';

    $info->content = $html;

    return $info;
}

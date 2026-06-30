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
 * Upgrade code for the videomoldura module.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Execute videomoldura upgrade from the given old version.
 *
 * @param int $oldversion Versao anterior do plugin.
 * @return bool True se atualizado com sucesso.
 */
function xmldb_videomoldura_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    // Moodle exige a existencia deste arquivo para atividades.
    // Futuras atualizacoes de banco de dados serao colocadas aqui.

    return true;
}

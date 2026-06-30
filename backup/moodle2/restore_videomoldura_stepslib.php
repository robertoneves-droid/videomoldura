<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Define structure steps for videomoldura activity module restore.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_videomoldura_activity_structure_step extends restore_activity_structure_step {

    /**
     * Define structure mapping.
     *
     * @return array
     */
    protected function define_structure() {
        $paths = array();

        $paths[] = new restore_path_element('videomoldura', '/activity/videomoldura');

        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process videomoldura records.
     *
     * @param array $data XML database record.
     */
    protected function process_videomoldura($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        // Insert new database record
        $newitemid = $DB->insert_record('videomoldura', $data);

        // Apply context mapping
        $this->apply_activity_instance($newitemid);
    }
}

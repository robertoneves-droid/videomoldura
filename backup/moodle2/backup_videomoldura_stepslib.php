<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Define structure steps for videomoldura activity module.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_videomoldura_activity_structure_step extends backup_activity_structure_step {

    /**
     * Define the structure of the backup.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {
        $videomoldura = new backup_nested_element('videomoldura', array('id'), array(
            'name', 'subtitle', 'bordercolor', 'videourl', 'timemodified'
        ));

        $videomoldura->set_source_table('videomoldura', array('id' => backup::VAR_ACTIVITYID));

        return $this->prepare_activity_structure($videomoldura);
    }
}

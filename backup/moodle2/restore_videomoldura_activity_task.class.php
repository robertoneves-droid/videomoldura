<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/videomoldura/backup/moodle2/restore_videomoldura_stepslib.php');

/**
 * Restore task for videomoldura activity module.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_videomoldura_activity_task extends restore_activity_task {

    /**
     * Define settings.
     */
    protected function define_my_settings() {
        // No custom settings.
    }

    /**
     * Define steps.
     */
    protected function define_my_steps() {
        $this->add_step(new restore_videomoldura_activity_structure_step('videomoldura_structure', 'videomoldura.xml'));
    }

    /**
     * Define decode rules.
     *
     * @return array
     */
    static public function define_decode_rules() {
        $rules = array();

        $rules[] = new restore_decode_rule('VIDEOMOLDURAVIEWBYID', '/mod/videomoldura/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('VIDEOMOLDURAINDEX', '/mod/videomoldura/index.php?id=$1', 'course');

        return $rules;
    }

    /**
     * Define restore log rules.
     *
     * @return array
     */
    static public function define_restore_log_rules() {
        return array();
    }
}

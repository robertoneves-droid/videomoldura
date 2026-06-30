<?php
namespace mod_videomoldura\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The course_module_viewed event class.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'videomoldura';
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Get URL of the event.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/videomoldura/view.php', array('id' => $this->contextinstanceid));
    }
}

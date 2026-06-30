<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/videomoldura/backup/moodle2/backup_videomoldura_stepslib.php');

/**
 * Backup task for videomoldura activity module.
 *
 * @package    mod_videomoldura
 * @copyright  2026 Roberto Neves
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_videomoldura_activity_task extends backup_activity_task {

    /**
     * Define custom settings.
     */
    protected function define_my_settings() {
        // No custom settings.
    }

    /**
     * Define steps.
     */
    protected function define_my_steps() {
        $this->add_step(new backup_videomoldura_activity_structure_step('videomoldura_structure', 'videomoldura.xml'));
    }

    /**
     * Encode content links.
     *
     * @param string $content HTML content containing links.
     * @return string Encoded content.
     */
    static public function encode_content_links($content) {
        global $CFG;
        $base = preg_quote($CFG->wwwroot, '/');

        $pattern = '/' . $base . '\/mod\/videomoldura\/view\.php\?id=([0-9]+)/';
        $content = preg_replace($pattern, '$@VIDEOMOLDURAVIEWBYID*$1@$', $content);

        $pattern = '/' . $base . '\/mod\/videomoldura\/index\.php\?id=([0-9]+)/';
        $content = preg_replace($pattern, '$@VIDEOMOLDURAINDEX*$1@$', $content);

        return $content;
    }
}

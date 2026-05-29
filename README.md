# Moodle Module: Framed Video (mod_videomoldura)

A native Moodle plugin developed to optimize the visual and pedagogical experience of virtual classrooms. This module allows Teachers and Instructional Designers (IDs) to embed video lessons with a clean design, encapsulating the content in a responsive frame that simulates a digital device.

## 🌟 Features

* **Native Display (Label Behavior):** The video is injected directly into the course's main page, without requiring students to click external links or load new pages.
* **Automatic Link Conversion:** No need to hunt for embed codes. The plugin automatically converts standard YouTube URLs.
* **Customizable Header:** Allows adding the lesson title and the teacher's name or a subtitle.
* **Color Picker:** Integration with the HTML5 color palette to customize the frame's top bar to match the course's visual identity, also supporting direct HEX code input (e.g., `#496637`).

---

## ⚙️ System Requirements

This plugin was structured to maintain compatibility with the latest stable versions of Moodle, covering legacy environments up to the most modern updates.

* **Moodle Version:** 4.0 or higher (Tested and approved for Moodle 4.0.3, 4.3, 4.5, and 5.0).
* **PHP Version:** * Minimum recommended: **PHP 7.4.x** (For instances running Moodle 4.0 to 4.1).
  * Ideal / Current: **PHP 8.0 to 8.2+** (For instances running Moodle 4.3, 4.5, and 5.0).
* **Database:** Fully compatible with PostgreSQL (including version 15) and MySQL/MariaDB.

---

## 🚀 Installation

### Method 1: Via Admin Dashboard (Recommended)
1. Download or zip the plugin directory into a `videomoldura.zip` file.
2. Log in to your Moodle site as an Administrator.
3. Navigate to **Site administration > Plugins > Install plugins**.
4. Upload the `.zip` file and select the plugin type as `Activity module (mod)`.
5. Follow the on-screen steps to upgrade the Moodle database.

### Method 2: Manual Installation (Via Server/Terminal)
1. Extract the contents of this repository/folder.
2. Copy the entire `videomoldura` folder into the `/mod/` directory of your Moodle installation. The final path should be: `[moodle_directory]/mod/videomoldura/`.
3. Access Moodle via your browser as an Administrator. The system will automatically detect the new plugin and prompt for a database upgrade.
4. Click **Upgrade Moodle database now**.

> **Cache Warning:** After installing or updating any plugin file, it is strictly necessary to navigate to **Site administration > Development > Purge all caches** to ensure visual and language changes are applied.

---

## 🛠️ How to Use (For Instructional Designers)

1. In a course, turn **Edit mode** on.
2. Click **Add an activity or resource**.
3. Select the **Framed Video** (Vídeo com Moldura) tool.
4. Fill in the required fields:
   * **Name:** The main title that will appear above the video.
   * **Video URL:** Paste the direct YouTube link.
5. Fill in the optional fields (Design):
   * **Description / Teacher's Name:** Secondary text displayed just below the title.
   * **Border and Title Color:** Use the color picker or type the desired HEX code to match the course's branding.
6. Click **Save and return to course**.

---

## 📁 File Structure

* `/db/install.xml`: Database table structure (`mdl_videomoldura`) and its custom fields.
* `/lang/`: Internationalization files (`en` and `pt_br`).
* `/pix/`: Contains the plugin's official icon (`icon.svg` or `icon.png`).
* `lib.php`: Vital module functions, including HTML injection (`get_coursemodule_info`) for the label behavior.
* `mod_form.php`: Definition of the configuration form fields.
* `view.php`: Extended viewing page and fallback handling.
* `version.php`: Version control and plugin dependencies.

---

## 👥 Credits
Developed internally by the **SEAD IT / AVA Moodle Support team** to optimize instructional design workflows.
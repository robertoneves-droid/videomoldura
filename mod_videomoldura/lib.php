<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Executado quando uma nova instância do plugin é criada no curso.
 */
function videomoldura_add_instance(stdClass $videomoldura, $mform = null) {
    global $DB;
    $videomoldura->timemodified = time();
    $videomoldura->id = $DB->insert_record('videomoldura', $videomoldura);
    return $videomoldura->id;
}

/**
 * Executado quando o professor edita as configurações de uma instância existente.
 */
function videomoldura_update_instance(stdClass $videomoldura, $mform = null) {
    global $DB;
    $videomoldura->timemodified = time();
    $videomoldura->id = $videomoldura->instance;
    return $DB->update_record('videomoldura', $videomoldura);
}

/**
 * Executado quando o professor exclui a atividade do curso.
 */
function videomoldura_delete_instance($id) {
    global $DB;
    if (! $videomoldura = $DB->get_record('videomoldura', array('id' => $id))) {
        return false;
    }
    $DB->delete_records('videomoldura', array('id' => $videomoldura->id));
    return true;
}

/**
 * Retorna os recursos suportados por este módulo.
 */
function videomoldura_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO:               return false;
        case FEATURE_SHOW_DESCRIPTION:        return true;
        case FEATURE_NO_VIEW_LINK:            return true; // Esconde o link e transforma em "rótulo"
        default: return null;
    }
}

/**
 * Injeta o HTML diretamente na página do curso (Comportamento de Rótulo/Área de Mídia)
 */
function videomoldura_get_coursemodule_info($coursemodule) {
    global $DB;

    // Adicionamos subtitle e bordercolor na busca do banco
    if (!$videomoldura = $DB->get_record('videomoldura', array('id' => $coursemodule->instance), 'id, name, videourl, subtitle, bordercolor')) {
        return null;
    }

    $info = new cached_cm_info();
    $info->name = $videomoldura->name;

    // Tratamento automático para URLs do YouTube
    $embed_url = $videomoldura->videourl;
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $embed_url, $id)) {
        $embed_url = 'https://www.youtube.com/embed/' . $id[1];
    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $embed_url, $id)) {
        $embed_url = 'https://www.youtube.com/embed/' . $id[1];
    }

    // Variáveis de estilo (se não tiver cor preenchida, usa o seu verde padrão)
    $cor_tema = !empty($videomoldura->bordercolor) ? $videomoldura->bordercolor : '#496637';
    $subtitulo = !empty($videomoldura->subtitle) ? $videomoldura->subtitle : '';

    // O SEU HTML EXATO, mesclado com as variáveis do PHP
    $html = '
    <div style="max-width: 95%; margin: 20px auto; background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); border-top: 10px solid ' . s($cor_tema) . ';">
      <header style="text-align: center; margin-bottom: 15px;">
        <h1 style="color: ' . s($cor_tema) . '; font-size: 28px; font-weight: bold; margin-bottom: 10px; text-transform: uppercase;">
          ' . s($videomoldura->name) . '
        </h1>
        <p style="font-size: 1.125rem; margin: 15px 0 0 0; padding-bottom: 20px; border-bottom: 1px solid #eee;">
          ' . s($subtitulo) . '
        </p>
        
        <div style="background-color: #111; border: 15px solid #222; border-radius: 35px; box-shadow: 0 20px 40px rgba(0,0,0,0.6); padding: 10px; margin: 20px auto; width: min(100%, 640px); max-width: 640px; box-sizing: border-box; position: relative; display: flex; justify-content: center; align-items: center; aspect-ratio: 16 / 9;">
          <div style="position: absolute; top: 5px; left: 50%; transform: translateX(-50%); width: 6px; height: 6px; background: #333; border-radius: 50%;"></div>
          
          <iframe title="' . s($videomoldura->name) . '" src="' . s($embed_url) . '" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
      </header>
    </div>';

    $info->content = $html;

    return $info;
}
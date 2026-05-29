<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Executado quando uma nova instância do plugin é criada no curso.
 *
 * @param object $videomoldura Objeto enviado pelo formulário (mod_form.php)
 * @param array $mform
 * @return int ID da nova instância inserida no banco de dados
 */
function videomoldura_add_instance(stdClass $videomoldura, $mform = null) {
    global $DB;

    $videomoldura->timemodified = time();

    // Insere os dados na tabela mdl_videomoldura
    $videomoldura->id = $DB->insert_record('videomoldura', $videomoldura);

    return $videomoldura->id;
}

/**
 * Executado quando o professor edita as configurações de uma instância existente.
 *
 * @param object $videomoldura Objeto atualizado vindo do formulário
 * @param array $mform
 * @return bool True se a atualização foi bem-sucedida
 */
function videomoldura_update_instance(stdClass $videomoldura, $mform = null) {
    global $DB;

    $videomoldura->timemodified = time();
    $videomoldura->id = $videomoldura->instance;

    // Atualiza o registro correspondente no banco de dados
    return $DB->update_record('videomoldura', $videomoldura);
}

/**
 * Executado quando o professor exclui a atividade do curso.
 *
 * @param int $id ID da instância que será deletada
 * @return bool True se a exclusão foi bem-sucedida
 */
function videomoldura_delete_instance($id) {
    global $DB;

    // Verifica se o registro realmente existe antes de deletar
    if (! $videomoldura = $DB->get_record('videomoldura', array('id' => $id))) {
        return false;
    }

    // Remove o registro da tabela mdl_videomoldura
    $DB->delete_records('videomoldura', array('id' => $videomoldura->id));

    return true;
}

/**
 * Retorna os recursos suportados por este módulo.
 * Garante compatibilidade visual nativa com os novos temas do Moodle.
 *
 * @param string $feature O recurso solicitado
 * @return mixed Resposta de compatibilidade do recurso
 */
function videomoldura_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO:               return false; // Desativa descrição padrão se não for usar
        case FEATURE_SHOW_DESCRIPTION:        return true;
        default: return null;
    }
}

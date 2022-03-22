<?php
/**
 * Plugin Name: LGPD Modal
 * Plugin URI: https://www.3xceler.com.br/criacao-de-sites
 * Description: Plugin que cria um modal informando sobre os cookies que o site usa para o correto funcionamento.
 * Author: Rogério Rios Júnior
 * Version: 1.0
 * Licence: GPL2+
 */

// Define constante de versão requerida
define('REQUIRE_VERSION', '4.0.0');

// Função chamada pelo wp no momento de ativação (caminho, função_de_callback)
register_activation_hook(__FILE__, function() {
    // Importando a variável global de versão do wp
    global $wp_version, $wpdb;
    // Chamando a função que cgompara as versões
    if(version_compare($wp_version, REQUIRE_VERSION, '<'))
    {
        wp_die('É necessário a versão ' . REQUIRE_VERSION . ' ou superior');
    }

    $tableName = $wpdb->prefix . 'posts'; // Table name
    $siteurl   = get_option('siteurl'); // Busca a URL do site

    $file      = WP_PLUGIN_DIR . '/lgpd-modal/lgpd-page.txt';
    $handle    = fopen($file, 'r');
    $contents  = fread($handle, filesize($file));
    $contents  = str_replace('%URLSITE%',$siteurl, $contents);
    fclose($handle);

    $result    = $wpdb->get_results("SELECT ID FROM $wpdb->posts ORDER BY ID DESC LIMIT 0,1"); // Busca último post
    $row       = $result[0];
    $id        = $row->ID + 1; // Pega o último ID e implementa mais um que será o ID da página criada pelo plugin

    // Insere uma página na tabela posts do tipo page.
    $wpdb->query('INSERT INTO '.$tableName.' (ID, post_content, post_title, post_name, guid, post_type) VALUES ('.$id.', "'.$contents.'", "Políticas de privacidade LGPD", "politica-de-privacidade-lgpd", "'.$siteurl.'/?page_id='.$id.'", "page")');
});

// Função chamada no momento de desativação do plugin
register_deactivation_hook(__FILE__, function() 
{
    global $wpdb;
    $tableName  = $wpdb->prefix . 'posts';
    
    $file       = fopen(WP_PLUGIN_DIR . '/lgpd_inaticve_log.txt', 'a');
    $linha      = 'O plugin foi desativado com sucesso!\nData da desativação: ' . date("d/m/Y H:m:i");
    fwrite($file, $linha);
    fclose($file);

    $wpdb->query("DELETE FROM $tableName WHERE post_name = 'politica-de-privacidade-lgpd'");
});
/**
 * FUNÇÃO DE DESINSTALAÇÃO DE UM PLUGIN
 * Realiza funções no momento de desinstalação do plugin
 */
register_uninstall_hook(__FILE__, 'lgpd_uninstall_plugin');
function lgpd_uninstall_plugin()  {
    $file  = fopen(WP_PLUGIN_DIR . '/lgpd_unistall_log.txt', 'a');
    $linha = 'O plugin foi desinstalado com sucesso!\nData da desinstalação: ' . date("d/m/Y H:m:i");
    fwrite($file, $linha);
    fclose($file);
}

/* Funções auxiliares */
require_once('lgpd-functions.php');

// Função que adiciona menu e submenu no admin do WP
add_action('admin_menu', function() {
    // Adicionando submenu em configurações
    add_options_page(
        'Configurações de LGPD Modal',
        'Configurações de LGPD Modal',
        'manage_options',
        'lgpdmodal_slug_config',
        'lgpdmodal_slug_config_cb'

    );
});


add_action( 'updated_option', function() {

    $dadosModal = $_POST['LGPD_dados_registro'];
    
    $backgroundModal = hex2RGBA($dadosModal['LGPD_background_modal'], $dadosModal['LGPD_modal_transparent']);

    if(isset($_POST['submit'])) {
        
        $file_model     = WP_PLUGIN_DIR . '/lgpd-modal/css/modal-style.txt'; 
        $handle_model   = fopen($file_model, 'r');
        
        $file           = WP_PLUGIN_DIR . '/lgpd-modal/css/modal-style.css';
        $handle_file    = fopen($file, 'w');
        
        if($handle_model) {

            $contents       = fread($handle_model, filesize($file_model));
            $array_str      = ['%backgroundColorModal%', '%backgroundColorContent%', '%fontColorContent%', '%alignButtons%', '%colorTextButtons%', '%backgroundBtnDanger%', '%backgroundBtnSuccess%'];
            
            $array_replace  = [$backgroundModal, $dadosModal['LGPD_background_container'], $dadosModal['LGPD_font_color'], $dadosModal['LGPD_align_buttons'], $dadosModal['LGPD_color_buttons'], $dadosModal['LGPD_background_buttons_rejeitar'], $dadosModal['LGPD_background_buttons_aceitar']];
            $contents       = str_replace($array_str, $array_replace, $contents);
        
            fwrite($handle_file, $contents);
            
            fclose($handle_model);
            fclose($handle_file);

        }
    }
});

function lgpdmodal_slug_config_cb()
{
    require_once('pages/config_lgpd.php');
}

// Inclui arquivo que cria os campos do formulário
require_once('lgpd-add-form.php');

// Mostra campos do formulário
require_once('lgpd-display-form.php');

// Adiciona estilo CSS ao cabeçalho da página no frontend
require_once('lgpd-add-style-front.php');

// Adiciona script JS no frontend
require_once('lgpd-add-script-front.php');
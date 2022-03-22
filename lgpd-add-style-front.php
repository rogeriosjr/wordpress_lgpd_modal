<?php

add_action('wp_head', 'lgpd_add_style');
function lgpd_add_style()
{
    $configuracoes          = get_option('LGPD_dados_registro');

    $hexBackgroundColor     = $configuracoes['LGPD_background_modal'];
    $opaBackgroundColor     = $configuracoes['LGPD_modal_transparent'];
    $rgbBackgroundColor     = hex2RGBA($hexBackgroundColor, $opaBackgroundColor);

    $backgroundColorModal   = $rgbBackgroundColor;
    $backgroundColorContent = $configuracoes['LGPD_background_container'];
    $fontSizeContent        = $configuracoes['LGPD_font_size'];
    $fontColorContent       = $configuracoes['LGPD_font_color'];
    $textAlignContent       = $configuracoes['LGPD_align_text'];
    $alignButtons           = $configuracoes['LGPD_align_buttons'];
    $colorTextButtons       = $configuracoes['LGPD_color_buttons'];
    $backgroundBtnDanger    = $configuracoes['LGPD_background_buttons_rejeitar'];
    $backgroundBtnSuccess   = $configuracoes['LGPD_background_buttons_aceitar'];
    
    $dir_plugin             = WP_PLUGIN_URL . '/lgpd-modal';

    $style = "<link rel='stylesheet' id='lgpd-modal-plugin-css'  href='".$dir_plugin."/css/modal-style.css' type='text/css' media='all' />";

    echo $style;
}
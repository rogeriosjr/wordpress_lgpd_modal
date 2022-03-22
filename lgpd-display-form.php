<?php
/**
 * Cria os campos de formulário e mostra na página de configuração do plugin
 */

function display_section_plug_cb() 
{
    echo "<h2>Dados de registro da LGPD Modal</h2>";
}
function input_description_cb()
{ 
    $configuracoes    = get_option('LGPD_dados_registro');
    $LGPD_Description = isset( $configuracoes['LGPD_Description'] ) ? $configuracoes['LGPD_Description'] : '';
    $content 		  = $LGPD_Description;
    $editor_id 		  = 'lgpdDescription';
    $settings         = [
    	'wpautop' 		=> true, // Habilitar auto parágrafo
    	'media_buttons' => false, // Mostrar media buttons
    	'textarea_name' => 'LGPD_dados_registro[LGPD_Description]', // Nome do campo
    	'textarea_rows' => get_option('default_post_edit_rows', 10), // Equivalente a rows="" no HTML
    	'tabindex' 		=> '',
    	'editor_css'  	=> '', // CSS adicional no editor
    	'editor_class'  => '', // Classe adicional no editor
    	'teeny' 		=> true, // Mostrar editor mínimo
    	'dfw'			=> false, // Trocar Fullscreen com DFW
    	'tinymce' 		=> [
    		'toolbar1' 			=> 'undo redo fontsizeselect bold italic underline strikethrough blockquote | alignleft aligncenter alignright alignjustif | outdent indent | bullist numlist | link unlink | image',
    		'toolbar2' 			=> 'forecolor backcolor',
    		'fontsize_formats'  => '8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 20px 24px 36px 48px'
    	],
    	'quicktags' => [
    		'buttons' => 'strong,em,link,ul,li,img'
    	]
    ];

    //$textArea         = '<textarea name="LGPD_dados_registro[LGPD_Description]" class="large-text" cols="80" rows="5">'.esc_html($LGPD_Description).'</textarea>';
    
    //echo $textArea;

    wp_editor($content, $editor_id, $settings);

}
function input_background_modal_cb() 
{
    $configuracoes        = get_option('LGPD_dados_registro');
    $LGPD_backgroundModal = isset( $configuracoes['LGPD_background_modal'] ) ? $configuracoes['LGPD_background_modal'] : '#000000';
    $colorPicker          = '<input type="color" name="LGPD_dados_registro[LGPD_background_modal]" value="'.$LGPD_backgroundModal.'">';
    
    echo $colorPicker;
}
function input_background_modal_transparent_cb() 
{
    $configuracoes         = get_option('LGPD_dados_registro');
    $LGPD_modalTransparent = isset( $configuracoes['LGPD_modal_transparent'] ) ? $configuracoes['LGPD_modal_transparent'] : '1';
    $inputRanger           = '<input type="range" name="LGPD_dados_registro[LGPD_modal_transparent]" class="regular-text" value="'.esc_html($LGPD_modalTransparent).'" min="0" max="1" step="0.01" oninput="display.value=value" onchange="display.value=value"> <input type="text" id="display" value="'.esc_html($LGPD_modalTransparent).'" readonly style="width: 50px;">';

    echo $inputRanger;
}
function input_background_container_cb()
{
    $configuracoes            = get_option('LGPD_dados_registro');
    $LGPD_backgroundContainer = isset( $configuracoes['LGPD_background_container'] ) ? $configuracoes['LGPD_background_container'] : '#0000FF';
    $colorPicker              = '<input type="color" name="LGPD_dados_registro[LGPD_background_container]" value="'.$LGPD_backgroundContainer.'">';
    
    echo $colorPicker;
}
function input_font_color_cb()
{
    $configuracoes            = get_option('LGPD_dados_registro');
    $LGPD_fontColor = isset( $configuracoes['LGPD_font_color'] ) ? $configuracoes['LGPD_font_color'] : '#FFFFFF';
    $colorPicker              = '<input type="color" name="LGPD_dados_registro[LGPD_font_color]" value="'.$LGPD_fontColor.'">';
    
    echo $colorPicker;
}
function input_align_buttons_cb() 
{
    $configuracoes     = get_option('LGPD_dados_registro');
    $LGPD_alignButtons = isset( $configuracoes['LGPD_align_buttons'] ) ? $configuracoes['LGPD_align_buttons'] : 'left';
    
    switch($LGPD_alignButtons)
    {
        case 'left':    $left    = ' selected'; break;
        case 'right':   $right   = ' selected'; break;
        case 'center':  $center  = ' selected'; break;
    }

    $selectAlign    = '<select name="LGPD_dados_registro[LGPD_align_buttons]" class="regular-text">
                            <option value="left"'.$left.'>Esquerda</option>
                            <option value="right"'.$right.'>Direita</option>
                            <option value="center"'.$center.'>Centro</option>
                       </select>
    ';

    echo $selectAlign;
}
function input_color_buttons_cb() 
{
    $configuracoes     = get_option('LGPD_dados_registro');
    $LGPD_colorButtons = isset( $configuracoes['LGPD_color_buttons'] ) ? $configuracoes['LGPD_color_buttons'] : '#FFFFFF';
    $colorPicker       = '<input type="color" name="LGPD_dados_registro[LGPD_color_buttons]" value="'.$LGPD_colorButtons.'">';
    
    echo $colorPicker;
}
function input_background_buttons_rejeitar_cb() 
{
    $configuracoes                 = get_option('LGPD_dados_registro');
    $LGPD_backgroundButtonRejeitar = isset( $configuracoes['LGPD_background_buttons_rejeitar'] ) ? $configuracoes['LGPD_background_buttons_rejeitar'] : '#dc3545';
    $colorPicker                   = '<input type="color" name="LGPD_dados_registro[LGPD_background_buttons_rejeitar]" value="'.$LGPD_backgroundButtonRejeitar.'">';
    
    echo $colorPicker;
}
function input_background_buttons_aceitar_cb() 
{
    $configuracoes                 = get_option('LGPD_dados_registro');
    $LGPD_backgroundButtonAceitar = isset( $configuracoes['LGPD_background_buttons_aceitar'] ) ? $configuracoes['LGPD_background_buttons_aceitar'] : '#5cb85c';
    $colorPicker                   = '<input type="color" name="LGPD_dados_registro[LGPD_background_buttons_aceitar]" value="'.$LGPD_backgroundButtonAceitar.'">';
    
    echo $colorPicker;
}

// Data de expiração do cookie
function input_time_exp_cookie_cb() 
{
	$configuracoes      = get_option('LGPD_dados_registro');
	$LGPD_timeExpCookie = isset( $configuracoes['LGPD_time_exp_cookie'] ) ? $configuracoes['LGPD_time_exp_cookie'] : '1';
	$inputTime 			= '<input type="number" name="LGPD_dados_registro[LGPD_time_exp_cookie]" value="'.$LGPD_timeExpCookie.'" style="width:60px"> <span>Dia(s)</span>';

	echo $inputTime;
}
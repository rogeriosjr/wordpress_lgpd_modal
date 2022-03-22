<?php


add_action('admin_init', 'add_sections_and_fields_cb');

function add_sections_and_fields_cb() {
    add_settings_section(
        'section_principal',
        'Configurações de registro',
        'display_section_plug_cb',
        'LGPD_dados_registro'
    );

    register_setting(
        'LGPD_dados_registro',
        'LGPD_dados_registro'
    );

    // Conteúdo 
    add_settings_field(
        'LGPD_description',
        'Descrição',
        'input_description_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor da modal
    add_settings_field(
        'LGPD_modal_background',
        'Cor da modal',
        'input_background_modal_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Transparência da modal
    add_settings_field(
        'LGPD_modal_transparent',
        'Transparência da modal',
        'input_background_modal_transparent_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor de fundo do container
    add_settings_field(
        'LGPD_container_background',
        'Cor de fundo do conteúdo',
        'input_background_container_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor do texto
    add_settings_field(
        'LGPD_font_color',
        'Cor do texto',
        'input_font_color_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Alinhamento dos botões
    add_settings_field(
        'LGPD_align_buttons',
        'Alinhamento dos botões',
        'input_align_buttons_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor do texto dos botões
    add_settings_field(
        'LGPD_color_buttons',
        'Cor do texto dos botões',
        'input_color_buttons_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor de fundo do botão rejeitar
    add_settings_field(
        'LGPD_background_button_rejeitar',
        'Cor do botão rejeitar',
        'input_background_buttons_rejeitar_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor de fundo do botão aceitar
    add_settings_field(
        'LGPD_background_button_aceitar',
        'Cor do botão aceitar',
        'input_background_buttons_aceitar_cb',
        'LGPD_dados_registro',
        'section_principal'
    );

    // Cor de fundo do botão aceitar
    add_settings_field(
        'LGPD_time_exp_cookie',
        'Tempo de Expiração do cookie',
        'input_time_exp_cookie_cb',
        'LGPD_dados_registro',
        'section_principal'
    );
}
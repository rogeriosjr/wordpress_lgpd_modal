<?php

add_action('wp_footer', 'lgpd_add_html_script');
function lgpd_add_html_script()
{
    global $wpdb;
    
    $configuracoes      = get_option('LGPD_dados_registro');
    $LGPD_Description   = isset( $configuracoes['LGPD_Description'] ) ? $configuracoes['LGPD_Description'] : 'Ao clicar em "Aceitar todos os cookies", concorda com o armazenamento de cookies no seu dispositivo para melhorar a navegação no site, analisar a utilização do site e ajudar nas nossas iniciativas de marketing.';
    $LGPD_timeExpCookie = $configuracoes['LGPD_time_exp_cookie'];

    $result    = $wpdb->get_results("SELECT guid FROM $wpdb->posts WHERE post_name = 'politica-de-privacidade-lgpd'"); // Busca último post
    $row       = $result[0];
    $guid      = $row->guid;

    $html =  <<<EOF
<!-- The Modal -->
<div id="myLGPDModal" class="modal">
    <div class="modal-content-lgpd">
        <span class="close-modal-lgpd">&times;</span>
        {$LGPD_Description} <a href="{$guid}">Políticas de privacidade</a>
        <hr>
        <div class="div-buttons">
            <button class="lgpd-btn lgpd-btn-success">Aceitar todos os cookies</button>
            <button class="lgpd-btn lgpd-btn-danger">Rejeitar todos os cookies</button>
        </div>
    </div>
</div>
EOF;

$script = <<<EOF
<script>
var modal   = document.getElementById("myLGPDModal");
var span    = document.getElementsByClassName("close-modal-lgpd")[0];
var success = document.getElementsByClassName("lgpd-btn-success")[0];
var danger  = document.getElementsByClassName("lgpd-btn-danger")[0];
var cookies = document.cookie;

if (cookies.indexOf("lgpdViewModal") == -1) {

    modal.style.display = "block";
}

success.onclick = function() {
  
    var diasparaexpirar = {$LGPD_timeExpCookie};
    var expiracao = new Date();
    expiracao.setTime(expiracao.getTime() + (diasparaexpirar * 24*60*60*1000));
    expiracao = expiracao.toUTCString();
    document.cookie = 'lgpdViewModal=SIM; expires=' + expiracao+'; path=/';

    modal.style.display = "none";
}
span.onclick = function() {
    modal.style.display = "none";
}
danger.onclick = function() {
    modal.style.display = "none";
}
</script>
EOF;


    echo $html;
    echo $script;
}
<script>
$(function(){
    <?php if (!empty($this->session->flashdata('mensagem'))){ ?>
    $('#msgAlerta').html('<?php echo $this->session->flashdata('mensagem'); ?>');
    $('#alertMessage').dialog('open');
    <?php } ?>
        
    <?php if (!$emailconfirmado){ ?>
    $('#msgAlerta').html('Seu endereço de E-Mail ainda não foi confirmado.');
    $('#alertMessage').dialog('open');
    <?php } ?>
});
</script>
    
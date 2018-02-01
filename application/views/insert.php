    <div id="body">
        <h2>Inserir</h2>
        <div id="div_success"> </div>
        <form id="main_form" method="POST" style="height: 100px;" onkeypress="return event.keyCode != 13;">
            <p>Insira o nome no campo abaixo:</p>
            <label for="ds_nome">Nome: <label><input type="text" id="ds_nome" name="ds_nome" maxlength="100" style="width: 50%;" />
            <input type="button" id="bt_enviar" value="Inserir" />                
        </form>           

        <p><a href="<?php echo base_url('/index.php/Main/lista'); ?>">Exibir lista</a></p>
    </div>	
</div>
        
<script>
$(document).ready(function(){
    $(document).on("keypress", "form", function(event) { 
        if (event.keyCode == 13)
        {
            $("#bt_enviar").click();
        }
    });
    
    $("#bt_enviar").click(function(){        
        $.ajax({
            type: "post",
            url: "<?php echo base_url('/index.php/Main/insert'); ?>",
            data: $("#main_form").serialize(),
            contentType: "application/x-www-form-urlencoded",
            success: function(result) {                
                
                $('#div_success').html(result.msg);
                if (result.status == 0)
                {
                    $('#div_success').css('background-color','#ff9999');
                }
                else
                {
                    $('#div_success').css('background-color','#ddffcc');
                }            
               
                $('#div_success').css('display','block');
                $('#ds_nome').val('');
            }
        });
    });
});
</script>
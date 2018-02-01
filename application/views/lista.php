    <div id="body">
        <h2>Listar</h2>
        <table id="lista_user">          
            <thead>
                <th>ID</th>
                <th>Nome</th>    
            </thead>
            <tbody>                    
            </tbody>
        </table>
        <p><a href="<?php echo base_url('/index.php/Main/'); ?>">Inserir</a></p>
    </div>	
</div>
        
<script>
$(document).ready(function(){

    $.ajax({
        type: "get",
        url: "<?php echo base_url('/index.php/Main/lista_ajax'); ?>",
        success: function(result) {
           $.each(result, function(index, element) {
              $("#lista_user > tbody").append("<tr><td>"+element.id+"</td><td>"+element.ds_nome+"</td></tr>");
           });
        }
    });    
});
</script>
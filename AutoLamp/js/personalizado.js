
function soma(){
$(document).ready(function () {

        var id = $("#id :selected").val();
        var $nome_prof = $("#nome_prof :selected");

        $.getJSON('procura_professor.php', {id},
            function(retorno){
                $nome_prof.val(retorno.nome_prof);
                 $("#nome_prof").html("<option value=''>"+ retorno.nome_prof+"</option>");
                 $("#nome_prof").show();
            }
        );        
    });
}
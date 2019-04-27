<?php include("logica-usuario.php");
verificaUsuario();
?>
<?php include ("cabecalho.php");
            include './Class/Disciplina.php';
            include './Class/Aula.php';
            require_once './Dao/CrudDisciplina.php';
            $daoDis = new CrudDisciplina();
            $aula = new Aula();

           ?> 
 <div class="row">
     <form class="col s12" action="testeDatas.php" method="post">
  <div class="input-field col s12 m6">
      <select class="icons" name="id" id="id">
      <option value="" disabled selected>Disciplina</option>   
      <?php       
            foreach ($daoDis->querySelect() as $value) {
?>

 
      <option value="<?=$value['id']?>"  class="left"><?=$value['nome']?></option>

      <?php } ?>
    </select>
      </div>
  <h3 class="center-align">Definir Datas</h3>
  <div class="row">
        
        <div class="input-field col s6">
            <h5 class="left-align">Inicio da Aula</h5>
          <input id="first_name" type="date" name="data_inicio" class="validate">
           </div>    
 
        <div class="input-field col s6">
           <h5 class="left-align">Fim da Aula</h5>
          <input id="first_name" type="date" name="data_fim" class="validate">
           </div>    
      </div>
   <p>
       <input type="checkbox" class="filled-in" name="porta[]" id="segunda" value="1">
      <label for="segunda">Segunda</label>
    </p>
   <p>
     
       <input type="checkbox" class="filled-in" name="porta[]" id="terca" value="2">
       <label for="terca">Terça</label>
    </p>
   <p>
     
       <input type="checkbox" class="filled-in" name="porta[]" id="quarta" value="3">
       <label for="quarta">Quarta</label>
    </p>
   <p>
       <input type="checkbox" class="filled-in" name="porta[]" id="quinta" value="4">
       <label for="quinta">Quinta</label>
    </p>
   <p>
     
       <input type="checkbox" class="filled-in" name="porta[]" id="sexta" value="5">
      <label for="sexta">Sexta</label>
    </p>
   <p>
      
       <input type="checkbox" class="filled-in" name="porta[]" id="sabado" value="6">
        <label for="sabado">Sabado</label>
      
    </p>
   <p>
      
       <input type="checkbox" class="filled-in" id="dia" name="porta[]" value="todos dias da semana" onclick="marcarTodos(this.checked);">
        <label for="dia">Marcar todos</label>
      
    </p>
        <div class="row">
 
          <input class="btn btn-primary" type="submit" value="Cadastrar" name="salvar">
      </div>
  </form>
 </div>
<script>
     function marcarTodos(marcar) {
                        var itens = document.getElementsByName('porta[]');

                        if (marcar) {
                            document.getElementById('dia').innerHTML = 'Desmarcar Todos';
                        } else {
                            document.getElementById('dia').innerHTML = 'Marcar Todos';
                        }

                        var i = 0;
                        for (i = 0; i < itens.length; i++) {
                            itens[i].checked = marcar;
                        }

                    }
</script>

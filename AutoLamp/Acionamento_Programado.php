<?php
include("logica-usuario.php");
verificaUsuario();
?>
<?php
include ("cabecalho.php");
include './Class/Alarme.php';
require_once './Dao/CrudDisciplina.php';
require_once './Dao/CrudAlarme.php';
$daoDis = new CrudDisciplina();
$alarme = new Alarme();
$daoAlarme = new CrudAlarme();
?> 

<h1 class="center-align">Cadastrar Alarme</h1>             
<div class="row">
    <form class="col s12" action="Acionamento_Programado.php" method="post">

        <div class="row">   
            <div class="input-field col s12 m6">
                <select class="icons" name="cod_dis" id="cod_dis">
                    <option value="" disabled selected>Disciplina</option>   
                    <?php
                    foreach ($daoDis->querySelect() as $value) {
                        ?>


                        <option value="<?= $value['id'] ?>"  class="left"><?= $value['nome'] ?></option>

                    <?php } ?>
                </select>
            </div>
            <div class="input-field col s12 m6">
                <select class="icons" name="periodo">
                    <option value="" disabled selected>Período</option>
                    <option value="Matutino"  class="left">Matutino</option>
                    <option value="Vespertino"  class="left">Vespertino</option>
                    <option value="Noturno"  class="left">Noturno</option>
                </select>
            </div>
        </div>
        <div class="row"> 
            <div class="input-field col s12 m6">
                <select class="icons" name="cod_sala" required autofocus>
                    <option value="" disabled selected>Sala</option> 

                    <?php
                    foreach ($daoAlarme->querySelectSala()as $value) {
                        ?>
                        <option value="<?= $value['id'] ?>"  class="left"><?= $value['nome'] ?></option>


                    <?php }
                    ?>
                </select>
            </div>
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
            <p style="text-align: justify;">
                <input type="checkbox" class="filled-in" name="dias[]" id="segunda" value="1">
                <label for="segunda">Segunda-Feira</label>

                <input type="checkbox" class="filled-in" name="dias[]" id="terca" value="2">
                <label for="terca">Terça-Feira</label>

                <input type="checkbox" class="filled-in" name="dias[]" id="quarta" value="3">
                <label for="quarta">Quarta-Feira</label>

                <input type="checkbox" class="filled-in" name="dias[]" id="quinta" value="4">
                <label for="quinta">Quinta-Feira</label>


                <input type="checkbox" class="filled-in" name="dias[]" id="sexta" value="5">
                <label for="sexta">Sexta-Feira</label>


                <input type="checkbox" class="filled-in" name="dias[]" id="sabado" value="6">
                <label for="sabado">Sábado</label>


                <input type="checkbox" class="filled-in" id="dia" name="dias[]" value="todos dias da semana" onclick="marcarTodos(this.checked);">
                <label for="dia">Marcar todos</label>

            </p>
        </div>

        <h3 class="center-align">Definir Horários</h3>
        <div class="row">

            <div class="input-field col s6">
                <h5 class="left-align">Horário Inicial</h5>
                <input id="first_name" type="time" name="hora_inicio" class="validate">
            </div>    

            <div class="input-field col s6">
                <h5 class="left-align">Horário Final</h5>
                <input id="first_name" type="time" name="hora_fim" class="validate">
            </div>    
        </div>
        <div class="row">

            <input class="btn btn-primary" type="submit" value="Cadastrar" name="salvar">
        </div>

    </form>
</div>
<script>
    function marcarTodos(marcar) {
        var itens = document.getElementsByName('dias[]');

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
<?php
if ($_POST) {
    if ($_POST['salvar']) {
        if ((isset($_POST['cod_dis'])) && (isset($_POST['hora_inicio'])) &&
                (isset($_POST['hora_fim'])) && (isset($_POST['data_fim'])) && (isset($_POST['data_inicio'])) &&
                (isset($_POST['periodo'])) && (isset($_POST['cod_sala']))) {
// resgata variáveis do formulário
            $alarme->setAula(isset($_POST['cod_dis']) ? $_POST['cod_dis'] : '');
            $alarme->setHora_inicio(isset($_POST['hora_inicio']) ? $_POST['hora_inicio'] : '');
            $alarme->setHora_final(isset($_POST['hora_fim']) ? $_POST['hora_fim'] : '');
            $fim = new DateTime(isset($_POST['data_fim']) ? $_POST['data_fim'] : '');
            $inicio = new DateTime(isset($_POST['data_inicio']) ? $_POST['data_inicio'] : '');
            $alarme->setPeriodo(isset($_POST['periodo']) ? $_POST['periodo'] : '');
            $alarme->setData_fim(date('d/m/Y', strtotime($fim->format('d-n-Y'))));
            $alarme->setData_inicio(date('d/m/Y', strtotime($inicio->format('d-n-Y'))));
            $alarme->setData_inicio(date('d/m/Y', strtotime($inicio->format('d-n-Y'))));
            $alarme->setData_inicio(date('d/m/Y', strtotime($inicio->format('d-n-Y'))));
            $alarme->setCod_sala(isset($_POST['cod_sala']) ? $_POST['cod_sala'] : '');
//define o intervalo
            $fim->modify('+1 day');
            $interval = new DateInterval('P1D');
            $periodo = new DatePeriod($inicio, $interval, $fim);

            //define o fuso
            $fuso = new DateTimeZone($alarme->getFuso());
            $data = new DateTime();
            $data->setTimezone($fuso);

            //array para definir as datas
            $s = array();
            foreach ($_POST as $chave => $valor) {
                if (is_array($valor)) {

                    foreach ($valor as $ch => $va) {
                        foreach ($periodo as $data) {
                            if ($dia = date('w', strtotime($data->format('d-n-Y'))) != 0) {
                                if ($dia = date('w', strtotime($data->format('d-n-Y'))) == $va) {
                                    $alarme->setData(date('d/m/Y', strtotime($data->format('d-n-Y'))));


                                    $resultado = $daoAlarme->queryInsert($alarme->getAula(), $alarme->getHora_inicio(), $alarme->getHora_final(), $alarme->getPeriodo(), $alarme->getData_fim(), $alarme->getData_inicio(), $alarme->getData(), $alarme->getCod_sala());
                                }
                            }
                        }
                    }
                }
            }

            if ($resultado == "ok") {
                ?>
                <script>
                    alert("Alarme inserido com sucesso!");
                </script>

            <?php } else {
                ?>
                <script>
                    alert("Alarme não inserido!.");
                </script>

                <?php
            }
        }
    }
}
?>
<?php include("rodape.php"); ?>


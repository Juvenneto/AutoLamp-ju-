<?php
include("Logica-Usuario.php");
verificaUsuario();
?>
<?php
include ("cabecalho.php");

include './Class/Alarme.php';
require_once './Dao/CrudAlarme.php';
$alarme = new Alarme();
$daoAlarme = new CrudAlarme();
 if ($_POST) {
    if (isset($_POST['excluir'])) {
        if ((isset($_POST['excluir_id']))) {
// resgata variáveis do formulário
            $alarme->setId(isset($_POST['excluir_id']) ? $_POST['excluir_id'] : '');
            ?>
<?php
            $resultado = $daoAlarme->queryDeleteAlarme($alarme->getId());

            if ($resultado == "ok") {
                ?>
                <script>
                    alert("Alarme removido com sucesso!");
                </script>

            <?php } else {
                ?>
                <script>
                    alert("Aula não removida!");
                </script>
                <?php
            }
 
        }
    }
}

if ($_POST) {
    if (isset($_POST['alterar'])) {
        if ((isset($_POST['alterar_id']))) {
            if ((isset($_POST['alterar_id'])) && (isset($_POST['periodo'])) && (isset($_POST['inicio'])) &&
                    (isset($_POST['fim'])) && (isset($_POST['cod_disciplina']))) {

                $alarme->setId(isset($_POST['alterar_id']) ? $_POST['alterar_id'] : '');
                $alarme->setPerido(isset($_POST['periodo']) ? $_POST['periodo'] : '');
                $alarme->setData_inicio(isset($_POST['inicio']) ? $_POST['inicio'] : '');
                $alarme->setData_fim(isset($_POST['fim']) ? $_POST['fim'] : '');
                $alarme->setCod_dis(isset($_POST['cod_disciplina']) ? $_POST['cod_disciplina'] : '');


                $resultado = $objdao->queryUpdate2($alarme->getId(), $alarme->getPerido(), $alarme->getData_inicio(), $alarme->getData_fim(), $alarme->getCod_dis());
                if ($resultado == "ok") {
                    ?>
                    <script>
                        alert("Aula alterado com sucesso!");
                    </script>

                <?php } else {
                    ?>
                    <script>
                        alert("Aula não alterado!");
                    </script>

                <?php
                }
            }
        }
    }
}
if ($_POST) {
    if (isset($_POST['alterarAlarme'])) {
        if ((isset($_POST['alterar_id']))) {
            if ((isset($_POST['alterar_id'])) && (isset($_POST['hora_inicio'])) && (isset($_POST['hora_fim'])) &&
                    (isset($_POST['data']))) {

                $alarme->setId(isset($_POST['alterar_id']) ? $_POST['alterar_id'] : '');
                $alarme->setHora_inicio(isset($_POST['hora_inicio']) ? $_POST['hora_inicio'] : '');
                $alarme->setHora_final(isset($_POST['hora_fim']) ? $_POST['hora_fim'] : '');
                $alarme->setData(isset($_POST['data']) ? $_POST['data'] : '');
          
        $result = $daoAlarme->queryUpdateAlarme($alarme->getId(), $alarme->getHora_inicio(), $alarme->getHora_final(), $alarme->getData());
                if ($result == "ok") {
                    ?>
                    <script>
                        alert("Alarme alterado com sucesso!");
                    </script>

                <?php } else {
                    ?>
                    <script>
                        alert("Alarme não alterado!");
                    </script>

                    <?php
                }
            }
        }
    }
}
?>
<h1 class="center-align">Listar Alarme</h1> 
<table class="centered">
    <thead>
        <tr>
            <th>Professor</th>      
            <th>Disciplina</th>
            <th>Sala</th>
            <th>Periodo</th>
        </tr>
    </thead>
    <?php foreach ($daoAlarme->querySelect() as $value) { ?>
        <tbody>
            <tr>
                <td><?= $value['prof_nome'] ?></td>
                <td><?= $value['aula_nome'] ?></td>
                <td><?= $value['sala'] ?></td>
                <td><?= $value['periodo'] ?></td>
                <td>

                    <!--<form class="form_editar" action="EditaAlarme.php" method="post" style="float: left; margin: 0 15px;">
                        <input name="editar_id" type="hidden" value="<?= $value['id'] ?>"/>
                        <button class="btn tooltipped btn-floating btn-large waves-effect waves-light blue" 
                                name="editar" type="submit" data-position="bottom" data-tooltip="Editar"><i class="material-icons">edit</i></button>
                    </form> -->
                    <form class="form_lista" action="listasAlarmes.php" method="post" style="float: left; margin: 0 15px;">
                        <input name="id_aula" type="hidden" value="<?= $value['id_aula'] ?>"/>
                        <input name="id_prof" type="hidden" value="<?= $value['id_prof'] ?>"/>
                        <input name="id_periodo" type="hidden" value="<?= $value['periodo'] ?>"/>
                        <input name="id_sala" type="hidden" value="<?= $value['id_sala'] ?>"/>
                        <button class="btn tooltipped btn-floating btn-large waves-effect waves-light blue" 
                                name="editar" type="submit" data-position="bottom" data-tooltip="Ver Todos Alarmes"><i class="material-icons">access_alarms</i></button>
                    </form>

                    <!--<form class="form_excluir" action="ListaAlarme.php" method="post" style="float: left; margin: 0 15px">
                        <input name="excluir_id" type="hidden" value="<?= $value['id'] ?>"/>
                        <button class="btn tooltipped btn-floating btn-large waves-effect waves-light red" 
                                name="excluir" type="submit" data-position="bottom" data-tooltip="Excluir"><i class="material-icons">delete</i></button>
                    </form>-->

                </td>

            </tr>
        </tbody>
    <?php } ?>
</table>

<?php include("Rodape.php"); ?>
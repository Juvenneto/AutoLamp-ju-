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
$id_aula = $_POST['id_aula'];
$id_prof = $_POST['id_prof'];
$id_periodo = $_POST['id_periodo'];
$id_sala = $_POST['id_sala'];
?>
<h1 class="center-align">Listar Alarme</h1> 
<table class="centered">
    <thead>
        <tr>
            <th>Data</th>
            <th>Hora Inicio</th>
            <th>Hora Fim</th>
        </tr>
    </thead>

    <?php foreach ($daoAlarme->querySelecionaAlarmes($id_aula, $id_prof, $id_periodo, $id_sala) as $value) { ?>
        <tbody>
            <tr>
                <td><?= $value['dia'] ?></td>
                <td><?= $value['hora_inicio'] ?></td>
                <td><?= $value['hora_fim'] ?></td>

                <td>

                    <form class="form_editar" action="editaAlarme.php" method="post" style="float: left; margin: 0 15px;">
                        <input name="id_alarme" type="hidden" value="<?= $value['id_alarme'] ?>"/>
                        <button class="btn tooltipped btn-floating btn-large waves-effect waves-light blue" 
                                name="editar" type="submit" data-position="bottom" data-tooltip="Editar"><i class="material-icons">edit</i></button>
                    </form>

                    <form class="form_excluir" action="ListaAlarme.php" method="post" style="float: left; margin: 0 15px">
                        <input name="excluir_id" type="hidden" value="<?= $value['id_alarme']?>"/>
                        <button class="btn tooltipped btn-floating btn-large waves-effect waves-light red" onclick="return confirm('Deseja mesmo remover?');"
                                name="excluir" type="submit" data-position="bottom" data-tooltip="Cancelar Alarme"><i class="material-icons">alarm_off</i></button>
                    </form>


                </td>

            </tr>
        </tbody>
    <?php } ?>
</table>
<?php include("Rodape.php"); ?>

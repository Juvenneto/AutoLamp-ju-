<?php include ("Logica-Usuario.php"); ?>
<?php
include ("cabecalho.php");
include './Class/Alarme.php';
require_once './Dao/CrudDisciplina.php';
require_once './Dao/CrudAlarme.php';
$daoDis = new CrudDisciplina();
$alarme = new Alarme();
$daoAlarme = new CrudAlarme();
if (isset($_GET["logout"]) && $_GET["logout"] == true) {
    ?>

    <p class="alert-sucess"> Deslogado com sucesso!!</p>

<?php } ?>

<?php
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

if (isset($_GET["login"]) && $_GET["login"] == false) {
    ?>
    <script>
        alert("Usuario ou senha invalida");
    </script>
<?php } ?>


<?php if (isset($_GET["falhaDeSeguranca"]) && $_GET["falhaDeSeguranca"] == true) { ?>
    <script>
        alert("Faça o login");
    </script>
<?php } ?>


<?php if (usuarioEstaLogado()) { ?>
    <h1 class="center-align">Alarmes do Dia</h1>
    <table class="centered">
        <thead>
            <tr>
                <th>Professor</th>      
                <th>Disciplina</th>
                <th>Sala</th>
                <th>Periodo</th>
                <th>Data</th>
                <th>Hora Inicio</th>
                <th>Hora Fim</th>
            </tr>
        </thead>

        <?php
        foreach ($daoAlarme->querySelectDia() as $value) {
            $fuso = new DateTimeZone('America/Belem');
            $data = new DateTime();
            $data->setTimezone($fuso);

            if ($dia = date('d/m/Y', strtotime($data->format('d-n-Y'))) == $value['dia']) {
                ?>

                <tbody>
                    <tr><td><?= $value['prof_nome'] ?></td>
                        <td><?= $value['aula_nome'] ?></td>
                        <td><?= $value['sala'] ?></td>
                        <td><?= $value['periodo'] ?></td>
                        <td><?= $value['dia'] ?></td>
                        <td><?= $value['hora_inicio'] ?></td>
                        <td><?= $value['hora_fim'] ?></td>
                        <td>

                            <form class="form_editar" action="EditaAlarmePrincipal.php" method="post" style="float: left; margin: 0 15px;">
                                <input name="id_alarme" type="hidden" value="<?= $value['id_alarme'] ?>"/>
                                <button class="btn tooltipped btn-floating btn-large waves-effect waves-light blue" 
                                        name="editar" type="submit" data-position="bottom" data-tooltip="Editar"><i class="material-icons">edit</i></button>
                            </form>

                            <form class="form_excluir" action="index.php" method="post" style="float: left; margin: 0 15px">
                                <input name="excluir_id" type="hidden" value="<?= $value['id_alarme'] ?>"/>
                                <button class="btn tooltipped btn-floating btn-large waves-effect waves-light red" onclick="return confirm('Deseja mesmo remover?');"
                                        name="excluir" type="submit" data-position="bottom" data-tooltip="Cancelar Alarme"><i class="material-icons">alarm_off</i></button>
                            </form>

                        </td>

                    </tr>
                </tbody>
            <?php } 
        }
        ?>
    </table>

    <?php
} else {
    ?>	


    <div class="container">
        <form action="login.php" method="post" class="form-signin">
            <h2 class="form-signin-heading">Login</h2>
            <label for="inputEmail" class="sr-only">Nome</label>
            <input type="text" name="nome" id="inputEmail" class="form-control" placeholder="Nome" required autofocus>
            <label for="inputPassword" class="sr-only">Número da Matricula</label>
            <input type="text" name="num_mat" id="inputPassword" class="form-control" placeholder="Número da Matricula" required>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Acessar</button>

        </form>

        <?php
    }
    ?>

<?php include("Rodape.php"); ?>	
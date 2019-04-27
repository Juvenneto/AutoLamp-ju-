<?php
include ("cabecalho.php");


if ($_POST) {
    if (isset($_POST['editar'])) {
        if ((isset($_POST['id_alarme']))) {


            include './Class/Alarme.php';
            require_once './Dao/CrudDisciplina.php';
            require_once './Dao/CrudAlarme.php';
            $daoDis = new CrudDisciplina();
            $alarme = new Alarme();
            $daoAlarme = new CrudAlarme();

            $id = $_POST['id_alarme'];

            foreach ($daoAlarme->querySeleciona($id) as $value) {
                ?>

                <h1 class="center-align">Editando Alarme</h1>

                <div class="row">
                    <form class="col s12" action="index.php" method="post">
                        <input name="alterar_id" type="hidden" value="<?= $value['id_alarme'] ?>"/>             
                        <h3 class="center-align">Alterarando Horários</h3>
                        <div class="row">

                            <div class="input-field col s6">
                                <h5 class="left-align">Horário Inicial</h5>
                                <input id="first_name" type="time" value="<?= $value['hora_inicio'] ?>" name="hora_inicio" class="validate">
                            </div>    

                            <div class="input-field col s6">
                                <h5 class="left-align">Horário Final</h5>
                                <input id="first_name" type="time" value="<?= $value['hora_fim'] ?>" name="hora_fim"  class="validate">
                            </div>    
                        </div>

                        <div class="row">
                            <h3 class="center-align">Alterarando Datas</h3>

                            <div class="input-field col s6">
                                <h5 class="left-align">Data</h5>
                                <input type="date" name="data" value="<?= $value['dia'] ?>" class="validate">
                            </div>

                        </div> 
                    <?php }
                    ?>
                            
                    <input class="btn btn-primary" type="submit" value="Alterar" name="alterarAlarme">
                    </div>
                    </div> 

                </form>
            </div>
            <?php
        }
    }
}


include("Rodape.php");
?>

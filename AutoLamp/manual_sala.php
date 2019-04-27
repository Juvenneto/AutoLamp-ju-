<?php
include("logica-usuario.php");
verificaUsuario();
?>
<?php
include ("cabecalho.php");
?>
<?php
if ($_POST) {
    if (isset($_POST['salvar'])) {
        if ((isset($_POST['cod_sala']))) {
            include './Class/Equipamento.php';
            include './Class/Arduino.php';
            require_once './Dao/CrudEquipamento.php';
            
            $arduino = new Arduino();

            $equipamento = new Equipamento();
            $daoEqi = new CrudEquipamento();
// resgata variáveis do formulário
            $equipamento->setCod_sala(isset($_POST['cod_sala']) ? $_POST['cod_sala'] : '');
            foreach ($daoEqi->querySeleciona3($equipamento->getCod_sala()) as $value) {
                ?>

                <tbody>
                    <tr>
                <div class="center-align">      
                    <form action="Manual.php" method="post">

                        <tr>
                            <td><?= $value['nome'] ?></td>
                            <td> <div class="switch">

                                    <label>
                                        Desligar 
<!--                                    <input type="checkbox" name="porta[]" value="<?= $value['nome_Porta'] ?>">-->
                                        <input type="checkbox" name="porta[]" onClick="circuito(2,'<?= $value['nome_Porta'] ?>');"/>
                                        <span class="lever"></span>
                                        Ligar
                                    </label>
                                    <br>
                                    <br>
                                </div></td>
                        </tr>



            <?php } ?>

                    <br>
                    <br>
                    <tr>
                        <td>Selecionar Todos </td>
                        <td> <div class="switch">
                                <label>
                                    Desligar
                                    <input type="checkbox" name="porta[]" id="acao" onclick="marcarTodos(this.checked);">
                                    <span class="lever" ></span> 
                                    Ligar
                                </label>
                            </div></td>
                    </tr>

                    <br>
                    <br>

                    <input class="btn btn-primary" type="submit" value="enviar">

                    </tr>
                    </div>
                    </tbody>
                </form>
                <script type="text/javascript">
                    function marcarTodos(marcar) {
                        var itens = document.getElementsByName('porta[]');

                        if (marcar) {
                            document.getElementById('acao').innerHTML = 'Desmarcar Todos';
                        } else {
                            document.getElementById('acao').innerHTML = 'Marcar Todos';
                        }

                        var i = 0;
                        for (i = 0; i < itens.length; i++) {
                            itens[i].checked = marcar;
                        }

                    }
                </script>

        <div id="circuito1"></div><br/><br/><br/>
        <div id="circuito2"></div><br/><br/><br/>
        <div id="circuito3"></div>
            
  <script src="js/jquery-1.10.2.min.js"></script>
        <script>
            function circuito(num,setor){
                document.getElementById("circuito"+num).innerHTML = "<iframe frameborder='0' width='0px' height='0px' src='http://192.168.0.140/?"+setor+"'></iframe>"; 
		console.log("<iframe width='0%' height='0%' src='http://192.168.0.140/?"+setor+"'></iframe>");  
            }
        </script> 

            <?php
        }
    }
}
?>
    <?php include("Rodape.php"); ?>
<?php

    require_once("templates/header.php");
    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("dao/EmployeeDAO.php");
    require_once("models/DateBank.php");
    require_once("dao/DateBankDAO.php");

    $employeeDao = new EmployeeDAO($conn, $BASE_URL);
    $userDao = new UserDao($conn, $BASE_URL);
    $dateBankDao = new DateBankDAO($conn, $BASE_URL);

    //protect page
    $userData = $userDao->verifyToken(true);

    //get id employee
    $id = filter_input(INPUT_GET, "id");

    //chech if employee exist
    $employee;

    if (!empty($id)) {

        //malicious data
        $employee = $employeeDao->findById($id);

        if (!$employee) {

            $message->setMessage("Colaborador não encontrado", "error");
        }

        $dateBankEmployee = $dateBankDao->getDateBankByEmployeeId($employee->id);

    } else {

        //malicious data
        $message->setMessage("Colaborador não encontrado", "error");
    }

?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Banco de Horas</h2>
        <p class="section-description">Faça o lançamento de ponto das entradas e saídas dos colaboradores</p>
        <input 
            type="text" 
            id="filterInput"
            placeholder="Escreva a data para filtrar"
            class="form-control"
        >
        <script>
            $(document).ready(function(){
                $("#filterInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myDateData tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        <div class="col-md-12" id="employees-dashboard">
            <div class="col-md-12" id="add-employee-container">
                <form action="<?= $BASE_URL ?>/datebank_process.php" class="button-form" method="POST">
                    <input type="hidden" name="type" value="entry">
                    <input type="hidden" name="id" value="<?= $employee->id ?>">
                    <button type="submit" class="btn card-btn">
                        <i class="fa-regular fa-calendar-plus"></i> Adicionar Entrada
                    </button>
                </form>
            </div>
            <table class="table">
                <thead>
                    <th scope="col">Data</th>
                    <th scope="col">Hora da Entrada</th>
                    <th scope="col">Hora de Saída</th>
                    <th scope="col" class="actions-column">Ações</th>
                </thead>
                <tbody id="myDateData">
                    <?php foreach ($dateBankEmployee as $dateEmployee): ?>
                        <tr>
                            <td scope="row" id="calendar">
                                <?= $dateEmployee->calendar ?>
                            </td>
                            <td scope="row">
                                <?= $dateEmployee->entry ?>
                            </td>
                            <td scope="row">
                                <?= $dateEmployee->output ?>
                            </td>
                            <td class="actions-colum">
                                <form action="<?= $BASE_URL ?>/datebank_process.php" class="button-form" method="POST">
                                    <input type="hidden" name="type" value="output">
                                    <input type="hidden" name="id" value="<?= $dateEmployee->id ?>">
                                    <button type="submit" class="">
                                        <i class="fa-regular fa-calendar-minus"></i> Adicionar Saída
                                    </button>
                                </form>
                                <form action="<?= $BASE_URL ?>/datebank_process.php" class="button-form" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $dateEmployee->id ?>">
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-times"></i> Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php

    require_once("templates/footer.php");

?>
<?php

    require_once("templates/header.php");
    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("dao/EmployeeDAO.php");

    $employeeDao = new EmployeeDAO($conn, $BASE_URL);

    //GET ID EMPLOYEE
    $id = filter_input(INPUT_GET, "id");

    $employee;

    if (!empty($id)) {

        $employee = $employeeDao->findById($id);

        if (!$employee) {

            $message->setMessage("Colaborador não encontrado", "error");
        }

    } else {

        $message->setMessage("Colaborador não encontrado", "error");
    }


?>

    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Banco de Horas</h2>
        <p class="section-description">Faça o lançamento de ponto das entradas e saídas dos colaboradores</p>
        <div class="col-md-12" id="employees-dashboard">
            <table class="table">
                <thead>
                    <th scope="col">Data</th>
                    <th scope="col">Hora da Entrada</th>
                    <th scope="col">Hora de Saída</th>
                    <th scope="col" class="actions-column">Ações</th>
                </thead>
                <tbody>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td class="actions-colum">
                        <form action="<?= $BASE_URL ?>/datebank_process.php" class="button-form" method="POST">
                            <input type="hidden" name="type" value="entry">
                            <input type="hidden" name="id" value="<?= $employee->id ?>">
                            <button type="submit" class="">
                                <i class="fa-regular fa-calendar-plus"></i> Adicionar Entrada
                            </button>
                        </form>
                        <form action="<?= $BASE_URL ?>/datebank_process.php" class="button-form" method="POST">
                            <input type="hidden" name="type" value="exit">
                            <input type="hidden" name="id" value="<?= $employee->id ?>">
                            <button type="submit" class="">
                            <i class="fa-regular fa-calendar-minus"></i> Adicionar Saída
                            </button>
                        </form>
                        <form action="<?= $BASE_URL ?>/datebank_process.php" class="button-form" method="POST">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="id" value="<?= $employee->id ?>">
                            <button type="submit" class="delete-btn">
                                <i class="fas fa-times"></i> Deletar
                            </button>
                        </form>
                    </td>
                </tbody>
            </table>
        </div>
    </div>

<?php

    require_once("templates/footer.php");

?>
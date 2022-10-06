<?php

    require_once("templates/header.php");
    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Users.php");
    require_once("dao/UserDAO.php");
    require_once("dao/EmployeeDAO.php");

    $user = new User();
    $userDao = new userDAO($conn, $BASE_URL);
    $employeeDao = new EmployeeDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $userEmployees = $employeeDao->getEmployeeByUserId($userData->id);

    //User dont put a photo
    foreach ($userEmployees as $employee) {

        if ($employee->image == "") {

            $employee->image = "user.png";
        }
    }

?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Dashboard</h2>
        <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
        <?php require_once("templates/filter.php"); ?>
        <div class="col-md-12" id="add-employee-container">
            <a href="<?= $BASE_URL ?>/createEmployee.php" class="btn card-btn">
                <i class="fas fa-plus"></i> Adicionar Colaborador
            </a>
        </div>
        <div class="col-md-12" id="employees-dashboard">
            <table class="table">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Nome Completo</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Função</th>
                    <th scope="col" class="actions-column">Ações</th>
                </thead>
                <tbody id="myDateData">
                    <?php foreach ($userEmployees as $employee): ?>
                        <tr>
                            <td scope="row"><?= $employee->id ?></td>
                            <td>
                                <a 
                                    href="<?= $BASE_URL ?>/individualEmployee.php?id=<?= $employee->id ?>" 
                                    class="table-employee-title"
                                >
                                    <?= $employee->name ?> <?= $employee->lastname ?>
                                </a>
                            </td>
                            <td>
                                <div 
                                    id="dash-image"
                                    style="background-image: url('<?= $BASE_URL ?>/uploads/employees/<?= $employee->image ?>')";
                                ></div>
                            </td>
                            <td>
                                <?= $employee->occupation ?>
                            </td>
                            <td class="actions-colum">
                                <a 
                                    href="<?= $BASE_URL ?>/editEmployee.php?id=<?= $employee->id ?>" 
                                    class="edit-btn"
                                >
                                    <i class="far fa-edit"></i> Editar
                                </a>
                                <form action="<?= $BASE_URL ?>/employee_process.php" class="button-form" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $employee->id ?>">
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
<?php

    require_once("templates/header.php");
    require_once("helpers/db.php");
    require_once("helpers/globals.php");
    require_once("models/Users.php");
    require_once("dao/UserDAO.php");
    require_once("dao/EmployeeDAO.php");

    $userDao = new userDAO($conn, $BASE_URL);
    $employeeDao = new EmployeeDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);

    $id = filter_input(INPUT_GET, "id");

    $userEmployee = $employeeDao->findById($id);
?>
    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Editar Colaborador</h1>
            <p class="page-description">Faça aqui as edições necessárias.</p>
            <form 
                action="<?= $BASE_URL ?>/employee_process.php"
                id="add-movie-form"
                method="POST"
                enctype="multipart/form-data"
            >
                <input type="hidden" name="type" value="update">
                <input type="hidden" name="id" value="<?= $userEmployee->id ?>">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control"
                        placeholder="Digite o nome de seu colaborador"
                        value="<?= $userEmployee->name ?>"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="lastname">Sobrenome:</label>
                    <input 
                        type="text" 
                        name="lastname" 
                        id="lastname" 
                        class="form-control"
                        placeholder="Digite o sobrenome de seu colaborador"
                        value="<?= $userEmployee->lastname ?>"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="occupation">Ocupação:</label>
                    <input 
                        type="text" 
                        name="occupation" 
                        id="occupation" 
                        class="form-control"
                        placeholder="O que seu colaborador faz na empresa?"
                        value="<?= $userEmployee->occupation ?>"
                        required
                    >
                </div>
                <div class="form-group" id="photo-container">
                    <label for="image">Foto:</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        class="form-control-file"
                    >
                </div>
                <input type="submit" value="Enviar" class="btn card-btn">
            </form>
        </div>
    </div>
<?php

    require_once("templates/footer.php");

?>
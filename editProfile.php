<?php

    require_once("templates/header.php");
    require_once("dao/UserDAO.php");

    $userData = $userDao->verifyToken(true);

?>
    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <div class="row" id="auth-row"> 
                <div class="col-md-4">
                    <h2 class="edit-profile-title">
                        Olá <?= $userData->name ?> <?= $userData->lastname ?>
                    </h2>
                    <p class="page-description">Preencha abaixo para editar os dados de sua conta:</p>
                    <form action="<?= $BASE_URL ?>user_process.php" method="POST">
                        <input type="hidden" name="type" value="update">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                placeholder="Digite o nome" 
                                class="form-control"
                                value="<?= $userData->name ?>"
                                required
                            >  
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input 
                                type="text" 
                                name="lastname" 
                                id="lastname" 
                                placeholder="Digite o sobrenome" 
                                class="form-control"
                                value="<?= $userData->lastname ?>"
                                required
                            >  
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                placeholder="Digite o email" 
                                class="form-control disabled"
                                value="<?= $userData->email ?>"
                                readonly
                            >
                        </div>
                        <input type="submit" value="Editar Dados" class="btn card-btn">
                    </form>
                    
                </div>
                <div class="col-md-4">
                    <h2 class="edit-profile-title">Editar Senha</h2>
                    <p class="page-description">Preencha abaixo para editar a senha de sua conta:</p>
                    <form action="<?= $BASE_URL ?>user_process.php" method="POST">
                        <input type="hidden" name="type" value="changepassword">
                        <div class="form-group">
                            <label for="password">Nova Senha:</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                placeholder="Digite a senha" 
                                class="form-control"
                            >
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Corfirme a nova senha:</label>
                            <input 
                                type="password" 
                                name="confirmpassword" 
                                id="confirmpassword" 
                                placeholder="Repita a senha" 
                                class="form-control"
                            >
                        </div>
                        <input type="submit" value="Editar Senha" class="btn card-btn">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
<?php

    require_once("templates/footer.php");

?>
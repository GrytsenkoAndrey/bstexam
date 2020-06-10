<?php
require APPROOT . '/views/include/header.php';
?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <?= $_SESSION['infoMsg'] ?? '' ?>
            <div class="card card-body bg-light mt-5">
                <h2>Авторизация</h2>

                <form action="<?= URLROOT ?>user/login" method="POST">
                    <div class="form-group">
                        <label for="login">Email <sup>*</sup></label>
                        <input type="email" name="login" id="login" class="form-control form-control-lg
                    <?php
                        echo (!empty($data['email_error'])) ? ' is-invalid' : '';
                        ?>
                    " value="<?= $data['email'] ?>">
                        <span class="invalid-feedback"><?= $data['login_error'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup></label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg
                    <?php
                        echo (!empty($data['password_error'])) ? ' is-invalid' : '';
                        ?>
                    " value="<?= $data['password'] ?>">
                        <span class="invalid-feedback"><?= $data['password_error'] ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Вход" class="btn btn-success btn-block">
                        </div>
                        <div class='col'>
                            <a href="<?= URLROOT ?>user/register/" class="btn btn-light btn-block">Регистрация</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
require APPROOT . '/views/include/footer.php';
?>
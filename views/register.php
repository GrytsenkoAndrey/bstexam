<?php
require APPROOT . '/views/include/header.php';
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Регистрация</h2>

            <form action="<?= URLROOT ?>user/register" method="POST">
                <div class="form-group">
                    <label for="login">Email <sup>*</sup></label>
                    <input type="email" name="login" id="login" class="form-control form-control-lg
                    <?php
                    echo (!empty($data['login_error'])) ? ' is-invalid' : '';
                    ?>
                    " value="<?= $data['login'] ?>">
                    <span class="invalid-feedback"><?= $data['login_error'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Пароль <sup>*</sup></label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg
                    <?php
                    echo (!empty($data['password_error'])) ? ' is-invalid' : '';
                    ?>
                    " value="<?= $data['password'] ?>" onChange="javascript:comparePass();">
                    <span class="invalid-feedback"><?= $data['password_error'] ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm">Подтверждение <sup>*</sup></label>
                    <input type="password" name="confirm" id="confirm" class="form-control form-control-lg
                    <?php
                    echo (!empty($data['confirm_error'])) ? ' is-invalid' : '';
                    ?>
                    " value="<?= $data['confirm'] ?>" onChange="javascript:comparePass();">
                    <span class="invalid-feedback"><?= $data['confirm_error'] ?></span>
                </div>
                <div id="info" class="alert alert-danger" hidden>
                    <p>Пароли не равны</p>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Регистрация" class="btn btn-success btn-block">
                    </div>
                    <div class='col'>
                        <a href="<?= URLROOT ?>user/login/" class="btn btn-light btn-block">Вход</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require APPROOT . '/views/include/footer.php';
?>
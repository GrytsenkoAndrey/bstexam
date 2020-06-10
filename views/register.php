<?php
require APPROOT . '/views/include/header.php';
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Регистрация</h2>

            <form action="<?= URLROOT ?>user/register" method="POST">
                <div class="form-group">
                    <label for="email">Email <sup>*</sup></label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg
                    <?php
                    echo (!empty($data['email_error'])) ? ' is-invalid' : '';
                    ?>
                    " value="<?= $data['email'] ?>">
                    <span class="invalid-feedback"><?= $data['email_error'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Пароль <sup>*</sup></label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg
                    <?php
                    echo (!empty($data['password_error'])) ? ' is-invalid' : '';
                    ?>
                    " value="<?= $data['password'] ?>">
                    <span class="invalid-feedback"><?= $data['password_error'] ?></span>
                </div>
                <div class="form-group">
                    <label for="confirm">Подтверждение <sup>*</sup></label>
                    <input type="password" name="confirm" id="confirm" class="form-control form-control-lg
                    <?php
                    echo (!empty($data['confirm_error'])) ? ' is-invalid' : '';
                    ?>
                    " value="<?= $data['confirm'] ?>">
                    <span class="invalid-feedback"><?= $data['confirm_error'] ?></span>
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
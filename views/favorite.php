<?php
require APPROOT . '/views/include/header.php';
?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2>Избранные</h2>

            <?php
            if (count($data['favorites']) > 0) {
                ?>
                <table class="table table-striped">
                    <tr>
                        <th>#ID</th>
                        <th>LOGIN</th>
                    </tr>
                <?php
                foreach ($data['favorites'] as $item) {
                    ?>
                    <tr>
                        <td><?= $item['id']; ?></td>
                        <td><?= $item['login']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <?php
            }
            ?>
        </div>
    </div>

<?php
require APPROOT . '/views/include/footer.php';
?>
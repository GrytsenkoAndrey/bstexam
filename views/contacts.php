<?php
require APPROOT . '/views/include/header.php';
?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2>Контакты</h2>

            <?php
            if (count($data['contacts']) > 0) {
                ?>
                <table class="table table-striped">
                <?php
                foreach ($data['contacts'] as $item) {
                    ?>
                    <tr>
                        <td><?= $item['login']; ?></td>
                        <td><a href="/user/add/id/<?= $item['id'] ?>" title="В избранные">В избранные</a></td>
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
<?php

declare(strict_types=1);

use MyRoutine\Database\MySqlManager;
use MyRoutine\Support\Session;

require __DIR__ . '/../vendor/autoload.php';

$session = new Session();

if (! $session->logged) {
    header('Location: ' . BASEURL);
    exit;
}

include __DIR__ . '/../layout/header.php'
?>

<div class="box">
    <h1>Minha Rotina</h1>
    <div class="items_flex">
        <?php
        try {
            $manager = new MySqlManager();
            $connect = $manager->connect();

            $query = 'SELECT * FROM `tasks` WHERE `user_id` = ?';

            $stmt = $connect->prepare($query);
            $stmt->bind_param('i', $userID);

            $userID = $session->userID;

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $stmt->close();
            }
        } catch (Exception $e) {
            //throw $th;
        }
        ?>
        <?php if ($result->num_rows) : ?>

            <?php foreach($result->fetch_all(MYSQLI_ASSOC) as $task) : ?>
            <div class="item <?= $task['is_checked'] ?>">
                <form action="<?= BASEURL ?>/process/task/remove_task.php" method="POST" class="item_remover">
                    <input type="hidden" name="taskID" value="">
                    <input type="submit" value="X">
                </form>
                <form class="checkboxLabel" action="/select" method="POST">
                    <input type="hidden" value="taskID">
                    <label id="span<?= $task['task_id'] ?>" class="label_item"><?= $task['task_name'] ?></label>
                    <input type="checkbox" name="checked" id="chec<?= $task['task_id'] ?>" onclick="checkTask('<?= $task['task_id']?>')">
                </form>
            </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <div class="tarefa_e_novo_dia">
        <form action="<?= BASEURL ?>/process/task/insert_task.php" method="POST" class="nova_tarefa">
            <input name="texto" type="text" placeholder="Nova tarefa">
            <input type="submit" value="+">
            <input type="submit" value="Adicionar tarefa" id="add_tarefa_mobile">
        </form>
        <div class="novo_dia">
            <form class="button" action="<?= BASEURL ?>/process/task/clear_task.php" method="POST">
                <input type="submit" value="Começar um novo dia">
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php' ?>

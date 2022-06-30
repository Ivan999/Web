<?php
  include "connect.php";
  $hosts = ($_POST['hosts']);
  $hosts_goals = ($_POST['hosts-goals']);
  $guests = ($_POST['guests']);
  $guests_goals = ($_POST['guests-goals']);

  if ($hosts == $guests) {
    echo "Нельзя выбрать две одинаковые команды ";
  } else {
    $mysql->query("INSERT INTO `game` (`hosts`, `hosts-goals`, `guests`, `guests-goals`)
    VALUES('$hosts', '$hosts_goals', '$guests', '$guests_goals')");
  };
 ?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Comand</title>
  </head>
  <body>
    <main>
      <form action="index.php" method="post">
        <select class="hosts" name="hosts" id="hosts">
          <?php
            $tea = $teams->fetch_all(MYSQLI_ASSOC);
            foreach ($tea as $key => $team) {
              ?>
              <option
                value="<?= $team['team'] ?>"
                id="team" name="team"><?=
                $team['team'] ?>
              </option>
              <?php
            }
          ?>
        </select>
        <label>Хозяева
          <input type="number" name="hosts-goals" id="hosts-goals" value="goals">
        </label>
        <select class="guests" name="guests" id="guests">
          <?php
            foreach ($tea as $key => $ream) {
              ?>
              <option
                value="<?= $ream['team'] ?>"
                id="team" name="team"><?=
                $ream['team'] ?>
              </option>
              <?php
            }
          ?>
        </select>
        <label>Гости
          <input type="number" name="guests-goals" id="guests-goals" value="goals">
        </label>
        <button type="submit" name="button">Отправить результат</button>
        <a href="total.php">Посмотреть результат</a>
      </form>
    </main>
  </body>
</html>

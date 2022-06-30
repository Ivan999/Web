<?php
  include "connect.php";
 ?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      table {
        border-spacing: 0 10px;
        font-weight: bold;
      }
      th {
        padding: 10px 20px;
        background: #56433D;
        color: #F9C941;
        border-right: 2px solid;
        font-size: 0.9em;
      }
      th:first-child {
        text-align: left;
      }
      th:last-child {
        border-right: none;
      }
      td {
        vertical-align: middle;
        padding: 10px;
        font-size: 14px;
        text-align: center;
        border-top: 2px solid #56433D;
        border-bottom: 2px solid #56433D;
        border-right: 2px solid #56433D;
      }
      td:first-child {
        border-left: 2px solid #56433D;
      }
    </style>
  </head>
  <body>
    <main>
      <form action="total.php" method="post">
        <select class="teams" id="teams" name="teams">
          <?php
            $team1 = ($_POST['teams']);
            while ($team = mysqli_fetch_assoc($teams)) {
              if ($team1 == $team['team']) {
                ?>
                <option value="<?= $team['team'] ?>" id="team" name="team" selected><?php echo $team['team'] ?></option>
                <?php
              } else {
                ?>
                <option value="<?= $team['team'] ?>" id="team" name="team"><?php echo $team['team'] ?></option>
                <?php
              }
            };
          ?>
        </select>
        <button type="submit" name="button">выбрать</button>
        <table>
          <caption>Таблица результатов команд</caption>
             <tr>
              <th>Хозяева</th>
              <th>Хозяева счёт</th>
              <th>Гости</th>
              <th>Гости счёт</th>
             </tr>
          <?php
            if ($team1) {
              $row_count = mysqli_num_rows($result);
              for ($i = 0; $i < $row_count; $i++) {
                $user1 = mysqli_fetch_assoc($result);
                if ($user1['hosts'] == $team1 || $user1['guests'] == $team1) {
                  ?>
                  <tr>
                    <td><?= $user1['hosts'] ?></td>
                    <td><?= $user1['hosts-goals'] ?></td>
                    <td><?= $user1['guests'] ?></td>
                    <td><?= $user1['guests-goals'] ?></td>
                  </tr>
                  <?php
                }

                if ($team1 == $user1['hosts']) {
                  $scored += $user1['hosts-goals'];
                  $missed += $user1['guests-goals'];
                } else if ($team1 == $user1['guests']) {
                  $scored += $user1['guests-goals'];
                  $missed += $user1['hosts-goals'];
                }
              }
            };
           ?>
        </table>
        <span><?= $team1  ?></span><br>
        <span>Забила: <?= $scored  ?>;</span><br>
        <span>Пропустила: <?= $missed  ?>;</span>
      </form>
    </main>
  </body>
</html>

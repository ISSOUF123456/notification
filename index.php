<?php 
require_once 'conx.php';

if (isset($_GET['notf'])) {
    $n_id = $_GET['notf'];
    $req = $pdo->prepare("UPDATE notifications SET read_n = '0' WHERE id = ?");
    $req->execute([$n_id]);
    header("Location: index.php");
    exit;
}

$data = $pdo->prepare("SELECT * FROM notifications ORDER BY id DESC");
$data->execute();
$result = $data->fetchAll();

$data1 = $pdo->prepare("SELECT * FROM notifications WHERE read_n = 1");
$data1->execute();
$count = $data1->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <style>
    body {
      padding: 20px;
      background-color: white;
    }
    .notification-item {
      padding: 8px 15px;
      border-bottom: 1px solid #eee;
    }
    .notification-item:last-child {
      border-bottom: none;
    }
    .notification-item a {
      color: inherit;
      text-decoration: none;
      display: block;
    }
    .notification-item.read {
      color: #666;
    }
    .notification-item.unread {
      background-color: #f9ecec;
      border-left: 3px solid red;
    }
    .dropdown-menu {
      min-width: 300px;
      max-height: 400px;
      overflow-y: auto;
    }
    .empty-notif {
      padding: 10px 15px;
      color: #888;
      font-style: italic;
    }
  </style>
</head>
<body>

<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    🔔 <?php if ($count > 0): ?><span class="badge badge-danger"><?php echo $count; ?></span><?php endif; ?>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <?php if (empty($result)): ?>
      <li class="empty-notif">Aucune notification</li>
    <?php else: ?>
      <?php foreach ($result as $value): ?>
        <?php if ($value['read_n'] == '1'): ?>
          <li class="notification-item unread">
            <a href="?notf=<?php echo htmlspecialchars($value['id']); ?>">
              <?php echo htmlspecialchars($value['title']); ?>
            </a>
          </li>
        <?php else: ?>
          <li class="notification-item read">
            <?php echo htmlspecialchars($value['title']); ?>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</div>

<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
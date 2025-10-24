<!-- ALTER TABLE notifications ADD COLUMN user_id INT NOT NULL; -->
<!-- // 1. Récupérer tous les utilisateurs
$users = $pdo->query("SELECT id FROM users")->fetchAll();

// 2. Pour chaque utilisateur, créer une notification
$title = $_POST['title'];
foreach ($users as $user) {
    $req = $pdo->prepare("INSERT INTO notifications (title, read_n, user_id) VALUES (?, 1, ?)");
    $req->execute([$title, $user['id']]);
} -->
<!-- $user_id = $_SESSION['user_id'];

// Toutes ses notifications
$data = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ?");
$data->execute([$user_id]);
$result = $data->fetchAll();

// Seulement les non lues (pour le badge)
$data1 = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? AND read_n = 1");
$data1->execute([$user_id]);
$count = $data1->rowCount(); -->
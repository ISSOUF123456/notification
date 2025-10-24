<?php 
require_once 'conx.php';

if (isset($_POST['btn-poster'])) {
    $title = trim($_POST['title']);
    if (!empty($title)) {
        $req1 = $pdo->prepare("INSERT INTO posts(title) VALUES (:title)");
        $req1->bindParam(":title", $title);
        $result = $req1->execute();

        $req2 = $pdo->prepare("INSERT INTO notifications (title, read_n) VALUES (:title, 1)");
        $req2->bindParam(":title", $title);
        $result1 = $req2->execute();

        if ($result && $result1) {
            $message = '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ✅ Publication réussie !
            </div>';
        } else {
            $message = '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ❌ Échec.
            </div>';
        }
    } else {
        $message = '<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            ⚠️ Veuillez écrire quelque chose.
        </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poster</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 40px;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-container">
                <h3 class="text-center">📝 Nouvelle publication</h3>
                <br>
                <form method="POST">
                    <div class="form-group">
                        <textarea 
                            class="form-control" 
                            name="title" 
                            placeholder="Écrivez votre message ici..." 
                            required
                        ></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btn-poster" class="btn btn-primary btn-lg">
                            📤 Publier
                        </button>
                    </div>
                </form>

                <?php if (isset($message)) echo $message; ?>
            </div>
        </div>
    </div>
</div>

<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
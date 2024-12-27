<?php
require_once '../controllers/PlayerController.php';

if (isset($_GET['id'])) {
    $playerId = $_GET['id'];
    $playerController = new PlayerController();
    $player = $playerController->readPlayer($playerId);

    if (!$player) {
        echo "Player not found.";
        exit;
    }
} else {
    echo "No player ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Player</title>
</head>
<body>
    <h1>Delete Player</h1>
    <p>Are you sure you want to delete the player <strong><?php echo htmlspecialchars($player['name']); ?></strong>?</p>
    <form action="../controllers/PlayerController.php?action=delete&id=<?php echo $playerId; ?>" method="POST">
        <input type="submit" value="Yes, delete">
        <a href="read.php">Cancel</a>
    </form>
</body>
</html>
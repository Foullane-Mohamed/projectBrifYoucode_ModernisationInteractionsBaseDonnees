<?php
require_once '../config/Database.php';
require_once '../models/Player.php';

$database = new Database();
$db = $database->getConnection();

$player = new Player($db);

if (isset($_GET['id'])) {
    $player->id = $_GET['id'];
    $player->readOne();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $player->id = $_POST['id'];
    $player->name = $_POST['name'];
    $player->nationality = $_POST['nationality'];
    $player->club = $_POST['club'];
    $player->position = $_POST['position'];
    $player->rating = $_POST['rating'];
    $player->player_id = $_POST['player_id'];
    $player->shooting = $_POST['shooting'];
    $player->pace = $_POST['pace'];
    $player->dribbling = $_POST['dribbling'];
    $player->defending = $_POST['defending'];
    $player->physical = $_POST['physical'];

    if ($player->update()) {
        header('Location: read.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player</title>
</head>
<body>
    <h1>Update Player</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($player->id); ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($player->name); ?>" required>
        <br>
        <label>Nationality:</label>
        <input type="text" name="nationality" value="<?php echo htmlspecialchars($player->nationality); ?>" required>
        <br>
        <label>Club:</label>
        <input type="text" name="club" value="<?php echo htmlspecialchars($player->club); ?>" required>
        <br>
        <label>Position:</label>
        <select name="position" required>
            <option value="GK" <?php echo ($player->position == 'GK') ? 'selected' : ''; ?>>GK</option>
            <option value="CM" <?php echo ($player->position == 'CM') ? 'selected' : ''; ?>>CM</option>
            <option value="CB" <?php echo ($player->position == 'CB') ? 'selected' : ''; ?>>CB</option>
            <option value="LB" <?php echo ($player->position == 'LB') ? 'selected' : ''; ?>>LB</option>
            <option value="RB" <?php echo ($player->position == 'RB') ? 'selected' : ''; ?>>RB</option>
            <option value="LW" <?php echo ($player->position == 'LW') ? 'selected' : ''; ?>>LW</option>
            <option value="CDM" <?php echo ($player->position == 'CDM') ? 'selected' : ''; ?>>CDM</option>
            <option value="ST" <?php echo ($player->position == 'ST') ? 'selected' : ''; ?>>ST</option>
            <option value="RW" <?php echo ($player->position == 'RW') ? 'selected' : ''; ?>>RW</option>
        </select>
        <br>
        <label>Rating:</label>
        <input type="number" name="rating" value="<?php echo htmlspecialchars($player->rating); ?>" min="1" max="100" required>
        <br>
        <label>Player ID:</label>
        <input type="number" name="player_id" value="<?php echo htmlspecialchars($player->player_id); ?>" required>
        <br>
        <label>Shooting:</label>
        <input type="number" name="shooting" value="<?php echo htmlspecialchars($player->shooting); ?>" min="0" max="100">
        <br>
        <label>Pace:</label>
        <input type="number" name="pace" value="<?php echo htmlspecialchars($player->pace); ?>" min="0" max="100">
        <br>
        <label>Dribbling:</label>
        <input type="number" name="dribbling" value="<?php echo htmlspecialchars($player->dribbling); ?>" min="0" max="100">
        <br>
        <label>Defending:</label>
        <input type="number" name="defending" value="<?php echo htmlspecialchars($player->defending); ?>" min="0" max="100">
        <br>
        <label>Physical:</label>
        <input type="number" name="physical" value="<?php echo htmlspecialchars($player->physical); ?>" min="0" max="100">
        <br>
        <input type="submit" value="Update Player">
    </form>
    <a href="read.php">Back to Player List</a>
</body>
</html>
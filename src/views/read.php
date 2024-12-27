<?php
require_once '../controllers/PlayerController.php';

$playerController = new PlayerController();
$players = $playerController->readPlayers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player List</title>
</head>
<body>
    <h1>Player List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Nationality</th>
                <th>Club</th>
                <th>Position</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <td><?php echo $player->id; ?></td>
                    <td><?php echo $player->name; ?></td>
                    <td><?php echo $player->nationality; ?></td>
                    <td><?php echo $player->club; ?></td>
                    <td><?php echo $player->position; ?></td>
                    <td><?php echo $player->rating; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $player->id; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $player->id; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="create.php">Add New Player</a>
</body>
</html>
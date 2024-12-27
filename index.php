<?php
require_once './src/models/Player.php';

$playerManager = new PlayerManager();
$players = $playerManager->getAllPlayers();
$message = '';
$editPlayer = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['add'])) {
            $playerManager->addPlayer($_POST);
            $message = "Player added successfully";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        if (isset($_POST['update'])) {
            $playerManager->updatePlayer($_POST, $_POST['id']);
            $message = "Player updated successfully";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        if (isset($_POST['delete'])) {
            $playerManager->deletePlayer($_POST['id']);
            $message = "Player deleted successfully";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        if (isset($_POST['edit'])) {
            $editPlayer = $playerManager->getPlayer($_POST['id']);
        }
    } catch(Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <?php if($message): ?>
        <div class="alert alert-info alert-dismissible fade show">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2><?= $editPlayer ? 'Edit Player' : 'Add Player' ?></h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <?php if($editPlayer): ?>
                            <input type="hidden" name="id" value="<?= $editPlayer['id'] ?>">
                        <?php endif; ?>
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" required
                                   value="<?= $editPlayer ? htmlspecialchars($editPlayer['name']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nationality" class="form-control" placeholder="Nationality" required
                                   value="<?= $editPlayer ? htmlspecialchars($editPlayer['nationality']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="club" class="form-control" placeholder="Club" required
                                   value="<?= $editPlayer ? htmlspecialchars($editPlayer['club']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <select name="position" class="form-select" required>
                                <option value="">Select Position</option>
                                <?php
                                $positions = ['GK' => 'Goalkeeper', 'CB' => 'Center Back', 'LB' => 'Left Back', 
                                            'RB' => 'Right Back', 'CDM' => 'Defensive Midfielder', 
                                            'CM' => 'Center Midfielder', 'LW' => 'Left Wing', 
                                            'RW' => 'Right Wing', 'ST' => 'Striker'];
                                foreach($positions as $value => $label):
                                    $selected = ($editPlayer && $editPlayer['position'] == $value) ? 'selected' : '';
                                ?>
                                    <option value="<?= $value ?>" <?= $selected ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="number" name="rating" class="form-control" placeholder="Rating" required 
                                       min="1" max="99" value="<?= $editPlayer ? $editPlayer['rating'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" name="player_id" class="form-control" placeholder="Player ID" required
                                       value="<?= $editPlayer ? $editPlayer['player_id'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="number" name="shooting" class="form-control" placeholder="Shooting" min="1" max="99"
                                       value="<?= $editPlayer ? $editPlayer['shooting'] : '' ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="number" name="pace" class="form-control" placeholder="Pace" min="1" max="99"
                                       value="<?= $editPlayer ? $editPlayer['pace'] : '' ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="number" name="dribbling" class="form-control" placeholder="Dribbling" min="1" max="99"
                                       value="<?= $editPlayer ? $editPlayer['dribbling'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="number" name="defending" class="form-control" placeholder="Defending" min="1" max="99"
                                       value="<?= $editPlayer ? $editPlayer['defending'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" name="physical" class="form-control" placeholder="Physical" min="1" max="99"
                                       value="<?= $editPlayer ? $editPlayer['physical'] : '' ?>">
                            </div>
                        </div>
                        <?php if($editPlayer): ?>
                            <button type="submit" name="update" class="btn btn-primary w-100">Update Player</button>
                        <?php else: ?>
                            <button type="submit" name="add" class="btn btn-primary w-100">Add Player</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Players List</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Club</th>
                                    <th>Position</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($players as $player): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($player['name']) ?></td>
                                        <td><?= htmlspecialchars($player['club']) ?></td>
                                        <td><?= htmlspecialchars($player['position']) ?></td>
                                        <td><?= htmlspecialchars($player['rating']) ?></td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $player['id'] ?>">
                                                <button type="submit" name="edit" class="btn btn-primary btn-sm">Edit</button>
                                                <button type="submit" name="delete" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Player</title>
</head>
<body>
    <h1>Create New Player</h1>
    <form action="../controllers/PlayerController.php?action=create" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="nationality">Nationality:</label>
        <input type="text" id="nationality" name="nationality" required><br>

        <label for="club">Club:</label>
        <input type="text" id="club" name="club" required><br>

        <label for="position">Position:</label>
        <select id="position" name="position" required>
            <option value="GK">GK</option>
            <option value="CM">CM</option>
            <option value="CB">CB</option>
            <option value="LB">LB</option>
            <option value="RB">RB</option>
            <option value="LW">LW</option>
            <option value="CDM">CDM</option>
            <option value="ST">ST</option>
            <option value="RW">RW</option>
        </select><br>

        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="100" required><br>

        <label for="player_id">Player ID:</label>
        <input type="number" id="player_id" name="player_id" required><br>

        <label for="shooting">Shooting:</label>
        <input type="number" id="shooting" name="shooting" min="0" max="100"><br>

        <label for="pace">Pace:</label>
        <input type="number" id="pace" name="pace" min="0" max="100"><br>

        <label for="dribbling">Dribbling:</label>
        <input type="number" id="dribbling" name="dribbling" min="0" max="100"><br>

        <label for="defending">Defending:</label>
        <input type="number" id="defending" name="defending" min="0" max="100"><br>

        <label for="physical">Physical:</label>
        <input type="number" id="physical" name="physical" min="0" max="100"><br>

        <input type="submit" value="Create Player">
    </form>
</body>
</html>
<?php
class Database {
    private $mysqli;
    private $config = [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'players'
    ];

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->mysqli = mysqli_connect(
            $this->config['host'],
            $this->config['user'],
            $this->config['pass'],
            $this->config['name']
        );

        if (!$this->mysqli) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->mysqli, 'utf8mb4');
    }

    public function insertPlayer($data) {
        $sql = "INSERT INTO player (name, nationality, club, position, rating, player_id, 
                shooting, pace, dribbling, defending, physical) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
        $stmt = $this->prepare($sql);
        mysqli_stmt_bind_param($stmt, 'ssssiiiiiii',
            $data['name'],
            $data['nationality'],
            $data['club'],
            $data['position'],
            $data['rating'],
            $data['player_id'],
            $data['shooting'],
            $data['pace'],
            $data['dribbling'],
            $data['defending'],
            $data['physical']
        );
        return $this->execute($stmt);
    }

    public function updatePlayer($data, $id) {
        $sql = "UPDATE player SET name=?, nationality=?, club=?, position=?, rating=?, 
                player_id=?, shooting=?, pace=?, dribbling=?, defending=?, physical=? 
                WHERE id=?";
                
        $stmt = $this->prepare($sql);
        mysqli_stmt_bind_param($stmt, 'ssssiiiiiiii',
            $data['name'],
            $data['nationality'],
            $data['club'],
            $data['position'],
            $data['rating'],
            $data['player_id'],
            $data['shooting'],
            $data['pace'],
            $data['dribbling'],
            $data['defending'],
            $data['physical'],
            $id
        );
        return $this->execute($stmt);
    }

    public function getPlayer($id) {
        $sql = "SELECT * FROM player WHERE id = ?";
        $stmt = $this->prepare($sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function deletePlayer($id) {
        $sql = "DELETE FROM player WHERE id = ?";
        $stmt = $this->prepare($sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return $this->execute($stmt);
    }

    public function getAllPlayers() {
        return $this->select("player");
    }

    private function select($table, $columns = "*", $where = null) {
        $sql = "SELECT $columns FROM $table";
        if ($where) $sql .= " WHERE $where";
        
        $stmt = $this->prepare($sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    private function prepare($sql) {
        $stmt = mysqli_prepare($this->mysqli, $sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . mysqli_error($this->mysqli));
        }
        return $stmt;
    }

    private function execute($stmt) {
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function __destruct() {
        if ($this->mysqli) {
            mysqli_close($this->mysqli);
        }
    }
}

class PlayerManager {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addPlayer($data) {
        return $this->db->insertPlayer($data);
    }

    public function updatePlayer($data, $id) {
        return $this->db->updatePlayer($data, $id);
    }

    public function deletePlayer($id) {
        return $this->db->deletePlayer($id);
    }

    public function getPlayer($id) {
        return $this->db->getPlayer($id);
    }

    public function getAllPlayers() {
        $result = $this->db->getAllPlayers();
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>
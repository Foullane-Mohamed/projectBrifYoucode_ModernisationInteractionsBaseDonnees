<?php
class Database {
    private $pdo;
    private $config = [
        'host' => 'localhost',
        'dbname' => 'players',
        'user' => 'root',
        'pass' => ''
    ];

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->config['user'], $this->config['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch(PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function insertPlayer($data) {
        $sql = "INSERT INTO player (name, nationality, club, position, rating, player_id, 
                shooting, pace, dribbling, defending, physical) 
                VALUES (:name, :nationality, :club, :position, :rating, :player_id, 
                :shooting, :pace, :dribbling, :defending, :physical)";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $params = [
                ':name' => $data['name'],
                ':nationality' => $data['nationality'],
                ':club' => $data['club'],
                ':position' => $data['position'],
                ':rating' => $data['rating'],
                ':player_id' => $data['player_id'],
                ':shooting' => $data['shooting'],
                ':pace' => $data['pace'],
                ':dribbling' => $data['dribbling'],
                ':defending' => $data['defending'],
                ':physical' => $data['physical']
            ];
            return $stmt->execute($params);
        } catch(PDOException $e) {
            throw new Exception("Insert failed: " . $e->getMessage());
        }
    }

    public function updatePlayer($data, $id) {
        $sql = "UPDATE player SET name=:name, nationality=:nationality, club=:club, 
                position=:position, rating=:rating, player_id=:player_id, 
                shooting=:shooting, pace=:pace, dribbling=:dribbling, 
                defending=:defending, physical=:physical WHERE id=:id";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $params = [
                ':name' => $data['name'],
                ':nationality' => $data['nationality'],
                ':club' => $data['club'],
                ':position' => $data['position'],
                ':rating' => $data['rating'],
                ':player_id' => $data['player_id'],
                ':shooting' => $data['shooting'],
                ':pace' => $data['pace'],
                ':dribbling' => $data['dribbling'],
                ':defending' => $data['defending'],
                ':physical' => $data['physical'],
                ':id' => $id
            ];
            return $stmt->execute($params);
        } catch(PDOException $e) {
            throw new Exception("Update failed: " . $e->getMessage());
        }
    }

    public function getPlayer($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM player WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch(PDOException $e) {
            throw new Exception("Select failed: " . $e->getMessage());
        }
    }

    public function deletePlayer($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM player WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch(PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }

    public function getAllPlayers() {
        try {
            return $this->pdo->query("SELECT * FROM player")->fetchAll();
        } catch(PDOException $e) {
            throw new Exception("Select all failed: " . $e->getMessage());
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
        return $this->db->getAllPlayers();
    }
}
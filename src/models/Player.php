<?php

class Player {
    private $conn;
    private $table_name = "players";

    public $id;
    public $name;
    public $nationality;
    public $club;
    public $position;
    public $rating;
    public $player_id;
    public $shooting;
    public $pace;
    public $dribbling;
    public $defending;
    public $physical;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createPlayer() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name=:name, nationality=:nationality, club=:club, 
                      position=:position, rating=:rating, player_id=:player_id, 
                      shooting=:shooting, pace=:pace, dribbling=:dribbling, 
                      defending=:defending, physical=:physical";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":nationality", $this->nationality);
        $stmt->bindParam(":club", $this->club);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":player_id", $this->player_id);
        $stmt->bindParam(":shooting", $this->shooting);
        $stmt->bindParam(":pace", $this->pace);
        $stmt->bindParam(":dribbling", $this->dribbling);
        $stmt->bindParam(":defending", $this->defending);
        $stmt->bindParam(":physical", $this->physical);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readPlayers() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function updatePlayer() {
        $query = "UPDATE " . $this->table_name . " 
                  SET name=:name, nationality=:nationality, club=:club, 
                      position=:position, rating=:rating, shooting=:shooting, 
                      pace=:pace, dribbling=:dribbling, defending=:defending, 
                      physical=:physical 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":nationality", $this->nationality);
        $stmt->bindParam(":club", $this->club);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":shooting", $this->shooting);
        $stmt->bindParam(":pace", $this->pace);
        $stmt->bindParam(":dribbling", $this->dribbling);
        $stmt->bindParam(":defending", $this->defending);
        $stmt->bindParam(":physical", $this->physical);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deletePlayer() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
<?php

require_once '../models/Player.php';

class PlayerController {
    private $playerModel;

    public function __construct() {
        $this->playerModel = new Player();
    }

    public function createPlayer($data) {
        return $this->playerModel->create($data);
    }

    public function readPlayers() {
        return $this->playerModel->read();
    }

    public function updatePlayer($id, $data) {
        return $this->playerModel->update($id, $data);
    }

    public function deletePlayer($id) {
        return $this->playerModel->delete($id);
    }
}
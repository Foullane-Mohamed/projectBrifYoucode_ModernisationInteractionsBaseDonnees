CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nationality VARCHAR(255) NOT NULL,
    club VARCHAR(255) NOT NULL,
    position ENUM(
        'GK',
        'CM',
        'CB',
        'LB',
        'RB',
        'LW',
        'CDM',
        'ST',
        'RW'
    ) NOT NULL,
    rating TINYINT UNSIGNED NOT NULL,
    player_id INT NOT NULL,
    shooting TINYINT UNSIGNED,
    pace TINYINT UNSIGNED,
    dribbling TINYINT UNSIGNED,
    defending TINYINT UNSIGNED,
    physical TINYINT UNSIGNED,
);
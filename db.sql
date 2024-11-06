CREATE DATABASE event_calendar;
USE event_calendar;

CREATE TABLE Sports (
    sport_id INT AUTO_INCREMENT PRIMARY KEY,
    sport_name VARCHAR(100) NOT NULL
);

CREATE TABLE Location (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    location_name VARCHAR(100) NOT NULL,
    address VARCHAR(255)
);

CREATE TABLE Teams (
    team_id INT AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
    team_info VARCHAR(255)
);

CREATE TABLE Events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    event_description VARCHAR(255),
    sport_fk INT NOT NULL,
    location_fk INT,
    CONSTRAINT fk_sport FOREIGN KEY (sport_fk) REFERENCES Sports(sport_id) ON DELETE CASCADE,
    CONSTRAINT fk_location FOREIGN KEY (location_fk) REFERENCES Location(location_id) ON DELETE SET NULL
);

CREATE TABLE Event_Teams (
    event_id INT NOT NULL,
    team_id INT NOT NULL,
    PRIMARY KEY (event_id, team_id),
    CONSTRAINT fk_event FOREIGN KEY (event_id) REFERENCES Events(event_id) ON DELETE CASCADE,
    CONSTRAINT fk_team FOREIGN KEY (team_id) REFERENCES Teams(team_id) ON DELETE CASCADE
);

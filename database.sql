-- Création de la base de données
CREATE DATABASE IF NOT EXISTS reseau_social_univ;
USE reseau_social_univ;

-- Table des filières
CREATE TABLE filieres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des utilisateurs
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    filiere_id INT,
    profile_pic VARCHAR(255),
    bio TEXT,
    role ENUM('etudiant', 'professeur', 'admin') DEFAULT 'etudiant',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE SET NULL
);

-- Table des posts
CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX (created_at)
);

-- Table des commentaires
CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table des likes
CREATE TABLE likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_like (post_id, user_id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insertion des filières d'exemple
INSERT INTO filieres (nom, description) VALUES
('Informatique', 'Programmes et développement logiciel'),
('Génie Civil', 'Construction et infrastructure'),
('Biologie', 'Sciences biologiques et santé'),
('Chimie', 'Sciences chimiques'),
('Physique', 'Sciences physiques');

-- Insertion des utilisateurs d'exemple (mot de passe: password123)
INSERT INTO users (username, email, password, filiere_id, role) VALUES
('alice', 'alice@university.edu', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/TVm', 1, 'etudiant'),
('bob', 'bob@university.edu', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/TVm', 2, 'etudiant'),
('carol', 'carol@university.edu', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/TVm', 3, 'etudiant');

-- Insertion de posts d'exemple
INSERT INTO posts (user_id, content) VALUES
(1, 'Salut ! Je suis nouvelle à l\'université et j\'adore l\'informatique ! 🎓'),
(2, 'Quelqu\'un a des notes du dernier cours de génie civil ?'),
(3, 'La biologie c\'est passionnant ! Qui veut former un groupe d\'\u00e9tude ?');

-- Insertion de likes d'exemple
INSERT INTO likes (post_id, user_id) VALUES
(1, 2),
(1, 3),
(2, 1),
(3, 1),
(3, 2);
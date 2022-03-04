DROP DATABASE IF EXISTS cda_projet_project_hive;
CREATE DATABASE cda_projet_project_hive CHARACTER SET utf8;
USE cda_projet_project_hive;

CREATE TABLE user (
    userId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR (255) NOT NULL UNIQUE,
    username VARCHAR (255) NOT NULL,
    password VARCHAR (255) NOT NULL,
    role VARCHAR (255) NOT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE background (
    backgroundId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    imageUrl VARCHAR (255) NOT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE board (
    boardId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    color VARCHAR (255),
    background_id INT,
    owner_id INT NOT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (owner_id) REFERENCES user(userId),
    FOREIGN KEY (background_id) REFERENCES background(backgroundId)
);

CREATE TABLE user_board (
    user_boardId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    board_id INT NOT NULL,
    user_id INT NOT NULL,
    userRole VARCHAR (255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(userId),
    FOREIGN KEY (board_id) REFERENCES board(boardId)
);

CREATE TABLE liste (
    listeId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    orderNb INT NOT NULL,
    board_id INT NOT NULL,
    posLeft FLOAT NOT NULL,
    posTop FLOAT NOT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (board_id) REFERENCES board(boardId)
);

CREATE TABLE card (
    cardId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    content VARCHAR (255) NOT NULL,
    orderNb INT NOT NULL,
    color VARCHAR (255),
    liste_id INT NOT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (liste_id) REFERENCES liste(listeId)
);

INSERT INTO background (`imageUrl`, `createdAt`, `updatedAt`) VALUES
("https://cdn.pixabay.com/photo/2015/11/12/05/49/abstract-1039702_960_720.jpg", '2021-12-01 14:31:25', '2021-12-01 14:31:25'),
("https://cdn.pixabay.com/photo/2022/02/24/08/35/background-7032001_960_720.jpg", '2021-12-01 14:31:25', '2021-12-01 14:31:25'),
("https://cdn.pixabay.com/photo/2022/02/24/08/35/background-7032000_960_720.jpg", '2021-12-01 14:31:25', '2021-12-01 14:31:25'),
("https://cdn.pixabay.com/photo/2022/02/24/08/36/background-7032009_960_720.jpg", '2021-12-01 14:31:25', '2021-12-01 14:31:25'),
("https://cdn.pixabay.com/photo/2021/07/07/10/04/background-6393927_960_720.jpg", '2021-12-01 14:31:25', '2021-12-01 14:31:25'),
("https://cdn.pixabay.com/photo/2022/02/24/08/36/background-7032008_960_720.jpg", '2021-12-01 14:31:25', '2021-12-01 14:31:25');
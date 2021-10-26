DROP DATABASE IF EXISTS cda_projet_trello_like;
CREATE DATABASE cda_projet_trello_like CHARACTER SET utf8;
USE cda_projet_trello_like;

CREATE TABLE user (
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR (255) NOT NULL UNIQUE,
    username VARCHAR (255) NOT NULL,
    password VARCHAR (255) NOT NULL,
    role VARCHAR (255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE board (
    board_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    color VARCHAR (255),
    owner_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (owner_id) REFERENCES user(user_id)
);

CREATE TABLE user_board (
    user_board_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    board_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(user_id),
    FOREIGN KEY (board_id) REFERENCES board(board_id)
);

CREATE TABLE list (
    list_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    color VARCHAR (255),
    order_nb INT NOT NULL,
    board_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (board_id) REFERENCES board(board_id)
);

CREATE TABLE card (
    card_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    content VARCHAR (255) NOT NULL,
    order_nb INT NOT NULL,
    list_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (list_id) REFERENCES list(list_id)
);
# SQL FILE COMPARED #
# DO NOT REPRODUCE #
# FILE CREATED AUGUST 30 2015 #
# DEVELOPER ON THE PROJECT : DANY RAFINA #
# VERSION OF COMPARED WEBSITE WHEN SCRIPT WAS CREATED :  0.20 #

DROP TABLE IF EXISTS POST;
CREATE TABLE IF NOT EXISTS POST (
    idPost int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(200) NOT NULL,
    shortDesc varchar(200) DEFAULT NULL,
    longDesc text DEFAULT NULL,
    content text NOT NULL,
    creationDate DATETIME NOT NULL,
    coverPhoto varchar(100) NOT NULL,
    modifiedDate DATETIME DEFAULT NULL,
    postStatus varchar(20) NOT NULL,
    idUser int NOT NULL
);

DROP TABLE IF EXISTS P_SCORE;
CREATE TABLE IF NOT EXISTS P_SCORE (
    idScore int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    scoreValue decimal(4,2) NOT NULL,
    creationDateTime timestamp NOT NULL,
    idPost int(6) NOT NULL
);

DROP TABLE IF EXISTS CATEGORY;
CREATE TABLE IF NOT EXISTS CATEGORY (
    idCategory int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name varchar(200) NOT NULL,
    description varchar(255) NOT NULL ,
    creationDate DATETIME NOT NULL
);

DROP TABLE IF EXISTS P_COMMENT;
CREATE TABLE IF NOT EXISTS P_COMMENT (
    idPComment int NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
    author varchar(200) NOT NULL,
    creationDate DATETIME NOT NULL,
    status char(2) NOT NULL,
    idPost int(6) NOT NULL,
    idParentPC int NOT NULL
);

DROP TABLE IF EXISTS C_SCORE;
CREATE TABLE IF NOT EXISTS C_SCORE (
    idCScore int NOT NULL  AUTO_INCREMENT PRIMARY KEY,
    scoreValue decimal(4,2) NOT NULL,
    creationDateTime timestamp NOT NULL,
    idCOMPARED int NOT NULL

);

DROP TABLE IF EXISTS C_COMMENT;
CREATE TABLE IF NOT EXISTS C_COMMENT(
    idCComment int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    author varchar(200) NOT NULL,
    creationDate DATETIME NOT NULL,
    status char(2) NOT NULL,
    idCOMPARED int NOT NULL,
    idParentCC int NOT NULL
);

DROP TABLE IF EXISTS S_SCORE;
CREATE TABLE IF NOT EXISTS S_SCORE (
    idSScore int NOT NULL PRIMARY KEY,
    scoreValue decimal(4,2) NOT NULL,
    creationDateTime timestamp NOT NULL,
    idS int NOT NULL
);

DROP TABLE IF EXISTS S_COMMENT;
CREATE TABLE IF NOT EXISTS S_COMMENT(
    idSComment int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    author varchar(200) NOT NULL,
    creationDate DATETIME NOT NULL,
    status char(2) NOT NULL,
    idS int NOT NULL,
    idParentSC int NOT NULL
);

# CONSTRAINT FOREIGN KEY #

ALTER TABLE POST ADD CONSTRAINT FOREIGN KEY fk_idUser(idUser) REFERENCES User(idU);
ALTER TABLE P_SCORE ADD CONSTRAINT FOREIGN KEY fk_idPost_PS(idPost) REFERENCES POST(idPost);
ALTER TABLE P_COMMENT ADD CONSTRAINT FOREIGN KEY fk_idPost_PC(idPost) REFERENCES POST(idPost);
ALTER TABLE P_COMMENT ADD CONSTRAINT FOREIGN KEY fk_idComment_PC(idParentPC) REFERENCES P_COMMENT(idPComment);
ALTER TABLE C_SCORE ADD CONSTRAINT FOREIGN KEY fk_idCompared_CS(idCOMPARED) REFERENCES COMPARED(idCOMPARED);
ALTER TABLE C_COMMENT ADD CONSTRAINT FOREIGN KEY fk_idCompared_CC(idCOMPARED) REFERENCES COMPARED(idCOMPARED);
ALTER TABLE C_COMMENT ADD CONSTRAINT FOREIGN KEY fk_idComment_CC(idParentCC) REFERENCES C_COMMENT(idCComment);
ALTER TABLE S_SCORE ADD CONSTRAINT FOREIGN KEY fk_idS_SS(idS) REFERENCES Smartphone(idS);
ALTER TABLE S_COMMENT ADD CONSTRAINT FOREIGN KEY fk_idS_SC(idS) REFERENCES Smartphone(idS);
ALTER TABLE S_COMMENT ADD CONSTRAINT FOREIGN KEY fk_idComment_SC(idParentSC) REFERENCES S_COMMENT(idSComment);
# SCRIPT FINISH #
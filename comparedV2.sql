#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
DROP DATABASE IF EXISTS compared;
CREATE DATABASE IF NOT EXISTS compared;

use compared;

CREATE TABLE UserType(
        idUT   int Auto_increment NOT NULL ,
        nameUT Varchar (50) ,
        PRIMARY KEY (idUT)
)ENGINE=InnoDB;


CREATE TABLE Smartphone(
        idS              int (11) Auto_increment  NOT NULL ,
        codeNameS        Varchar (50) NOT NULL ,
        fullNameS        Varchar (50) NOT NULL ,
        constructorS     Varchar (50) NOT NULL ,
        ramS             Float NOT NULL ,
        weightS          Float NOT NULL ,
        thinknessS       Float NOT NULL ,
        heightS          Float NOT NULL ,
        widthS           Float NOT NULL ,
        releaseDateS     Date NOT NULL ,
        priceS           Float ,
        photoFrontS      Float NOT NULL ,
        photoBackS       Float NOT NULL ,
        internalStorageS Varchar (50) NOT NULL ,
        externalStorageS Varchar (100) ,
        batteryCapacityS Int NOT NULL ,
        cNetworkS        Varchar (50) ,
        videoFrontS      Varchar (50) ,
        videoBackS       Varchar (50) ,
        pictureS         Varchar (100) NOT NULL ,
        idU              Int NOT NULL,
        idScr            Int NOT NULL ,
        idOS             Int NOT NULL ,
        idProc           Int NOT NULL ,
        PRIMARY KEY (idS )
)ENGINE=InnoDB;

CREATE TABLE COMPARED (
	idCOMPARED int(11) Auto_increment NOT NULL,
	idS1  int (11) NOT NULL ,
	idS2  int (11) NOT NULL ,
	PRIMARY KEY (idCOMPARED)
)ENGINE=InnoDB;

CREATE TABLE Avis (
	idA int(11) Auto_increment NOT NULL,
	nomInter  varchar(50) NOT NULL ,
	content  varchar(200) NOT NULL ,
	PRIMARY KEY (idA)
)ENGINE=InnoDB;
CREATE TABLE User(
        idU        int (11) Auto_increment  NOT NULL ,
        pseudoU    Varchar (50) NOT NULL ,
        passwordU  Varchar (50) NOT NULL ,
        firstNameU Varchar (100) NOT NULL ,
        lastNameU   Varchar (100) NOT NULL ,
        emailU     Varchar (50) NOT NULL ,
        pictureU   Varchar (100) ,
        idUT       int NOT NULL ,
        PRIMARY KEY (idU ) ,
        UNIQUE (pseudoU ,passwordU )
)ENGINE=InnoDB;


CREATE TABLE Processor(
        idProc          int (11) Auto_increment  NOT NULL ,
        nameProc        Varchar (50) NOT NULL ,
        constructorProc Varchar (50) NOT NULL ,
        nbCoreProc      Int NOT NULL ,
        archProc        Int NOT NULL ,
        versionProc     Varchar (25) NOT NULL ,
        frenquecyProc   Float NOT NULL ,
        PRIMARY KEY (idProc )
)ENGINE=InnoDB;


CREATE TABLE Screen(
        idScr         int (11) Auto_increment  NOT NULL ,
        typeScr       Varchar (50) NOT NULL ,
        resolutionScr Varchar (50) NOT NULL ,
        densityScr    Int NOT NULL ,
        sizeSrc       Float NOT NULL ,
        capacityScr   Varchar (50) NOT NULL ,
        PRIMARY KEY (idScr )
)ENGINE=InnoDB;


CREATE TABLE OS(
        idOS          int (11) Auto_increment  NOT NULL ,
        nameOS        Varchar (50) NOT NULL ,
        versionOS     Varchar (20) NOT NULL ,
        constructorOS Varchar (50) NOT NULL ,
        releaseDateOS Date NOT NULL ,
        PRIMARY KEY (idOS )
)ENGINE=InnoDB;

ALTER TABLE Smartphone ADD CONSTRAINT FK_Smartphone_idU FOREIGN KEY (idU) REFERENCES User(idU);
ALTER TABLE Smartphone ADD CONSTRAINT FK_Smartphone_idScr FOREIGN KEY (idScr) REFERENCES Screen(idScr);
ALTER TABLE Smartphone ADD CONSTRAINT FK_Smartphone_idOS FOREIGN KEY (idOS) REFERENCES OS(idOS);
ALTER TABLE Smartphone ADD CONSTRAINT FK_Smartphone_idProc FOREIGN KEY (idProc) REFERENCES Processor(idProc);
ALTER TABLE User ADD CONSTRAINT FK_User_idUT FOREIGN KEY (idUT) REFERENCES UserType(idUT);
ALTER TABLE COMPARED ADD CONSTRAINT FK_sm1 FOREIGN KEY (idS1) REFERENCES Smartphone(idS);
ALTER TABLE COMPARED ADD CONSTRAINT FK_sm2 FOREIGN KEY (idS2) REFERENCES Smartphone(idS);

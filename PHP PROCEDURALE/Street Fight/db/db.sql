#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: GAME
#------------------------------------------------------------

CREATE TABLE GAME(
        ID           int (11) Auto_increment  NOT NULL ,
        date_created Date NOT NULL ,
        PRIMARY KEY (ID )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: PERSO
#------------------------------------------------------------

CREATE TABLE PERSO(
        ID      int (11) Auto_increment  NOT NULL ,
        name    Varchar (25) NOT NULL ,
        status  Int NOT NULL ,
        ID_GAME Int NOT NULL ,
        PRIMARY KEY (ID )
)ENGINE=InnoDB;

ALTER TABLE PERSO ADD CONSTRAINT FK_PERSO_ID_GAME FOREIGN KEY (ID_GAME) REFERENCES GAME(ID);

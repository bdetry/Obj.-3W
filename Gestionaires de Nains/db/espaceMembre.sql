#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: USER
#------------------------------------------------------------

CREATE TABLE USER(
        user_id   int (11) Auto_increment  NOT NULL ,
        user_mail Varchar (50) NOT NULL ,
        user_pass Varchar (50) NOT NULL ,
        role_id   Int NOT NULL ,
        PRIMARY KEY (user_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ROLE
#------------------------------------------------------------

CREATE TABLE ROLE(
        role_id      int (11) Auto_increment  NOT NULL ,
        role_libelle Varchar (50) NOT NULL ,
        PRIMARY KEY (role_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AUTORISATION
#------------------------------------------------------------

CREATE TABLE AUTORISATION(
        aut_id      int (11) Auto_increment  NOT NULL ,
        aut_libelle Varchar (50) NOT NULL ,
        PRIMARY KEY (aut_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: role_est_autori
#------------------------------------------------------------

CREATE TABLE role_est_autori(
        role_est_autori_date Date NOT NULL ,
        role_id              Int NOT NULL ,
        aut_id               Int NOT NULL ,
        PRIMARY KEY (role_id ,aut_id )
)ENGINE=InnoDB;

ALTER TABLE USER ADD CONSTRAINT FK_USER_role_id FOREIGN KEY (role_id) REFERENCES ROLE(role_id);
ALTER TABLE role_est_autori ADD CONSTRAINT FK_role_est_autori_role_id FOREIGN KEY (role_id) REFERENCES ROLE(role_id);
ALTER TABLE role_est_autori ADD CONSTRAINT FK_role_est_autori_aut_id FOREIGN KEY (aut_id) REFERENCES AUTORISATION(aut_id);

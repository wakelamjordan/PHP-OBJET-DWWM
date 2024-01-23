------------Creation de la table user-----
create table user (id int auto_increment primary key,
username varchar(100) not null unique,
email varchar(100),
password varchar(200) not null,
dateCreation datetime default now(),
dateModification datetime default now(),
dateDerniereConnexion datetime,
roles json
);


----insertion de données

insert into user (username,password,email,roles) values  
('jpboto',sha1('1234'),'jpboto@localhost.com','["ROLE_ADMIN","ROLE_ASSISTANT","ROLE_DEV","ROLE_USER"]'),
('paul',sha1('1234'),'paul@localhost.com','["ROLE_ASSISTANT","ROLE_DEV","ROLE_USER"]'),
('marie',sha1('1234'),'marie@localhost.com','["ROLE_DEV","ROLE_USER"]');

insert into user (username,password,email,roles) values  
('admin',sha1('1234'),'admin@localhost.com','["ROLE_ADMIN","ROLE_ASSISTANT","ROLE_DEV","ROLE_USER"]');

MariaDB [dwwm]> select * from user;
+----+----------+----------------------+------------------------------------------+---------------------+---------------------+-----------------------+--------------------------------------------------------+
| id | username | email                | password                                 | dateCreation        | dateModification    | dateDerniereConnexion | roles
                                 |
+----+----------+----------------------+------------------------------------------+---------------------+---------------------+-----------------------+--------------------------------------------------------+
|  1 | jpboto   | jpboto@localhost.com | 7110eda4d09e062aa5e4a390b0a572ac0d2c0220 | 2024-01-18 09:17:39 | 2024-01-18 09:17:39 | NULL                  | ["ROLE_ADMIN","ROLE_ASSISTANT","ROLE_DEV","ROLE_USER"] |
|  2 | paul     | paul@localhost.com   | 7110eda4d09e062aa5e4a390b0a572ac0d2c0220 | 2024-01-18 09:17:39 | 2024-01-18 09:17:39 | NULL                  | ["ROLE_ASSISTANT","ROLE_DEV","ROLE_USER"]              |
|  3 | marie    | marie@localhost.com  | 7110eda4d09e062aa5e4a390b0a572ac0d2c0220 | 2024-01-18 09:17:39 | 2024-01-18 09:17:39 | NULL                  | ["ROLE_DEV","ROLE_USER"]                               |
|  4 | admin    | admin@localhost.com  | 7110eda4d09e062aa5e4a390b0a572ac0d2c0220 | 2024-01-18 09:21:54 | 2024-01-18 09:21:54 | NULL                  | ["ROLE_ADMIN","ROLE_ASSISTANT","ROLE_DEV","ROLE_USER"] |
+----+----------+----------------------+------------------------------------------+---------------------+---------------------+-----------------------+--------------------------------------------------------+
4 rows in set (0.00

-----Creation table role---
create table role (id int auto_increment primary key,rang varchar(20), libelle varchar(200));


---insertion de données dans lat table role --
insert into role (rang,libelle) values 
('001','ROLE_ADMIN'),
('002','ROLE_ASSISTANT'),
('003','ROLE_DEV'),
('004','ROLE_USER');

insert into role (rang,libelle) values 
('003','ROLE_DEPOT'),
('003','ROLE_CAISSE');

MariaDB [dwwm]> select * from role;
+----+------+----------------+
| id | rang | libelle        |
+----+------+----------------+
|  1 | 001  | ROLE_ADMIN     |
|  2 | 002  | ROLE_ASSISTANT |
|  3 | 003  | ROLE_DEV       |
|  4 | 004  | ROLE_USER      |
+----+------+----------------+



create database IntelligenceA;
use IntelligenceA;

drop database IntelligenceA;

create table Admin
(
	idAdmin int not null auto_increment primary key,
	Email VARCHAR(50),
	MotDePasse VARCHAR(50)
);


insert into Admin values(1,"Rakoto@gmail.com",sha1(1234));

/* si besoin
create table Users
(
	idUser int not null auto_increment primary key,
	nom VARCHAR(50),
	Email VARCHAR(50),
	MotDePasse VARCHAR(50)
);

insert into Admin values(1,"Rabe","Rabe@gmail.com",sha1(123456));

*/
create table Information
(
	idInfo int not null auto_increment primary key,
	Auteur VARCHAR(50),
	titre VARCHAR(50),
	Description VARCHAR(250),
	Detail VARCHAR(550)
);























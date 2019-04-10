drop database if exists volonteri;
create database volonteri;

use volonteri;

create table osoba(
sifra int not null primary key auto_increment,
oib char(11) not null,
ime varchar(30) not null,
prezime varchar(30) not null,
dob int not null,
email varchar(30),
lozinka char(32) not null,
adresa varchar(30),
skola varchar(30),
mobitel varchar(30),
uloga varchar (20),
akcija int,
volonterski_sati int,
volonterski_ugovor int not null,
edukacija int,
aktivan boolean not null default false
);

create table akcija(
sifra int not null primary key auto_increment,
ime_akcije varchar(200) not null,
opis_akcije varchar(500),
datum varchar(50),
trajanje varchar(50),
mjesto varchar(50)
);

create table akcija_osoba(
akcija int not null,
osoba int not null
);

create table edukacija (
sifra int not null primary key,
ime_edukacije varchar(100),
opis varchar(500),
datum_polaganja datetime,
mjesto varchar(50),
drzava varchar(50),
vrsta varchar(50)
);

create table edukacija_osoba(
edukacija int not null,
osoba int not null
);

alter table akcija_osoba add foreign key (akcija) references akcija(sifra);
alter table akcija_osoba add foreign key (osoba) references osoba(sifra);
alter table edukacija_osoba add foreign key (edukacija) references edukacija(sifra);
alter table edukacija_osoba add foreign key (osoba) references osoba(sifra);

insert into osoba  (email,lozinka,ime,prezime,uloga,aktivan,oib,dob,volonterski_ugovor) values 
('iva@edunova.hr', md5('e'),'Iva','Vrebac','oper',true,12345678912,31,1234),
('edunova@edunova.hr', md5('e'),'Eduard','Kuzma','volonter',true,12344321912,31,23145),
('edunova1@edunova.hr', md5('e'),'Eduard1','Kuzma','volonter',true,12344321913,31,23147),
('edunova2@edunova.hr', md5('e'),'Eduard2','Kuzma','volonter',true,12344321914,31,23148),
('edunova3@edunova.hr', md5('e'),'Eduard3','Kuzma','volonter',true,12344321915,31,23149),
('edunova4@edunova.hr', md5('e'),'Eduard4','Kuzma','volonter',true,12344321916,31,23199),
('edunova5@edunova.hr', md5('e'),'Eduard5','Kuzma','volonter',true,12344321917,31,23188),
('edunova6@edunova.hr', md5('e'),'Eduard6','Kuzma','volonter',true,12344321918,31,23177),
('edunova7@edunova.hr', md5('e'),'Eduard7','Kuzma','volonter',true,12344321919,31,23166),
('zvonimir@edunova.hr', md5('e'),'Zvonimir','Grizelj','admin',true,43214321432,31,4321);

insert into osoba  (email,lozinka,ime,prezime,uloga,aktivan,oib,dob,volonterski_ugovor,skola,adresa,mobitel) values 
('markomarkovic@edunova.hr', md5('e'),'Marko','Markovic','volonter',true,12345678123,31,1243,'OS Vladimira Nazora','Vladimira Nazora 4','0911234123');
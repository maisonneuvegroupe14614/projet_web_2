CREATE TABLE Utilisateur(
id           bigint      not null auto_increment,
courriel     varchar(40) not null,
motPasse     char   (60) not null,
nom          varchar(30) not null,
prenom       varchar(30) not null,
statut       varchar(10) not null,
ville        varchar(30),
province     varchar(30),
pays         varchar(30),
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
PRIMARY KEY(id),
UNIQUE INDEX(courriel)
);
INSERT INTO Utilisateur VALUES
( 1,"martine@hotmail.com"  ,MD5("xxxxx"),"Bouchard","Martine"  ,"tuteur"  ,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 2,"guy@hotmail.com"      ,MD5("xxxxx"),"Roy"     ,"Guy"      ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 3,"sebastien@hotmail.com",MD5("xxxxx"),"Roy"     ,"Sébastien","etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 4,"helene@hotmail.com"   ,MD5("xxxxx"),"Mercier" ,"Hélène"   ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 5,"gisele@hotmail.com"   ,MD5("xxxxx"),"Allard"  ,"Gisèle"   ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 6,"gilles@hotmail.com"   ,MD5("xxxxx"),"Bouchard","Gilles"   ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 7,"lyne@hotmail.com"     ,MD5("xxxxx"),"Bouchard","Lyne"     ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 8,"stephane@hotmail.com" ,MD5("xxxxx"),"Morin"   ,"Stéphane" ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
( 9,"oceane@hotmail.com"   ,MD5("xxxxx"),"Morin"   ,"Océane"   ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
(10,"megane@hotmail.com"   ,MD5("xxxxx"),"Morin"   ,"Mégane"   ,"etudiant","Montréal","Québec","Canada",CURRENT_TIMESTAMP),
(11,"michael@hotmail.com"  ,MD5("xxxxx"),"Osman"   ,"Michael"  ,"tuteur"  ,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
(12,"rais@hotmail.com"     ,MD5("xxxxx"),"Boualem" ,"Rais"     ,"tuteur"  ,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
(13,"claude@hotmail.com"   ,MD5("xxxxx"),"Guénette","Claude"   ,"tuteur"  ,"Montréal","Québec","Canada",CURRENT_TIMESTAMP)
;
CREATE TABLE Ami(
idUtil bigint not null,
idAmi  bigint not null,
PRIMARY KEY(idUtil, idAmi),
FOREIGN KEY(idUtil) references Utilisateur(id),
FOREIGN KEY(idAmi)  references Utilisateur(id)
);
INSERT INTO Ami VALUES
( 1, 2),
( 1, 3),
( 1, 4),
( 1, 5),
( 1, 6),
( 1, 7),
( 1, 8),
( 1, 9),
( 1,10),
( 2, 4),
( 2, 6),
( 2, 8),
( 3, 2),
( 3, 5),
( 3, 7),
( 4, 3),
( 4, 6),
( 4, 7),
( 5, 7),
( 6, 8),
( 7, 9),
(10, 5),
(11, 1),
(11, 2),
(12, 3),
(13, 4)
;
CREATE TABLE Publication(
id           bigint      not null auto_increment,
categorie    varchar(20) not null,
texte        text,
url          varchar(50),
destinataire varchar(10) not null,
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
idUtil       bigint      not null,
PRIMARY KEY(id),
FOREIGN KEY(idUtil) references Utilisateur(id)
);
INSERT INTO Publication VALUES
(1,"tutorat","Tutorat CSS3"     ,"css3.mp4"      ,"amis"  ,CURRENT_TIMESTAMP, 1),
(2,"tutorat","Tutorat PHP5"     ,"php5.mp4"      ,"moi"   ,CURRENT_TIMESTAMP,11),
(3,"astuce" ,"Astuce jQuery"    ,"jquery.mp4"    ,"amis"  ,CURRENT_TIMESTAMP,12),
(4,"astuce" ,"Astuce JavaScript","javascript.mp4","public",CURRENT_TIMESTAMP,13)
;
CREATE TABLE Evaluation(
id            bigint    not null auto_increment,
texte         text,
note          int       not null,
dateCreation  timestamp not null default CURRENT_TIMESTAMP,
idPublication bigint    not null,
idUtil        bigint    not null,
PRIMARY KEY(id),
FOREIGN KEY(idPublication) references Publication(id),
FOREIGN KEY(idUtil)        references Utilisateur(id)
);
INSERT INTO Evaluation VALUES
(1,"Très bien expliqué",8,CURRENT_TIMESTAMP,1,2)
;
CREATE TABLE Partage(
id            bigint      not null auto_increment,
destinataire  varchar(10) not null,
dateCreation  timestamp   not null default CURRENT_TIMESTAMP,
idPublication bigint      not null,
idUtil        bigint      not null,
idAmi         bigint,
PRIMARY KEY(id),
FOREIGN KEY(idPublication) references Publication(id),
FOREIGN KEY(idUtil)        references Utilisateur(id),
FOREIGN KEY(idAmi)         references Utilisateur(id)
);
INSERT INTO Partage VALUES
(1,"amis",CURRENT_TIMESTAMP,1,2,null),
(2,"amis",CURRENT_TIMESTAMP,1,3,null)
;
CREATE TABLE Message(
id           bigint      not null auto_increment,
sujet        varchar(30) not null,
texte        text        not null,
url          varchar(50),
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
idUtil       bigint      not null,
idAmi        bigint      not null,
PRIMARY KEY(id),
FOREIGN KEY(idUtil) references Utilisateur(id),
FOREIGN KEY(idAmi)  references Utilisateur(id)
);
INSERT INTO Message VALUES
(1,"Tutorat CSS3","Super tutorat super clair","",CURRENT_TIMESTAMP,1,2)
;
SELECT IF(Util.id=2,CONCAT(Util.prenom," ",Util.nom), CONCAT(Uami.prenom," ",Uami.nom)) AS nomUtil,
       IF(Util.id=2,CONCAT(Uami.prenom," ",Uami.nom), CONCAT(Util.prenom," ",Util.nom)) AS nomAmi
FROM   Ami
JOIN   Utilisateur Util ON Util.id=Ami.idUtil
JOIN   Utilisateur Uami ON Uami.id=Ami.idAmi
WHERE  idUtil=2 OR idAmi=2
;
SELECT * FROM Ami
WHERE (idUtil=1 AND idAmi=2) OR (idUtil=2 AND idAmi=1)
;
SELECT id, Pub.idUtil AS idUtilPub,
           Ami.idUtil AS idUtil,
           Ami.idAmi  AS idAmi
FROM   Publication Pub
LEFT   JOIN Ami ON (Ami.idUtil=11 AND Ami.idAmi =Pub.idUtil)
                OR (Ami.idAmi =11 AND Ami.idUtil=Pub.idUtil)
WHERE destinataire="public" OR  Pub.idUtil=11
OR   (destinataire="amis"  AND (Ami.idUtil=11 OR Ami.idAmi=11))
;
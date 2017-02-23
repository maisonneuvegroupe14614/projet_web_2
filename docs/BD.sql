CREATE TABLE Statut(
id          int         not null auto_increment,
description varchar(20) not null,
PRIMARY KEY(id)
);
INSERT INTO Statut VALUES
(1,"Tuteur"),
(2,"Étudiant")
;
CREATE TABLE Utilisateur(
courriel     varchar(50) not null,
motPasse     char   (60) not null,
nom          varchar(50) not null,
prenom       varchar(50) not null,
idStatut     int         not null,
ville        varchar(50),
province     varchar(50),
pays         varchar(50),
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
PRIMARY KEY(courriel),
FOREIGN KEY(idStatut) references Statut(id)
);
INSERT INTO Utilisateur VALUES
("martine@hotmail.com"  ,MD5("xxxxx"),"Bouchard","Martine"  ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("guy@hotmail.com"      ,MD5("xxxxx"),"Roy"     ,"Guy"      ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("sebastien@hotmail.com",MD5("xxxxx"),"Roy"     ,"Sébastien",2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("helene@hotmail.com"   ,MD5("xxxxx"),"Mercier" ,"Hélène"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("gisele@hotmail.com"   ,MD5("xxxxx"),"Allard"  ,"Gisèle"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("gilles@hotmail.com"   ,MD5("xxxxx"),"Bouchard","Gilles"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("lyne@hotmail.com"     ,MD5("xxxxx"),"Bouchard","Lyne"     ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("stephane@hotmail.com" ,MD5("xxxxx"),"Morin"   ,"Stéphane" ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("oceane@hotmail.com"   ,MD5("xxxxx"),"Morin"   ,"Océane"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("megane@hotmail.com"   ,MD5("xxxxx"),"Morin"   ,"Mégane"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("michael@hotmail.com"  ,MD5("xxxxx"),"Osman"   ,"Michael"  ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("rais@hotmail.com"     ,MD5("xxxxx"),"Boualem" ,"Rais"     ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("claude@hotmail.com"   ,MD5("xxxxx"),"Guénette","Claude"   ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP)
;
CREATE TABLE Ami(
courrielUtil varchar(50) not null,
courrielAmi  varchar(50) not null,
PRIMARY KEY(courrielUtil, courrielAmi),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel),
FOREIGN KEY(courrielAmi)  references Utilisateur(courriel)
);
INSERT INTO Ami VALUES
("martine@hotmail.com"  ,"guy@hotmail.com"),
("guy@hotmail.com"      ,"martine@hotmail.com"),
("martine@hotmail.com"  ,"sebastien@hotmail.com"),
("sebastien@hotmail.com","martine@hotmail.com"),
("martine@hotmail.com"  ,"helene@hotmail.com"),
("helene@hotmail.com"   ,"martine@hotmail.com"),
("martine@hotmail.com"  ,"gisele@hotmail.com"),
("gisele@hotmail.com"   ,"martine@hotmail.com"),
("martine@hotmail.com"  ,"gilles@hotmail.com"),
("gilles@hotmail.com"   ,"martine@hotmail.com"),

("lyne@hotmail.com"     ,"stephane@hotmail.com"),
("stephane@hotmail.com" ,"lyne@hotmail.com"),
("lyne@hotmail.com"     ,"oceane@hotmail.com"),
("oceane@hotmail.com"   ,"lyne@hotmail.com"),
("lyne@hotmail.com"     ,"megane@hotmail.com"),
("megane@hotmail.com"   ,"lyne@hotmail.com"),

("guy@hotmail.com"      ,"gilles@hotmail.com"),
("gilles@hotmail.com"   ,"guy@hotmail.com"),
("guy@hotmail.com"      ,"stephane@hotmail.com"),
("stephane@hotmail.com" ,"guy@hotmail.com"),
("guy@hotmail.com"      ,"sebastien@hotmail.com"),
("sebastien@hotmail.com","guy@hotmail.com"),

("helene@hotmail.com"   ,"gisele@hotmail.com"),
("gisele@hotmail.com"   ,"helene@hotmail.com"),

("rais@hotmail.com"     ,"michael@hotmail.com"),
("michael@hotmail.com"  ,"rais@hotmail.com"),
("rais@hotmail.com"     ,"claude@hotmail.com"),
("claude@hotmail.com"   ,"rais@hotmail.com")
;
CREATE TABLE Categorie(
id          int         not null auto_increment,
description varchar(20) not null,
PRIMARY KEY(id)
);
INSERT INTO Categorie VALUES
(1,"Tutorat"),
(2,"Astuce")
;
CREATE TABLE Publication(
id           bigint      not null auto_increment,
idCategorie  int         not null,
texte        text,
url          varchar(50),
destinataire varchar(10) not null,
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
courrielUtil varchar(50) not null,
PRIMARY KEY(id),
FOREIGN KEY(idCategorie)  references Categorie(id),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel)
);
INSERT INTO Publication VALUES
(1,1,"Tutorat CSS3"     ,"css3.mp4"      ,"amis"  ,CURRENT_TIMESTAMP,"martine@hotmail.com"),
(2,1,"Tutorat PHP5"     ,"php5.mp4"      ,"moi"   ,CURRENT_TIMESTAMP,"michael@hotmail.com"),
(3,2,"Astuce jQuery"    ,"jquery.mp4"    ,"amis"  ,CURRENT_TIMESTAMP,"rais@hotmail.com"),
(4,2,"Astuce JavaScript","javascript.mp4","public",CURRENT_TIMESTAMP,"claude@hotmail.com")
;
CREATE TABLE Evaluation(
id            bigint      not null auto_increment,
texte         text,
note          int         not null,
dateCreation  timestamp   not null default CURRENT_TIMESTAMP,
idPublication bigint      not null,
courrielUtil  varchar(50) not null,
PRIMARY KEY(id),
FOREIGN KEY(idPublication) references Publication(id),
FOREIGN KEY(courrielUtil)  references Utilisateur(courriel)
);
INSERT INTO Evaluation VALUES
(1,"Très bien expliqué",8,CURRENT_TIMESTAMP,1,"guy@hotmail.com"),
(2,"Très formateur"    ,9,CURRENT_TIMESTAMP,1,"gilles@hotmail.com")
;
CREATE TABLE Partage(
id            bigint      not null auto_increment,
destinataire  varchar(10) not null,
dateCreation  timestamp   not null default CURRENT_TIMESTAMP,
idPublication bigint      not null,
courrielUtil  varchar(50) not null,
courrielAmi   varchar(50),
PRIMARY KEY(id),
FOREIGN KEY(idPublication) references Publication(id),
FOREIGN KEY(courrielUtil)  references Utilisateur(courriel),
FOREIGN KEY(courrielAmi)   references Utilisateur(courriel)
);
INSERT INTO Partage VALUES
(1,"amis"  ,CURRENT_TIMESTAMP,1,"guy@hotmail.com"      ,null),
(2,"public",CURRENT_TIMESTAMP,1,"sebastien@hotmail.com",null),
(3,"moi"   ,CURRENT_TIMESTAMP,1,"guy@hotmail.com"      ,null),
(4,"ami"   ,CURRENT_TIMESTAMP,1,"martine@hotmail.com"  ,"guy@hotmail.com")
;
CREATE TABLE Message(
id           bigint      not null auto_increment,
sujet        varchar(30) not null,
texte        text        not null,
url          varchar(50),
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
courrielUtil varchar(50) not null,
courrielAmi  varchar(50) not null,
PRIMARY KEY(id),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel),
FOREIGN KEY(courrielAmi)  references Utilisateur(courriel)
);
INSERT INTO Message VALUES
(1,"Tutorat CSS3"     ,"Super tutorat super clair","",CURRENT_TIMESTAMP,"gilles@hotmail.com" ,"guy@hotmail.com"),
(2,"Tutorat PHP"      ,"Super tutorat super clair","",CURRENT_TIMESTAMP,"guy@hotmail.com"    ,"gilles@hotmail.com"),
(3,"Astuce jQuery"    ,"Astuce super géniale"     ,"",CURRENT_TIMESTAMP,"helene@hotmail.com" ,"sebastien@hotmail.com"),
(4,"Astuce JavaScript","Astuce super géniale"     ,"",CURRENT_TIMESTAMP,"helene@hotmail.com" ,"guy@hotmail.com")
;
/* Extrait tous les amis de l'utilisateur courant */
/* Version 1 */
SELECT IF(Util.courriel="guy@hotmail.com",CONCAT(Util.prenom," ",Util.nom), CONCAT(Uami.prenom," ",Uami.nom)) AS nomUtil,
       IF(Util.courriel="guy@hotmail.com",CONCAT(Uami.prenom," ",Uami.nom), CONCAT(Util.prenom," ",Util.nom)) AS nomAmi
FROM   Ami
JOIN   Utilisateur Util ON Util.courriel=Ami.courrielUtil
JOIN   Utilisateur Uami ON Uami.courriel=Ami.courrielAmi
WHERE  courrielUtil="guy@hotmail.com" OR courrielAmi="guy@hotmail.com"
;
/* Version 2 */
SELECT DISTINCT * FROM Ami JOIN Utilisateur ON Ami.courrielAmi = Utilisateur.courriel WHERE Ami.courrielUtil="guy@hotmail.com" UNION
SELECT DISTINCT * FROM Ami JOIN Utilisateur ON Ami.courrielAmi = Utilisateur.courriel WHERE Ami.courrielAmi ="guy@hotmail.com"
;
/* Version 3 */
SELECT IF(Util.courriel="guy@hotmail.com",Uami.courriel    ,Util.courriel)     AS amiCourriel,
       IF(Util.courriel="guy@hotmail.com",Uami.motPasse    ,Util.motPasse)     AS amiMotPasse,
       IF(Util.courriel="guy@hotmail.com",Uami.nom         ,Util.nom)          AS amiNom,
       IF(Util.courriel="guy@hotmail.com",Uami.prenom      ,Util.prenom)       AS amiPrenom,
       IF(Util.courriel="guy@hotmail.com",Uami.idStatut    ,Util.idStatut)     AS amiIdStatut,
       IF(Util.courriel="guy@hotmail.com",Uami.ville       ,Util.ville)        AS amiVille,
       IF(Util.courriel="guy@hotmail.com",Uami.province    ,Util.province)     AS amiProvince,
       IF(Util.courriel="guy@hotmail.com",Uami.pays        ,Util.pays)         AS amiPays,
       IF(Util.courriel="guy@hotmail.com",Uami.dateCreation,Util.dateCreation) AS amiDateCreation
FROM   Ami
JOIN   Utilisateur Util ON Util.courriel=Ami.courrielUtil
JOIN   Utilisateur Uami ON Uami.courriel=Ami.courrielAmi
WHERE  courrielUtil="guy@hotmail.com" OR courrielAmi="guy@hotmail.com"
ORDER  BY amiNom, amiPrenom
;
/* Version 4 */
SELECT courriel, motPasse, nom, prenom, idStatut, ville, province, pays, dateCreation
FROM   Ami
JOIN   Utilisateur ON courriel=courrielAmi
WHERE  courrielUtil="guy@hotmail.com"
;
/* Vérifie si la relation d'amitié existe déjà entre 2 utilisateurs */
/* Version 1 */
SELECT * FROM Ami
WHERE (courrielUtil="martine@hotmail.com" AND courrielAmi="guy@hotmail.com")
OR    (courrielUtil="guy@hotmail.com"     AND courrielAmi="martine@hotmail.com")
;
/* Version 2 */
SELECT * FROM Ami WHERE courrielUtil="martine@hotmail.com" AND courrielAmi="guy@hotmail.com"
;
/* Extrait toutes les publications que l'utilisateur courant a le droit de voir, en ordre décroissant */
SELECT id, idCategorie, texte, url, destinataire, dateCreation, Pub.courrielUtil
FROM   Publication Pub
LEFT   JOIN Ami ON (Ami.courrielUtil="michael@hotmail.com" AND Ami.courrielAmi =Pub.courrielUtil)
                OR (Ami.courrielAmi ="michael@hotmail.com" AND Ami.courrielUtil=Pub.courrielUtil)
WHERE  destinataire="public" OR  Pub.courrielUtil="michael@hotmail.com"
OR    (destinataire="amis"  AND (Ami.courrielUtil="michael@hotmail.com" OR Ami.courrielAmi="michael@hotmail.com"))
ORDER  BY dateCreation DESC
;
/* Extrait toutes les évaluations d'une publication, en ordre décroissant */
SELECT * FROM Evaluation
WHERE         idPublication=1
ORDER    BY   dateCreation DESC
;
/* Extrait tous les messages échangés avec l'utilisateur courant, par ami, en ordre décroissant */
SELECT id, sujet, texte, url, dateCreation, courrielUtil, courrielAmi,
       IF(courrielUtil="guy@hotmail.com",courrielUtil,courrielAmi)  AS cUtil,
       IF(courrielUtil="guy@hotmail.com",courrielAmi ,courrielUtil) AS cAmi
FROM   Message
WHERE  courrielUtil="guy@hotmail.com" OR courrielAmi="guy@hotmail.com"
ORDER  BY cAmi, dateCreation DESC
;
/* Extrait tous les partages que l'utilisateur courant a le droit de voir, en ordre décroissant */
SELECT id, destinataire, dateCreation, idPublication, P.courrielUtil, P.courrielAmi
FROM   Partage P
LEFT   JOIN Ami ON (Ami.courrielUtil="guy@hotmail.com" AND Ami.courrielAmi =P.courrielUtil)
                OR (Ami.courrielAmi ="guy@hotmail.com" AND Ami.courrielUtil=P.courrielUtil)
WHERE destinataire="public"
OR   (destinataire="moi"  AND    P.courrielUtil="guy@hotmail.com")
OR   (destinataire="amis" AND (Ami.courrielUtil="guy@hotmail.com"
                           OR  Ami.courrielAmi ="guy@hotmail.com"
                           OR    P.courrielUtil="guy@hotmail.com"))
OR  ((destinataire="ami"   OR      destinataire="autre")
                          AND    P.courrielAmi ="guy@hotmail.com")
ORDER BY dateCreation DESC
;
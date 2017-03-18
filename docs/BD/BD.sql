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
("martine@hotmail.com"  ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Bouchard","Martine"  ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("guy@hotmail.com"      ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Roy"     ,"Guy"      ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("sebastien@hotmail.com","$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Roy"     ,"Sébastien",2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("helene@hotmail.com"   ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Mercier" ,"Hélène"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("gisele@hotmail.com"   ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Allard"  ,"Gisèle"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("gilles@hotmail.com"   ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Bouchard","Gilles"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("lyne@hotmail.com"     ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Bouchard","Lyne"     ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("stephane@hotmail.com" ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Morin"   ,"Stéphane" ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("oceane@hotmail.com"   ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Morin"   ,"Océane"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("megane@hotmail.com"   ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Morin"   ,"Mégane"   ,2,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("michael@hotmail.com"  ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Osman"   ,"Michael"  ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("rais@hotmail.com"     ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Boualem" ,"Rais"     ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP),
("claude@hotmail.com"   ,"$2y$10$wdEkeS/5KDqqNUCBPeCW.OGwEVIDdIwl31HRG3CZ9NaZ7tHb7KiHS","Guénette","Claude"   ,1,"Montréal","Québec","Canada",CURRENT_TIMESTAMP)
;
CREATE TABLE DemandeAmi(
courrielUtil varchar(50) not null,
courrielAmi  varchar(50) not null,
statut       char(1)     not null,
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
PRIMARY KEY(courrielUtil, courrielAmi),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel) ON DELETE CASCADE,
FOREIGN KEY(courrielAmi)  references Utilisateur(courriel) ON DELETE CASCADE
);
CREATE TABLE Ami(
courrielUtil varchar(50) not null,
courrielAmi  varchar(50) not null,
PRIMARY KEY(courrielUtil, courrielAmi),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel) ON DELETE CASCADE,
FOREIGN KEY(courrielAmi)  references Utilisateur(courriel) ON DELETE CASCADE
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
(2,"Astuce"),
(3,"Quiz"),
(4,"Message")
;
CREATE TABLE Publication(
id           bigint      not null auto_increment,
idCategorie  int         not null,
titre        varchar(50) not null,
texte        text,
url          varchar(50),
destinataire varchar(10) not null,
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
courrielUtil varchar(50) not null,
courrielAmi  varchar(50),
PRIMARY KEY(id),
FOREIGN KEY(idCategorie)  references Categorie  (id),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel) ON DELETE CASCADE,
FOREIGN KEY(courrielAmi)  references Utilisateur(courriel) ON DELETE CASCADE
);
INSERT INTO Publication VALUES
(1,1,"Tutorat CSS3"     ,"Tutorat CSS3"           ,"css3.mp4"      ,"amis"  ,CURRENT_TIMESTAMP,"martine@hotmail.com",null),
(2,1,"Tutorat PHP5"     ,"Tutorat PHP5"           ,"php5.mp4"      ,"public",CURRENT_TIMESTAMP,"michael@hotmail.com",null),
(3,2,"Astuce jQuery"    ,"Astuce jQuery"          ,"jquery.mp4"    ,"amis"  ,CURRENT_TIMESTAMP,"rais@hotmail.com"   ,null),
(4,2,"Astuce JavaScript","Astuce JavaScript"      ,"javascript.mp4","public",CURRENT_TIMESTAMP,"claude@hotmail.com" ,null),
(5,3,"Quiz PHP"         ,"Variables et constantes",null            ,"public",CURRENT_TIMESTAMP,"michael@hotmail.com",null),
(6,4,"Rappel"           ,"Tutorat CSS3"           ,null            ,"public",CURRENT_TIMESTAMP,"guy@hotmail.com"    ,null),
(7,4,"Rappel"           ,"Tutorat PHP5"           ,null            ,"public",CURRENT_TIMESTAMP,"guy@hotmail.com"    ,null),
(8,4,"A lire"           ,"Astuce jQuery"          ,null            ,"ami"   ,CURRENT_TIMESTAMP,"martine@hotmail.com","guy@hotmail.com"),
(9,4,"A lire"           ,"Astuce JavaScript"      ,null            ,"ami"   ,CURRENT_TIMESTAMP,"guy@hotmail.com"    ,"martine@hotmail.com")
;
CREATE TABLE Evaluation(
id            bigint      not null auto_increment,
texte         text,
note          int         not null,
dateCreation  timestamp   not null default CURRENT_TIMESTAMP,
idPublication bigint      not null,
courrielUtil  varchar(50) not null,
PRIMARY KEY(id),
FOREIGN KEY(idPublication) references Publication(id)       ON DELETE CASCADE,
FOREIGN KEY(courrielUtil)  references Utilisateur(courriel) ON DELETE CASCADE
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
FOREIGN KEY(idPublication) references Publication(id)       ON DELETE CASCADE,
FOREIGN KEY(courrielUtil)  references Utilisateur(courriel) ON DELETE CASCADE,
FOREIGN KEY(courrielAmi)   references Utilisateur(courriel) ON DELETE CASCADE
);
INSERT INTO Partage VALUES
( 1,"public",CURRENT_TIMESTAMP,1,"guy@hotmail.com"      ,null),
( 2,"public",CURRENT_TIMESTAMP,1,"sebastien@hotmail.com",null),
( 3,"public",CURRENT_TIMESTAMP,1,"guy@hotmail.com"      ,null),
( 4,"ami"   ,CURRENT_TIMESTAMP,1,"martine@hotmail.com"  ,"guy@hotmail.com"),
( 5,"ami"   ,CURRENT_TIMESTAMP,2,"stephane@hotmail.com" ,"guy@hotmail.com"),
( 6,"ami"   ,CURRENT_TIMESTAMP,2,"martine@hotmail.com"  ,"gilles@hotmail.com"),
( 7,"public",CURRENT_TIMESTAMP,3,"lyne@hotmail.com"     ,null),
( 8,"public",CURRENT_TIMESTAMP,3,"helene@hotmail.com"   ,null),
( 9,"public",CURRENT_TIMESTAMP,4,"martine@hotmail.com"  ,null),
(10,"public",CURRENT_TIMESTAMP,4,"gilles@hotmail.com"   ,null),
(11,"public",CURRENT_TIMESTAMP,5,"gisele@hotmail.com"   ,null),
(12,"amis"  ,CURRENT_TIMESTAMP,6,"oceane@hotmail.com"   ,null),
(13,"amis"  ,CURRENT_TIMESTAMP,9,"martine@hotmail.com"  ,null)
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
FOREIGN KEY(courrielUtil) references Utilisateur(courriel) ON DELETE CASCADE,
FOREIGN KEY(courrielAmi)  references Utilisateur(courriel) ON DELETE CASCADE
);
INSERT INTO Message VALUES
(1,"Tutorat CSS3"     ,"Super tutorat super clair","",CURRENT_TIMESTAMP,"gilles@hotmail.com" ,"guy@hotmail.com"),
(2,"Tutorat PHP"      ,"Super tutorat super clair","",CURRENT_TIMESTAMP,"guy@hotmail.com"    ,"gilles@hotmail.com"),
(3,"Astuce jQuery"    ,"Astuce super géniale"     ,"",CURRENT_TIMESTAMP,"helene@hotmail.com" ,"sebastien@hotmail.com"),
(4,"Astuce JavaScript","Astuce super géniale"     ,"",CURRENT_TIMESTAMP,"helene@hotmail.com" ,"guy@hotmail.com")
;
CREATE TABLE Question(
id          bigint       not null auto_increment,
idQuiz      bigint       not null,
noQuestion  int          not null,
question    varchar(150) not null,
typeReponse varchar(20)  not null,
PRIMARY KEY(id),
FOREIGN KEY(idQuiz) references Publication(id) ON DELETE CASCADE
);
INSERT INTO Question VALUES
(1,5,1,"Q1","checkbox"),
(2,5,2,"Q2","checkbox"),
(3,5,3,"Q3","checkbox"),
(4,5,4,"Q4","checkbox")
;
CREATE TABLE ChoixReponse(
id         bigint      not null auto_increment,
idQuiz     bigint      not null,
idQuestion bigint      not null,
noChoix    int         not null,
choix      varchar(20) not null,
reponse    boolean     not null,
PRIMARY KEY(id),
FOREIGN KEY(idQuiz)     references Question(idQuiz) ON DELETE CASCADE,
FOREIGN KEY(idQuestion) references Question(id)     ON DELETE CASCADE
);
INSERT INTO ChoixReponse VALUES
(1,5,1,1,"Q1C1",1),
(2,5,1,2,"Q1C2",0),
(3,5,2,1,"Q2C1",0),
(4,5,2,2,"Q2C2",1),
(5,5,3,1,"Q3C1",0),
(6,5,3,2,"Q3C2",1),
(7,5,4,1,"Q4C1",1),
(8,5,4,2,"Q4C2",0)
;
CREATE TABLE QuizFait(
id           bigint      not null auto_increment,
courrielUtil varchar(50) not null,
idQuiz       bigint      not null,
note         int         not null,
dateCreation timestamp   not null default CURRENT_TIMESTAMP,
PRIMARY KEY(id),
FOREIGN KEY(courrielUtil) references Utilisateur(courriel) ON DELETE CASCADE,
FOREIGN KEY(idQuiz)       references Publication(id)       ON DELETE CASCADE
);
CREATE TABLE NotificationPub(
id              int(11)     NOT NULL,
type            varchar(50) NOT NULL,
idUtilisateur   varchar(50) NOT NULL,
notificationVue tinyint(1)  DEFAULT NULL,
idPublication   bigint(20)  NOT NULL,
PRIMARY KEY(id),
FOREIGN KEY(idPublication) references Publication(id)       ON DELETE CASCADE,
FOREIGN KEY(idUtilisateur) references Utilisateur(courriel) ON DELETE CASCADE
);
INSERT INTO NotificationPub (id, type, idUtilisateur, notificationVue, idPublication) VALUES
( 1, 'message', 'rais@hotmail.com'   , NULL, 116),
( 3, 'message', 'michael@hotmail.com', 1   , 116),
( 4, 'message', 'michael@hotmail.com', 1   , 116),
( 5, 'message', 'michael@hotmail.com', 1   , 116),
( 6, 'tutorat', 'michael@hotmail.com', NULL, 116),
( 7, 'tutorat', 'michael@hotmail.com', NULL, 116),
( 8, 'message', 'michael@hotmail.com', 1   , 116),
( 9, 'message', 'michael@hotmail.com', 1   , 116),
(10, 'message', 'michael@hotmail.com', 1   , 116),
(11, 'messagw', 'michael@hotmail.com', NULL, 116),
(12, 'message', 'michael@hotmail.com', 1   , 116),
(13, 'message', 'michael@hotmail.com', 1   , 116),
(14, 'message', 'michael@hotmail.com', 1   , 116)
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
SELECT id, idCategorie, texte, url, destinataire, dateCreation, Pub.courrielUtil, Pub.courrielAmi
FROM   Publication Pub
LEFT   JOIN Ami ON Ami.courrielUtil="guy@hotmail.com" AND Ami.courrielAmi=Pub.courrielUtil
WHERE  destinataire="public"
OR    (destinataire!="ami"  AND  Pub.courrielUtil="guy@hotmail.com")
OR    (destinataire ="ami"  AND  Pub.courrielAmi ="guy@hotmail.com")
OR    (destinataire ="amis" AND (Ami.courrielUtil="guy@hotmail.com"
                             OR  Ami.courrielAmi ="guy@hotmail.com"))
ORDER  BY dateCreation DESC
;
/* Extrait toutes les publications de l'utilisateur courant, publiées par lui ou un ami, en ordre décroissant */
SELECT * FROM Publication
WHERE (courrielUtil ="guy@hotmail.com"
AND    courrielAmi is null)
OR     courrielAmi  ="guy@hotmail.com"
ORDER  BY dateCreation DESC
;
/* Extrait toutes les publications de l'utilisateur courant, publiées par lui ou un ami, */
/* et les partages qu'il a le droit de voir, en ordre décroissant                        */
SELECT * FROM Publication Pub
         JOIN Partage     P ON P.idPublication=Pub.id
WHERE (P.courrielUtil ="guy@hotmail.com"
AND    P.courrielAmi is null)
OR     P.courrielAmi  ="guy@hotmail.com"
ORDER  BY dateCreation DESC
;
SELECT id AS idPublication, idCategorie, titre, texte, url, destinataire, Pub.dateCreation,
CONCAT("Publié par ",prenom," ",nom) AS auteur, courrielAmi
FROM   Publication Pub
JOIN   Utilisateur U ON courriel=courrielUtil
WHERE (courrielUtil ="guy@hotmail.com"
AND    courrielAmi is null)
OR     courrielAmi  ="guy@hotmail.com"
UNION
SELECT idPublication, idCategorie, titre, texte, url, P.destinataire, P.dateCreation,
CONCAT("Partagé par ",prenom," ",nom) AS auteur, P.courrielAmi
FROM   Partage     P
JOIN   Publication Pub ON   P.idPublication=Pub.id
JOIN   Utilisateur U   ON   U.courriel     =P.courrielUtil
LEFT   JOIN        Ami ON Ami.courrielUtil ="guy@hotmail.com"
                      AND Ami.courrielAmi  =P.courrielUtil
WHERE (P.destinataire="public" AND    P.courrielUtil!="guy@hotmail.com")
OR    (P.destinataire="ami"    AND    P.courrielAmi  ="guy@hotmail.com")
OR    (P.destinataire="amis"   AND (Ami.courrielUtil ="guy@hotmail.com"
                                OR  Ami.courrielAmi  ="guy@hotmail.com"))
ORDER BY dateCreation DESC
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
LEFT   JOIN Ami ON Ami.courrielUtil="guy@hotmail.com" AND Ami.courrielAmi=P.courrielUtil
WHERE (destinataire="public" AND    P.courrielUtil!="guy@hotmail.com")
OR    (destinataire="ami"    AND    P.courrielAmi  ="guy@hotmail.com")
OR    (destinataire="amis"   AND (Ami.courrielUtil ="guy@hotmail.com"
                              OR  Ami.courrielAmi  ="guy@hotmail.com"))
ORDER BY dateCreation DESC
;
/* Pour chaque quiz, extrait chaque question avec ses choix de réponse */
SELECT q.noQuestion, GROUP_CONCAT(c.choix) AS choixRep
FROM   Publication  p
JOIN   Question     q ON q.idQuiz    =p.id
JOIN   ChoixReponse c ON c.idQuiz    =q.idQuiz
                     AND c.idQuestion=q.id
WHERE  p.idCategorie=3
GROUP  BY q.noQuestion
ORDER  BY p.id, q.id, c.id
;
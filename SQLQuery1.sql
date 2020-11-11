create database Data_Base
use Data_Base

CREATE TABLE USERS
(
	IdUSER int PRIMARY KEY IDENTITY(1,1),
	NomUSER varchar(500),
	PrenomUSER varchar(500),
	EmailUSER varchar(500),
	TelephoneUSER varchar(20),
	LoginUSER varchar(500),
	PassUSER varchar(500),
	CompteUSER varchar(5),
	ActiveUSER int,
	ConnectedUSER int,
	Avatar varchar(500)
);
alter table users add Request int default 0

CREATE TABLE Societe 
(
	IdSociete int primary key identity(1,1),
	LibelleSociete varchar(500),
	RaisonSocialeSociete varchar(500),
	IFSociete varchar(500),
	ICESociete varchar(500),
	ITVASociete varchar(500),
	Ville varchar(500)
) 
CREATE TABLE Code
(
	IdCODE int PRIMARY KEY IDENTITY(1,1),
	IdSOCIETE int foreign key references Societe(IdSOCIETE) ON UPDATE CASCADE ON DELETE CASCADE,
	AnneeCODE varchar(500),
	ProduitCODE varchar(500),
	FileNameCODE varchar(500),
	NuSerie varchar(500),
	IdUSER int foreign key references USERS(IdUSER) ON UPDATE CASCADE ON DELETE CASCADE
)
--CREATE TABLE ISuserABLE(IpAddress varchar(500) PRIMARY KEY,capable int,IdUSER int)
CREATE TABLE usercompany
(
	ID int PRIMARY KEY IDENTITY(1,1),
	IdUSER int foreign key references USERS(IdUSER) ON UPDATE CASCADE ON DELETE CASCADE ,
	IdSOCIETE int foreign key references Societe(IdSOCIETE)  ON UPDATE CASCADE ON DELETE CASCADE
)
CREATE TABLE History
(
	IdHistory int PRIMARY KEY IDENTITY(1,1),
	IdUSER int foreign key references USERS(IdUSER) ON UPDATE CASCADE ON DELETE CASCADE,
	History varchar(max),
	Url varchar(500),
	mession int,
	date datetime
)
CREATE TABLE Notifications
(
	IdNoti int PRIMARY KEY IDENTITY(1,1),
	[from] int foreign key references USERS(IdUSER),
	CompteUSER varchar(5),
	[Message] varchar(max),
	Url varchar(500),
	Icon int,	
	Date datetime default getdate()
)
CREATE TABLE Hide
(
 idUF int PRIMARY KEY IDENTITY(1,1),
 IdUSER int foreign key references USERS(IdUSER) ON UPDATE CASCADE ON DELETE CASCADE,
 folder varchar(max)
)
------------------------------------------------------------------------------------
select * from USERS
select * from Societe
select * from Code
SELECT * FROM usercompany
--select * from ISuserABLE
select * from History
select * from Notifications
select * from hide

------------------------------------------------------------------------------------
select * from Societe s join usercompany u  on(s.IdSociete=u.IdSOCIETE)  where U.IdUSER=1
SELECT Top 7 * FROM History where IdUSER=4 order by IdHistory desc 
insert into History values(19,'Vous avez ajouter le collaborateurtesttest test','Users.php?text=testtest')
SELECT Top 7 * FROM History order by IdHistory desc
insert into History values(4,'History',(SELECT CONVERT(VARCHAR(10),select getdate(), 111)),'test')
insert into Notifications ([from],CompteUSER,[Message],Url,Date) values('from','cmpt','msg','#',getdate())


CREATE TABLE info (name SYSNAME, rows CHAR(11), reserved VARCHAR(18), 
data VARCHAR(18), index_size VARCHAR(18), unused VARCHAR(18))

delete from info EXEC sp_msforeachtable 'INSERT INTO info EXEC sp_spaceused ''?''' SELECT * FROM info 

-- SELECT name, CONVERT(INT, SUBSTRING(data, 1, LEN(data)-3)) FROM #t ORDER BY name
SELECT SUM(CONVERT(INT, SUBSTRING(data, 1, LEN(data)-3))) FROM info


SELECT *
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = N'code'

alter table code 
add [Nom] [type]
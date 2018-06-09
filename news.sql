/*
    news-06062018.sql
    
    example sql:
    
SELECT p4_Categories.CategoryID, p4_Categories.Category, p4_Feeds.URL, p4_Feeds.Subcategory, p4_Feeds.Description 
FROM p4_Categories 
INNER JOIN p4_Feeds ON 
p4_Categories.CategoryID = p4_Feeds.CategoryID;

*/

SET foreign_key_checks = 0;

#drop tables first, working backwards
DROP TABLE IF EXISTS p4_Feeds;
DROP TABLE IF EXISTS p4_Categories;

#category table
CREATE TABLE p4_Categories(
CategoryID INT UNSIGNED NOT NULL AUTO_INCREMENT,
Category VARCHAR(255) DEFAULT '',
PRIMARY KEY (CategoryID)
)ENGINE=INNODB;

INSERT INTO p4_Categories VALUES (NULL,'Technology');
INSERT INTO p4_Categories VALUES (NULL,'Sports');
INSERT INTO p4_Categories VALUES (NULL,'Entertainment');

#feed table
CREATE TABLE p4_Feeds(
FeedID INT UNSIGNED NOT NULL AUTO_INCREMENT,
CategoryID INT UNSIGNED DEFAULT 0,
URL VARCHAR(255) DEFAULT '',
Subcategory VARCHAR(255) DEFAULT '',
Description TEXT DEFAULT '',
DateAdded DATETIME,
LastUpdated TIMESTAMP DEFAULT 0 ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (FeedID),
FOREIGN KEY (CategoryID) REFERENCES p4_Categories(CategoryID) ON DELETE CASCADE
)ENGINE=INNODB;

#Technology
INSERT INTO p4_Feeds VALUES (NULL,1,'https://www.huffingtonpost.com/topic/space/feed','Space','Space News from Huffington Post',NOW(),NOW());
INSERT INTO p4_Feeds VALUES (NULL,1,'https://www.huffingtonpost.com/topic/computers/feed','Computers','Computer News from Huffington Post',NOW(),NOW());
INSERT INTO p4_Feeds VALUES (NULL,1,'https://www.androidcentral.com/feed','Mobile','Mobile News from Android Central',NOW(),NOW());
#Sports
INSERT INTO p4_Feeds VALUES (NULL,2,'https://www.huffingtonpost.com/topic/football/feed','Football','Football News from Huffington Post',NOW(),NOW());
INSERT INTO p4_Feeds VALUES (NULL,2,'https://www.huffingtonpost.com/topic/basketball/feed','Basketball','Basketball News from Huffington Post',NOW(),NOW());
INSERT INTO p4_Feeds VALUES (NULL,2,'https://www.huffingtonpost.com/topic/soccer/feed','Soccer','Soccer News from Huffington Post',NOW(),NOW());
#Entertainment
INSERT INTO p4_Feeds VALUES (NULL,3,'http://www.tmz.com/category/music/rss.xml','Music','Music News from TMZ',NOW(),NOW());
INSERT INTO p4_Feeds VALUES (NULL,3,'http://www.tmz.com/category/movies/rss.xml','Movies','Movie News from TMZ',NOW(),NOW());
INSERT INTO p4_Feeds VALUES (NULL,3,'http://www.tmz.com/category/tv/rss.xml','TV','TV News from TMZ',NOW(),NOW());

SET foreign_key_checks = 1;
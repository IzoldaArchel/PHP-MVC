DROP TABLE IF EXISTS admin;

CREATE TABLE admin (
  id_admin  int          UNSIGNED NOT NULL AUTO_INCREMENT,
  nom       varchar(255) NOT NULL,
  prenom    varchar(255) NOT NULL,
  courriel  varchar(255) NOT NULL,
  motdepass varchar(255) NOT NULL,
  PRIMARY KEY (id_auteur)
) ENGINE=InnoDB  DEFAULT CHARSET=UTF8;

SET NAMES UTF8;
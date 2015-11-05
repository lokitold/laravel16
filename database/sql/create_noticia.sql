CREATE TABLE `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` char(255) NOT NULL,
  `titulo` char(255) ,
  `descripcion` text ,
  `status` tinyint(1) NOT NULL default '0',
  `fecha_publicacion` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
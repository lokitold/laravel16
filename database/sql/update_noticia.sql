alter table noticia add (
	source_id int(15)
);

alter table noticia
  change date_added created_at datetime ;

alter table noticia
  change date_modified updated_at datetime ;
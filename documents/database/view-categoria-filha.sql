CREATE VIEW view_categoria_filha AS
SELECT * FROM categoria cat
                LEFT JOIN categoria_filha c1
                          ON cat.id_categoria = c1.id_filha;
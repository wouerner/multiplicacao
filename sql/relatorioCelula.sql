select c.id AS celulaID, c.nome AS celulaNome, r.titulo, r.dataEnvio, r.id AS id
						from 
						Celula AS c left join RelatorioCelula AS r 
						on 
						c.id = r.celulaId and r.dataEnvio between '2013-02-18 00:00:00' and '2013-02-18 23:59:59'
						WHERE 1
						group by c.id
						order by  r.titulo
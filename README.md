pre requisitos
 - Docker
 - docker-compose


clonando o repositorio:  
``` sh
git clone https://github.com/wouerner/multiplicacao.git  
```

Entre na pasta do projeto  
``` sh
cd multiplicacao/  
```

Restaurando dados de teste da aplicação  
``` sh
docker exec -i m-db sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < dump1.sql  
```

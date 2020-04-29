pre requisitos
 - Docker
 - docker-compose

Opicional
- [Dbeaver](https://dbeaver.io/)


clonando o repositorio:  
``` sh
git clone https://github.com/wouerner/multiplicacao.git  
```

Entre na pasta do projeto  
``` sh
cd multiplicacao/  
```

Iniciar o projeto  
``` sh
docker-compose up -d --build   
```


Restaurando dados de teste da aplicação  
``` sh
docker exec -i m-db sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < dump1.sql  
```

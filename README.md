Link do youtube: https://youtu.be/ZGX0s8Xv7EA

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
Restaurando dados de teste da aplicação (demora entorno de 3 minutos)
``` sh
docker exec -i m-db sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < dump1.sql  
```
Acessar no navegador: http://localhost

Acesso ao banco de dados:  
host: 127.0.0.1  
usuário: root  
senha: root  




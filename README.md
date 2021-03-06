
### Passo a passo
Clonar o Repositório
```sh
git clone https://github.com/Higor23/produtos.git
cd produtos/
```

Criar o Arquivo .env
```sh

cp .env.example .env
```

Atualizar as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=Produtos
APP_URL=http://localhost:8180

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=products
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Subir os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec produtos bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```
Acessar o PhpmyAdmin em [http://localhost:8081](http://localhost:8081) informando o mesmo usuário(root) e senha(root) utilizado no arquivo .env.

Criar um banco de dados com o mesmo nome(products) utilizado no arquivo .env.

Criar e preencher as tabelas no banco de dados
```sh
php artisan migrate --seed
```

Acessar o projeto
[http://localhost:8180](http://localhost:8180)

Fazer o login com os seguintes dados:

Email: admin@teste

Senha: 12345678


Relatório SQL:

```sh
-- Listagem de tags e produtos relacionados
SELECT a.id as id_produto, a.name as nome_produto, c.name as nome_tag FROM products a INNER JOIN product_tag b ON a.id=b.product_id INNER JOIN tags c ON c.id=b.tag_id;

-- Todos os produtos que possuem uma tag específica, como por exemplo 10% off.
SELECT a.id as id_produto, a.name as nome_produto, c.name as nome_tag FROM products a INNER JOIN product_tag b ON a.id=b.product_id INNER JOIN tags c ON c.id=b.tag_id WHERE c.name='10% off' GROUP BY a.id;

-- Todos os produtos que não possuem uma tag específica, como por exemplo 15% off.
SELECT a.id as id_produto, a.name as nome_produto, c.name as nome_tag FROM products a INNER JOIN product_tag b ON a.id=b.product_id INNER JOIN tags c ON c.id=b.tag_id WHERE c.name NOT IN('15% off');
```


# EducaRA Web [Backend]
Educara Web - Realidade Aumentada no Ensino Médio - [BACK-END]

# Configurações do Projeto

Projeto requer PHP >= 8.0, composer e banco de dados Mysql/MariaDB.
Verifique todos os requisitos, dependências, e extensões do PHP para o laravel.
Um bom caminho é criar um projeto em branco com o composer e verificar se tudo funciona.

## Sistema Operacional
O sistema usado para o projeto foi o ubuntu 22.04 LTS. Porém, isso não implica ser exclusivo para esse sistema, mas é a nossa referência

## PHP
Para instalação do PHP no ubuntu 22.04, execute no terminal

    sudo apt install curl php-cli php-mbstring git unzip php-xml php-curl php-mysql

Também pode-se especificar outras versões como por exemplo, PHP 8.1 (Padrão no ubuntu 22.04

    sudo apt install curl php8.1-cli php8.1-mbstring git unzip php8.1-xml php8.1-curl php8.1-mysql

Devido as questões de upload de arquivos, é necessário editar algumas opções do servidor. 
Caso utilize Apache, Nginx ou similares, certifique-se de realizar essas alterações conforme manual de cada servidor

No arquivo de configuração do PHP, o php.ini edite/adicione as seguintes opções:

    memory_limit = 512M ( ou -1 para sem limite )
    post_max_size = 125M
    upload_max_filesize = 30M

No ubuntu 22.04, esse aquivo fica localizado em /etc/php/{8.x}/cli, onde {8.x} reprensenta alguma versão do php, 8.0, 8.1, etc.

para editar, basta digitar no terminal, com permissão elevada de superusuário:

`sudo nano /etc/php/8.1/cli` ou `sudo gedit /etc/php/8.1/cli` para php 8.1


## Composer
Para instalação do composer

    cd ~  
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    sudo php composer-setup.php  --install-dir=/usr/local/bin --filename=composer

## Instalação das denpendências do Projeto
Dentro do da pasta backend, encontrada no projeto,  obtenha as dependências com o composer instalado anteriormente,

    cd backend

    composer install

Faça uma copia do arquivo .env

*linha de comando ou via gerenciador de arquivos de sua preferência

    cp .env.example .env

## Sistema Gerenciador de Banco de dados (MariaDB/Mysql)

Um bom tutorial para a instalação pode ser encontrado aqui na [DigitalOcean](https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-ubuntu-22-04)

Edite o arquivo .env, especificando o SGBD, banco de dados e usuário/senha

Após isso, execute as migrações
Via linha de comando:

    php artisan migrate:fresh --seed

    php artisan key:generate

    php artisan passport:install

    php artisan passport:client --personal --no-interaction

Iniciar o servidor (Server for development)

     php artisan serve

Acessar via POST http://127.0.0.1:8000/api/login enviando as credenciais:

    {
    	"email":"test@example.com"
    	"password": "password"
    }
A resposta desta requisição trará um token (bearer token) que deverá ser usado em todas as requisições autenticadas.

A rotas estão descritas no arquivo routes/api.php;
Uma rota de exemplo é a GET http://127.0.0.1:8000/api/disciplines

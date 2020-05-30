# educara-web
Educara Web - Realidade Aumentada no Ensino Médio - [BACK-END]

# Project setup
Projeto requer PHP > 7.2, composer e banco de dados Mysql.

Instalar e seguir os seguintes comandos

Faça uma copia do arquivo .env

*linha de comando ou via gerenciador de arquivos de sua preferência

cp .env.example .env

Edite o arquivo .env, especificando o SGBD, banco de dados e usuário/senha

Via linha de comando:

composer install

php artisan migrate:seed

php artisan key:generate

php artisan passport:install

Iniciar o servidor (Server for development)

php artisan serve

Acessar via http://127.0.0.1:8000

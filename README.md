## Configuração Inicial
## FRONTEND
cd frontend
npm i
npm start


## BACKEND
cd backend

### Crie o arquivo .env baseado no .env.example e configure as variáveis de ambiente, incluindo as configurações do banco de dados.

### Inicie os contêineres Docker usando Laravel Sail:
./vendor/bin/sail up

### Crie a key do projeto
php artisan key:generate

### Instale as dependências do Composer:
composer install

## EXECUTANDO TESTES 
### Para executar os testes do Laravel, utilize o comando Artisan:

php artisan test

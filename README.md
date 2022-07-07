# Requirements

- PHP CLI
- Symfony CLI
- Composer
- Postgresql

# Configuration base de donnée

- Installer Postgresql
- Configurer les identifiants dans .env

# Installation

Executer les commandes

- composer install
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:update --force
- symfony server:start

Accès à l'api via http://localhost:8000/api
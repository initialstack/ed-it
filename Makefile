USER_ID ?= 1000
GROUP_ID ?= 1000

# Execute all commands sequentially
setup: up-build env-prepare composer-install key-generate migrate-seed intervals-list

# Deploy the project
all: setup

# Start containers and build images
up-build:
	docker compose up --build -d --remove-orphans

# Start containers
up:
	docker compose up -d

# Copy .env.example to .env
env-prepare:
	cp .env.example .env

# Install Composer dependencies
composer-install:
	composer install

# Generate application key
key-generate:
	docker compose exec app php artisan key:generate

# Refresh and seed the database
migrate-seed:
	docker compose exec app php artisan migrate:fresh --seed

# Execute the intervals:list command
intervals-list:
	docker compose exec app php artisan intervals:list --left=1 --right=1000

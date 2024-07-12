.PHONY: help build up quality

help:
	@echo "make [build, up, quality]"

build:
	@docker compose build

up:
	@composer install
	@docker compose up -d
	@echo "http://localhost:8080"

quality:
	@php vendor/bin/phpstan analyze 
	@php vendor/bin/phpunit ./tests
.PHONY: help build up

help:
	@echo "make [build, up]"

build:
	@docker compose build

up:
	@composer install
	@docker compose up -d
	@echo "http://localhost:8080"

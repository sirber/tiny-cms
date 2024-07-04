.PHONY: build up

help:
	@echo "make [build, up]"

build:
	@docker compose build

up:
	@docker compose up -d
	@echo "http://localhost:8080"

COMPOSE_CMD := docker compose

##@ [Docker]
.PHONY: build
build: ## Build de development container
	@$(COMPOSE_CMD) build

.PHONY: up
up: ## Ups the container
	@$(COMPOSE_CMD) up -d
	@$(COMPOSE_CMD) exec php composer install --no-progress

.PHONY: down
down: ## Downs the container
	@$(COMPOSE_CMD) down --remove-orphans

.PHONY: start
start: ## Starts the container
	@$(COMPOSE_CMD) start

.PHONY: stop
stop: ## Stops the container
	@$(COMPOSE_CMD) stop

.PHONY: cli
cli: ## Launch a cli inside the container
	@$(COMPOSE_CMD) exec -it php sh

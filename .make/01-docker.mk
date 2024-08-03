# Define variables for commands
PODMAN_CMD := $(shell command -v podman 2>/dev/null)
DOCKER_CMD := $(shell command -v docker 2>/dev/null)
COMPOSE_CMD :=

# Determine which command to use for compose
ifeq ($(PODMAN_CMD),)
  ifeq ($(DOCKER_CMD),)
    $(error Neither podman nor docker is installed)
  else
    COMPOSE_CMD := docker compose
  endif
else
  COMPOSE_CMD := podman compose
endif

##@ [Docker]
.PHONY: build
build:
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

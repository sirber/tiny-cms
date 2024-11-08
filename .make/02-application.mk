##@ [Application]
.PHONY: quality
quality: ## Cleanup the project
	@docker compose exec php /app/vendor/bin/phpstan analyze
	@docker compose exec php /app/vendor/bin/php-cs-fixer fix src

.PHONY: test
test: ## Run tests
	@docker compose exec php /app/vendor/bin/phpunit ./tests
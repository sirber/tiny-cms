##@ [Application]
.PHONY: quality
quality: ## Cleanup the project
	@docker compose exec php /app/vendor/bin/phpstan analyze 
	@docker compose exec php /app/vendor/bin/phpunit ./tests
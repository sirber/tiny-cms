##@ [Continuous Integration]
.PHONY: ci-quality
ciquality: ## Cleanup the project
	@php ./vendor/bin/phpstan analyze

.PHONY: test
citest: ## Run tests
	@php ./vendor/bin/pest ./tests

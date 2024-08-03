# @see https://tech.davis-hansson.com/p/make/ for some make best practices
SHELL := bash
.SHELLFLAGS := -euo pipefail -c
MAKEFLAGS += --warn-undefined-variables
MAKEFLAGS += --no-builtin-rules

DEFAULT_GOAL := help

help: ## Display this help
	@awk -f .make/help.awk $(MAKEFILE_LIST)

-include .make/*.mk
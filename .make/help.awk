# AWK script to parse Makefiles and extract targets and their descriptions
# Source: https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
BEGIN {
	FS = ": .*+##[[:space:]]*"
	printf "\n\033[33;1mUsage:\033[0m\n  make \033[36m<target>\033[0m\n"
	printf "\n\033[33;1mAvailable commands\033[0m\n"
}
/^[[:alnum:]\\\\:]+: .*?##/ {
	gsub(/\\:/, ":", $1)
	printf "  \033[36m%-30s\033[0m %s\n", $1, $2
}
/^##@/ {
	printf "\n\033[33;1m%s\033[0m\n", substr($0, 5)
}
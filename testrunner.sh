#!/usr/bin/env bash
set -u

watch_dir=tests
if [[ $# -gt 0 ]]; then
    watch_dir=${1}
fi

vendor/bin/testrunner phpunit -p bootstrap.php -a src -a ${watch_dir}


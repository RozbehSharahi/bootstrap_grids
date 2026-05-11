#!/usr/bin/env bash

set -e

ensure_docker_env_file() {
    if [[ ! -f ".docker/.env" ]]; then
        echo "Creating file '.docker/.env' since it didn't exist: cp .docker/.env.dist .docker/.env"
        cp .docker/.env.dist .docker/.env
    fi
}

load_docker_env() {
    ensure_docker_env_file
    set -a
    source .docker/.env
    set +a
}

set_composer_ignore_platform_arg() {
    # If env var COMPOSER_IGNORE_PLATFORM_REQ is set, pass --ignore-platform-req to Composer with value of COMPOSER_IGNORE_PLATFORM_REQ.
    COMPOSER_IGNORE_PLATFORM_ARG=()
    if [[ -n "${COMPOSER_IGNORE_PLATFORM_REQ:-}" ]]; then
        COMPOSER_IGNORE_PLATFORM_ARG=(--ignore-platform-req="${COMPOSER_IGNORE_PLATFORM_REQ}")
    fi
}

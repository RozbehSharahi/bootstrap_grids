#!/usr/bin/env bash

set -e

ensure_docker_env_file() {
    if [[ ! -f ".docker/.env" ]]; then
        echo "Creating file '.docker/.env' since it didn't exist: cp .docker/.env.example .docker/.env"
        cp .docker/.env.example .docker/.env
    fi
}

load_docker_env() {
    ensure_docker_env_file
    set -a
    source .docker/.env
    USER_ID="${USER_ID:-$(id -u)}"
    GROUP_ID="${GROUP_ID:-$(id -g)}"
    set +a
}

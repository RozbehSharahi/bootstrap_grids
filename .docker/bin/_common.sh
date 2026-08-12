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

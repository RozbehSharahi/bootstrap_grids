# TYPO3 Extension "bootstrap_grids"

Predefined gridelements for bootstrap: Column grids, grids for simple accordions, tabs.

## Note for TYPO12

At the time of writing, TYPO3 12 compatibility is a work-in-progress but will be released very soon. In the meantime, it
is possible to use the `main` branch as a dependency to install it for TYPO3 12.

```json
{
  "require": {
    "laxap/bootstrap-grids": "dev-main"
  }
}
```

## Note for update to v5

The paths of TypoScript files have changed. Please ensure you reselect the template in your `sys_template` record.

## Contribution

You will need docker installed for easy contribution and dev-setup.

To start dev environment

```shell
.docker/bin/start
```

To stop dev environment

```shell
.docker/bin/stop
```

Entering the container

```shell
.docker/bin/cli
```

Run composer commands in container (e.g. `./docker/bin/composer install`)

```shell
.docker/bin/composer [command]
```

Run `vendor/bin/typo3` commands in container (e.g. `./docker/bin/typo3 cache:flush`)

```shell
.docker/bin/typo3 [command]
```
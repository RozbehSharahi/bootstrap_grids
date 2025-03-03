# TYPO3 Extension "bootstrap_grids"

Predefined `gridelements` Bootstrap 5 content elements: column grids, grids for simple accordions, and tabs.

## Note for TYPO3 12

At the time of writing, TYPO3 12 compatibility is a work-in-progress but will be released very soon. In the meantime, it
is possible to use the `master` branch as a dependency to install it for TYPO3 12.

```json
{
  "require": {
    "laxap/bootstrap-grids": "dev-master"
  }
}
```

## Updating to `bootstrap_grids` v5

The paths of TypoScript files have changed. Please ensure you reselect the template in your `sys_template` record.

## Contribution

You will need Docker installed for easy contribution and dev setup. `.docker/.env.dist` file will automatically be
copied to `.docker/.env` on start up. Feel free to adjust `.docker/.env` to your needs. 

### Docker scripts

To start dev environment

```shell
.docker/bin/start
```

To stop dev environment

```shell
.docker/bin/stop
```

Enter the dev environment container

```shell
.docker/bin/cli
```

Run `composer` commands (e.g. `./docker/bin/composer install`)

```shell
.docker/bin/composer [command]
```

Run `vendor/bin/typo3` commands (e.g. `.docker/bin/typo3 cache:flush`)

```shell
.docker/bin/typo3 [command]
```

Run `docker compose` commands (e.g. `./docker/bin/compose up -d --build`)

```shell
.docker/bin/compose [command]
```

Cleanup environment to remove all auto-generated files and reset the database to its initial state using the starting 
point in `.docker/templates/database/database.sqlite`.

```shell
.docker/bin/clean && .docker/bin/start
```
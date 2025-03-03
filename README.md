# TYPO3 Extension "bootstrap_grids"

Predefined `gridelements` Bootstrap 5 content elements: column grids, grids for simple accordions, and tabs.

## Updating to `bootstrap_grids` v5

The paths of TypoScript files have changed. Please ensure you reselect the template in your `sys_template` record.

## Contribution

You will need Docker installed for easy contribution and dev setup. `.docker/.env.dist` file will automatically be
copied to `.docker/.env` on start up. Feel free to adjust `.docker/.env` to your needs. 

### Docker scripts

| Command                                  | Description                                                                                                                                                                                                                   |
|------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `.docker/bin/start`                      | To start dev environment                                                                                                                                                                                                      |
| `.docker/bin/stop`                       | To stop dev environment                                                                                                                                                                                                       |
| `.docker/bin/clean`                      | Does `docker compose down --remove-orphans` and cleans up environment removing all auto-generated files and resets the database to its initial state using the starting point in `.docker/templates/database/database.sqlite` |
| `.docker/bin/logs`                       | Runs `.docker/bin/compose logs -f`                                                                                                                                                                                            |
| `.docker/bin/cli`                        | Enter the dev environment container                                                                                                                                                                                           |
| `.docker/bin/composer [command]`         | Runs `composer` commands (e.g. `./docker/bin/composer install`)                                                                                                                                                               |
| `.docker/bin/typo3 [command]`            | Runs `vendor/bin/typo3` commands (e.g. `.docker/bin/typo3 cache:flush`)                                                                                                                                                       |
| `.docker/bin/compose [command]`          | Runs `docker compose` commands (e.g. `./docker/bin/compose up -d --build`)                                                                                                                                                    |

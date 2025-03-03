# TYPO3 Extension "bootstrap_grids"

Predefined `gridelements` Bootstrap 5 content elements: column grids, grids for simple accordions, and tabs.


## Installation

1. Install the extension via composer: `composer require laxap/bootstrap-grids`. If `gridelements` is not installed, it will be installed automatically since it's a requirement.
2. Include the [static TypoScript templates](Documentation/Images/IncludeStatic.png). Both `bootstrap_grids` and `gridelements` templates are required (the order of templates is important).

## Usage

Use one of the [predefined grids](Documentation/Images/Screenshot.png) on your website.

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

## Change log

### Version 5.0.0

- UPDATED: Switched to Bootstrap 5

### Version 3.0.0

- REMOVED: Optional row gridelement

### Version 2.0.0

- UPDATED: Switched to Bootstrap 4
- REMOVED: Slider grid element and flexslider script

### Version 1.3.0

- ADDED: 2-/3-/4-columns grid `itemProcFunc` for select items
- ADDED: Optional row gridelement

### Version 1.2.0

- ADDED: Backend, drag & drop support: default col-md-6/4/3 classes are used for the column divs in the frontend if a gridelement is dragged into the page without editing it.
- UPDATED: Changed from empty to a blank character for the 2-/3-/4-columns grid the `not set` option value of the desktop column classes (first tab).
- REMOVED: Optional support for old record based grid definitions removed
- REMOVED: Optional row gridelement

## Special thanks

- [Daniel Corn](https://www.cundd.net): Defining the grids via pageTS brings a lot of advantages.
- [Josef Körner](https://www.brandical.de): For reducing the accordion TypoScript setup.

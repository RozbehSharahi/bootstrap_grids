# TYPO3 extension "bootstrap_grids"

Predefined `gridelements` Bootstrap 5 content elements: column grids, grids for simple accordions, and tabs.

## Installation

1. Install the extension via composer: `composer require laxap/bootstrap-grids`. If `gridelements` is not installed, it will be installed automatically since it's a requirement.
2. Include the [static TypoScript templates](Documentation/Images/IncludeStatic.png). Both `bootstrap_grids` and `gridelements` templates are required (the order of templates is important).

![static TypoScript templates](Documentation/Images/IncludeStatic.png)

_NOTE: As of 2025-03-03, `gridelements` v12 doesn't support PHP 8.4, but we have an issue open they are responding to fix that. So, we will preemptively support PHP 8.4 in anticipation of that fix._

## Usage

Use one of the [predefined grids](Documentation/Images/Screenshot.png) on your website.

![predefined grids](Documentation/Images/Screenshot.png)

_NOTE: When using "Tabs From Content Elements" and "Accordion From Content", you need to [set the header Type to Hidden](Documentation/Images/HeaderTypeHidden.png). If you don't then the accordion/tab title will also display as a heading tag in the content area._

![set the header Type to Hidden](Documentation/Images/HeaderTypeHidden.png)

## Updating to `bootstrap_grids` v5

The paths of TypoScript files have changed. Please ensure you reselect the template in your `sys_template` record.

## Contribution

We would love your help! We have Docker set up with helper scripts to make contributions easy.

### Development setup

1. Install [Docker](https://www.docker.com/).
2. Fork the [boostrap_grids repository](https://github.com/laxap/bootstrap_grids.git).
3. Clone the forked repository (e.g. `git clone https://github.com/your_username/bootstrap_grids.git`), change into the directory, then checkout a branch or create desired branch.
4. OPTIONAL: Set `WWW_TYPO3_VERSION=12` (or `14`) in `.docker/.env` (create the file if it doesn't exist yet) if you want to test against TYPO3 v12 or v14 instead of the default v13.
5. OPTIONAL: Start Xdebug if you need to debug PHP code.
6. Run `.docker/bin/start`.
7. Login at the printed TYPO3 URL with `admin` / `Password123_`.

The stack is PHP 8.3 (nginx + php-fpm) with a MariaDB database. On first start, `bootstrap-grids:setup-settings` and `bootstrap-grids:setup-database` (in `Classes/Command`) automatically generate `config/system/settings.php`, a site config, a root page with the required static TypoScript templates already included, an admin backend user, and one example Grid Element per supported layout (2/3/4 columns, tabs, tabs from content elements, accordion) with dummy content, so there is already something to look at on the front page — no manual TYPO3 install-tool wizard or TypoScript setup needed. Ports are randomly assigned per checkout and written to `.docker/.env`; `.docker/bin/start` prints the URLs to use.

_NOTE: `WWW_TYPO3_VERSION=14` builds against gridelements' `ea_14-0` early-access branch (private GitHub repo, priority access). It resolves via Composer only if you personally have access to that repo and have your own GitHub credentials configured locally for Composer (e.g. a `github-oauth` token in your global `auth.json`, or a `COMPOSER_AUTH`/`GITHUB_TOKEN` environment variable) — nothing is or should be committed to this repo for that. Without access, stick to the default v13 or use v12._

Both setup commands refuse to run unless `TYPO3_CONTEXT` starts with `Development/BootstrapGrids/Docker` (the context `.docker/compose.base.yml` sets), so they are inert outside this Docker dev environment.

![Development Site For Bootstrap Grids](Documentation/Images/DevelopmentSiteForBootstrapGrids.png)

### Switching TYPO3 versions

`WWW_TYPO3_VERSION` is only read when the `www` image is built, so just changing it in `.docker/.env` and running `.docker/bin/start` again won't switch anything if the image already exists. `.docker/bin/reset` is the clean way to switch: it stops the environment, wipes `vendor/`, `public/`, `var/`, `config/`, `composer.lock` and the database volume, then rebuilds and starts fresh against whatever `WWW_TYPO3_VERSION` is currently set to.

```
WWW_TYPO3_VERSION=12 .docker/bin/reset
```

(or set `WWW_TYPO3_VERSION` in `.docker/.env` beforehand and just run `.docker/bin/reset` — both work the same way, since it's read via normal Docker Compose variable interpolation). Note that this **wipes the database** — there is no in-place migration between TYPO3 major versions here, each version starts from a fresh install with the example fixtures reseeded.

### Docker scripts

| Command                          | Description                                                                                     |
|-----------------------------------|---------------------------------------------------------------------------------------------------|
| `.docker/bin/start`              | Build and start the dev environment, then run the post-start setup (settings/database/cache)      |
| `.docker/bin/stop`               | Stop the dev environment                                                                          |
| `.docker/bin/reset`              | Stop, wipe `vendor/`, `public/`, `var/`, `config/`, `composer.lock` and the DB volume, then start again |
| `.docker/bin/logs`               | Tail logs for all services                                                                        |
| `.docker/bin/www-logs`           | Tail logs for the `www` service only                                                              |
| `.docker/bin/www-cli`            | Enter the `www` container                                                                         |
| `.docker/bin/www-composer [cmd]` | Runs `composer` commands inside the container (e.g. `.docker/bin/www-composer install`)           |
| `.docker/bin/www-console [cmd]`  | Runs `vendor/bin/typo3` commands (e.g. `.docker/bin/www-console cache:flush`)                      |
| `.docker/bin/www-cache-clear`    | Flushes the TYPO3 cache                                                                           |
| `.docker/bin/print-urls`         | Prints the frontend/backend URLs and login credentials                                            |
| `.docker/bin/compose [command]`  | Runs `docker compose` commands directly (e.g. `.docker/bin/compose up -d --build`)                |

## Change log

- See the [release notes](https://github.com/RozbehSharahi/bootstrap_grids/releases).

## Special thanks

- [Charles Coleman](https://github.com/outdoorsman) Constantly pushing me on continuation and supporting me on updates
- [Daniel Corn](https://www.cundd.net): Defining the grids via pageTS brings a lot of advantages.
- [Josef Körner](https://www.brandical.de): For reducing the accordion TypoScript setup.

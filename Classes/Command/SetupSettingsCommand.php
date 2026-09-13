<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Core\Environment;

#[AsCommand(name: 'bootstrap-grids:setup-settings', hidden: true)]
class SetupSettingsCommand extends Command
{
    /**
     * Must match the TYPO3_CONTEXT set in .docker/compose.base.yml - this
     * command must never run outside the docker dev environment.
     */
    private const DOCKER_CONTEXT = 'Development/BootstrapGrids/Docker';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!str_starts_with((string) Environment::getContext(), self::DOCKER_CONTEXT)) {
            return Command::SUCCESS;
        }

        $this
            ->createSettingsIfNotPresent($output)
            ->createSiteConfigIfNotPresent($output)
            ->createFileadminIfNotPresent($output);
        $output->writeln('Settings created.');

        return Command::SUCCESS;
    }

    private function createSettingsIfNotPresent(OutputInterface $output): self
    {
        $targetDirectory = Environment::getProjectPath() . '/config/system';
        $targetFile = $targetDirectory . '/settings.php';

        if (file_exists($targetFile)) {
            $output->writeln('Skipping settings creation, as they already exist.');
            return $this;
        }

        if (!mkdir($targetDirectory, 0777, true) && !is_dir($targetDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetDirectory));
        }

        file_put_contents(
            $targetFile,
            '<?php return ' . var_export($this->getTypo3Configuration(), true) . ';'
        );

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    private function getTypo3Configuration(): array
    {
        return [
            'BE' => [
                'debug' => true,
                'explicitADmode' => 'explicitAllow',
                'installToolPassword' => '$argon2id$v=19$m=65536,t=4,p=1$SnZjQ2t3bWxPZ3dhNFZ1Uw$4KFFgscnksd5CR5U/o5TesrEY12sIYm5Tcwr5i/CZZs',
                'passwordHashing' => [
                    'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2idPasswordHash',
                    'options' => [],
                ],
            ],
            'DB' => [
                'Connections' => [
                    'Default' => [
                        'charset' => 'utf8',
                        'driver' => 'pdo_mysql',
                        'host' => 'db',
                        'dbname' => 'db',
                        'user' => 'db',
                        'password' => 'db',
                        'port' => 3306,
                    ],
                ],
            ],
            'FE' => [
                'debug' => true,
            ],
            'SYS' => [
                'devIPmask' => '*',
                'displayErrors' => 1,
                'encryptionKey' => '3c716dbed9ab0aa69ec3cf556221a8022b6bb86f3481df3e309b0fce5c8c398ac06852705e91f8fe8bd88a8db896ed8a',
                'exceptionalErrors' => 4096,
                'features' => [
                    'yamlImportsFollowDeclarationOrder' => true,
                ],
                'sitename' => 'Bootstrap Grids Dev',
                'trustedHostsPattern' => '.*',
            ],
            'EXTENSIONS' => [
                'backend' => [
                    'backendFavicon' => '',
                    'backendLogo' => '',
                    'loginBackgroundImage' => '',
                    'loginFootnote' => '',
                    'loginHighlightColor' => '',
                    'loginLogo' => '',
                    'loginLogoAlt' => '',
                ],
                'gridelements' => [
                    'additionalStylesheet' => '',
                    'disableAutomaticUnusedColumnCorrection' => '0',
                    'disableCopyFromPageButton' => '0',
                    'disableDragInWizard' => '0',
                    'fluidBasedPageModule' => '0',
                    'nestingInListModule' => '0',
                    'overlayShortcutTranslation' => '0',
                ],
            ],
        ];
    }

    private function createSiteConfigIfNotPresent(OutputInterface $output): self
    {
        $targetFile = Environment::getProjectPath() . '/config/sites/main/config.yaml';

        if (file_exists($targetFile)) {
            $output->writeln('Skipping site config creation, as it already exists.');
            return $this;
        }

        $targetDirectory = dirname($targetFile);

        if (!mkdir($targetDirectory, 0777, true) && !is_dir($targetDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetDirectory));
        }

        file_put_contents($targetFile, Yaml::dump([
            'base' => '%env(BASE_URL)%',
            'languages' => [[
                'title' => 'English',
                'enabled' => true,
                'locale' => 'en_US.UTF-8',
                'iso-639-1' => 'en',
                'hreflang' => 'en-US',
                'direction' => 'ltr',
                'base' => '/',
                'websiteTitle' => 'Development Site For Bootstrap Grids',
                'navigationTitle' => 'English',
                'flag' => 'us',
                'languageId' => 0,
            ]],
            'errorHandling' => [],
            'routes' => [],
            'rootPageId' => 1,
            'websiteTitle' => 'Development Site For Bootstrap Grids',
        ], 4));

        return $this;
    }

    private function createFileadminIfNotPresent(OutputInterface $output): self
    {
        $path = Environment::getPublicPath() . '/fileadmin';

        if (file_exists($path)) {
            $output->writeln('Skipping fileadmin creation, as it already exists.');
            return $this;
        }

        if (!mkdir($path, 0777, true) && !is_dir($path)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }

        return $this;
    }
}

<?php

namespace Carbon;

use Composer\Composer;
use Composer\Config;
use Composer\IO\ConsoleIO;
use Composer\Script\Event as ScriptEvent;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use UpdateHelper\UpdateHelper;
use UpdateHelper\UpdateHelperInterface;

class Upgrade implements UpdateHelperInterface
{
    const ASK_ON_UPDATE = false;
    const SUGGEST_ON_UPDATE = false;

    protected static $laravelLibraries = array(
        'laravel/framework' => '5.8.0',
        'laravel/cashier' => '9.0.1',
        'illuminate/support' => '5.8.0',
        'laravel/dusk' => '5.0.0',
    );

    protected static $otherLibraries = array(
        'spatie/laravel-analytics' => '3.6.4',
        'jenssegers/date' => '3.5.0',
    );

    /**
     * @param \UpdateHelper\UpdateHelper $helper
     */
    public function check(UpdateHelper $helper)
    {
        $helper->write(array(
            'Carbon 1 is deprecated, see how to migrate to Carbon 2.',
            'https://carbon.nesbot.com/docs/#api-carbon-2',
        ));

        if (static::SUGGEST_ON_UPDATE || static::ASK_ON_UPDATE || $helper->getIo()->isVerbose()) {
            $laravelUpdate = array();

            foreach (static::$laravelLibraries as $name => $version) {
                if ($helper->hasAsDependency($name) && $helper->isDependencyLesserThan($name, $version)) {
                    $laravelUpdate[$name] = $version;
                }
            }

            if (count($laravelUpdate)) {
                $output = array(
                    '    Please consider upgrading your Laravel dependencies to be compatible with Carbon 2:',
                );

                foreach ($laravelUpdate as $name => $version) {
                    $output[] = "      - $name at least to version $version";
                }

                $output[] = '';
                $output[] = "    If you can't update Laravel, check https://carbon.nesbot.com/ to see how to";
                $output[] = '    install Carbon 2 using alias version and our adapter kylekatarnls/laravel-carbon-2';
                $output[] = '';

                $helper->write($output);
            }

            foreach (static::$otherLibraries as $name => $version) {
                if ($helper->hasAsDependency($name) && $helper->isDependencyLesserThan($name, $version)) {
                    $helper->write("    Please consider upgrading $name at least to $version to be compatible with Carbon 2.\n");
                }
            }

            if (static::ASK_ON_UPDATE) {
                static::askForUpgrade($helper);

                return;
            }
        }

        $path = implode(DIRECTORY_SEPARATOR, array('.', 'vendor', 'bin', 'upgrade-carbon'));

        if (!file_exists($path)) {
            $path = realpath(__DIR__.'/../../bin/upgrade-carbon');
        }

        $helper->write(
            '    You can run '.escapeshellarg($path).
            ' to get help in updating carbon and other frameworks and libraries that depend on it.'
        );
    }

    private static function getUpgradeQuestion($upgrades)
    {
        $message = "Do you want us to try the following upgrade:\n";

        foreach ($upgrades as $name => $version) {
            $message .= "  - $name: $version\n";
        }

        return $message.'[Y/N] ';
    }

    public static function askForUpgrade(UpdateHelper $helper, $upgradeIfNotInteractive = false)
    {
        $upgrades = array(
            'nesbot/carbon' => '^2.0.0',
        );

        foreach (array(static::$laravelLibraries, static::$otherLibraries) as $libraries) {
            foreach ($libraries as $name => $version) {
                if ($helper->hasAsDependency($name) && $helper->isDependencyLesserThan($name, $version)) {
                    $upgrades[$name] = "^$version";
                }
            }
        }

        $shouldUpgrade = $helper->isInteractive()
            ? $helper->getIo()->askConfirmation(static::getUpgradeQuestion($upgrades))
            : $upgradeIfNotInteractive;

        if ($shouldUpgrade) {
            $helper->setDependencyVersions($upgrades)->update();
        }
    }

    public static function upgrade(ScriptEvent $event = null)
    {
        if (!$event) {
            $composer = new Composer();
            $baseDir = __DIR__.'/../..';

            if (file_exists("$baseDir/autoload.php")) {
                $baseDir .= '/..';
            }

            $composer->setConfig(new Config(true, $baseDir));
            $event = new ScriptEvent(
                'upgrade-carbon',
                $composer,
                new ConsoleIO(new StringInput(''), new ConsoleOutput(), new HelperSet(array(
                    new QuestionHelper(),
                )))
            );
        }

        static::askForUpgrade(new UpdateHelper($event), true);
    }
}

<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets\console\controllers;

use Craft;
use putyourlightson\secrets\Secrets;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\BaseConsole;

/**
 * Allows you to manage encrypted secrets in the vault.
 */
class VaultController extends Controller
{
    /**
     * Adds or overwrites a key/value pair.
     */
    public function actionAdd(string $key, string $value): int
    {
        Secrets::$plugin->vault->addValue($key, $value);

        $this->stdout(Craft::t('secrets', 'Value successfully added.') . PHP_EOL, BaseConsole::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Deletes the value of a provided key.
     */
    public function actionDelete(string $key): int
    {
        Secrets::$plugin->vault->deleteValue($key);

        $this->stdout(Craft::t('secrets', 'Value successfully deleted.') . PHP_EOL, BaseConsole::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Reveals all values, or the value of a provided key.
     */
    public function actionReveal(string $key = null): int
    {
        if ($key === null) {
            $data = Secrets::$plugin->vault->getData();

            if (empty($data)) {
                $this->stdout('No values exist.' . PHP_EOL, BaseConsole::FG_RED);
            }
            else {
                foreach ($data as $key => $value) {
                    $this->stdout($key . ': ' . $value . PHP_EOL, BaseConsole::FG_GREEN);
                }
            }

            return ExitCode::OK;
        }

        $value = Secrets::$plugin->vault->getValue($key);

        if ($value === null) {
            $this->stdout('No value with the key "' . $key . '" exists.' . PHP_EOL, BaseConsole::FG_RED);
        }
        else {
            $this->stdout($key . ': ' . $value . PHP_EOL, BaseConsole::FG_GREEN);
        }

        return ExitCode::OK;
    }
}

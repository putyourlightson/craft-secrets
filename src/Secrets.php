<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets;

use craft\base\Plugin;
use putyourlightson\secrets\models\SettingsModel;
use putyourlightson\secrets\services\StorageService;
use putyourlightson\secrets\services\VaultService;

/**
 * @property StorageService $storage
 * @property VaultService $vault
 * @property SettingsModel $settings
 */
class Secrets extends Plugin
{
    /**
     * @var Secrets
     */
    public static $plugin;

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->setComponents([
            'storage' => StorageService::class,
            'vault' => VaultService::class,
        ]);
    }

    public static function getValue(string $key, $default = null)
    {
        return self::$plugin->vault->getValue($key, $default);
    }

    protected function createSettingsModel(): SettingsModel
    {
        return new SettingsModel();
    }
}

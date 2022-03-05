<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets\models;

use Craft;
use craft\base\Model;
use craft\helpers\App;

class SettingsModel extends Model
{
    /**
     * @var string The path of the encrypted secrets file.
     */
    public string $filePath = '';

    /**
     * @var string The key to use for encryption and decryption.
     */
    public string $encryptionKey = '';

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        // Set default values, which config settings may override.
        $this->filePath = App::parseEnv('@config/secrets.enc');
        $this->encryptionKey = Craft::$app->config->general->securityKey;
    }
}

<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets\models;

use Craft;
use craft\base\Model;

class SettingsModel extends Model
{
    /**
     * @var string The path of the encrypted secrets file.
     */
    public $filePath;

    /**
     * @var string The key to use for encryption and decryption.
     */
    public $encryptionKey;

    public function init()
    {
        parent::init();

        $this->filePath = Craft::parseEnv('@config/secrets.enc');
        $this->encryptionKey = Craft::$app->config->general->securityKey;
    }
}

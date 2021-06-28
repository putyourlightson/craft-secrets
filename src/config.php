<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

/**
 * Secrets config.php
 *
 * This file exists only as a template for the Secrets settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'secrets.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    '*' => [
        // The path of the encrypted secrets file.
        //'filePath' => \Craft::parseEnv('@config/secrets.enc'),

        // The key to use for encryption and decryption.
        //'encryptionKey' => \Craft::$app->config->general->securityKey,
    ],
];

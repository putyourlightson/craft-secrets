<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets\services;

use craft\base\Component;
use putyourlightson\secrets\Secrets;

/**
 * @property-read  string $contents
 */
class StorageService extends Component
{
    public function getContents(): string
    {
        $filePath = Secrets::$plugin->settings->filePath;

        if (!file_exists($filePath)) {
            return '';
        }

        return file_get_contents($filePath);
    }

    public function saveContents(string $contents)
    {
        $filePath = Secrets::$plugin->settings->filePath;

        file_put_contents($filePath, $contents);
    }
}

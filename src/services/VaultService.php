<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets\services;

use Craft;
use craft\base\Component;
use putyourlightson\secrets\Secrets;

/**
 * @property-read array $data
 */
class VaultService extends Component
{
    /**
     * @var null|array
     */
    private ?array $_data = null;

    /**
     * Returns the value from the vault.
     */
    public function getValue(string $key, $default = null): ?string
    {
        $data = $this->getData();

        return $data[$key] ?? $default;
    }

    /**
     * Adds the value to the vault.
     */
    public function addValue(string $key, string $value)
    {
        $data = $this->getData();
        $data[$key] = $value;

        $this->_save($data);
    }

    /**
     * Deletes the value from the vault.
     */
    public function deleteValue(string $key)
    {
        $data = $this->getData();

        if (isset($data[$key])) {
            unset($data[$key]);
        }

        $this->_save($data);
    }

    /**
     * Returns all values from the vault.
     */
    public function getData(): array
    {
        if ($this->_data !== null) {
            return $this->_data;
        }

        $this->_data = [];
        $contents = Secrets::$plugin->storage->getContents();

        if (empty($contents)) {
            return $this->_data;
        }

        $json = Craft::$app->security->decryptByKey($contents, Secrets::$plugin->settings->encryptionKey);
        $this->_data = json_decode($json, true);

        return $this->_data;
    }

    private function _save(array $data)
    {
        $json = json_encode($data);
        $contents = Craft::$app->security->encryptByKey($json, Secrets::$plugin->settings->encryptionKey);

        Secrets::$plugin->storage->saveContents($contents);
    }
}

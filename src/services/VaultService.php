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
     * @var array
     */
    private $_data;

    public function getValue(string $key, $default = null)
    {
        $data = $this->getData();

        return $data[$key] ?? $default;
    }

    public function addValue(string $key, string $value)
    {
        $data = $this->getData();
        $data[$key] = $value;

        $this->_save($data);
    }

    public function deleteValue(string $key)
    {
        $data = $this->getData();

        if (isset($data[$key])) {
            unset($data[$key]);
        }

        $this->_save($data);
    }

    public function getData()
    {
        if ($this->_data !== null) {
            return $this->_data;
        }

        $this->_data = [];

        $contents = Secrets::$plugin->storage->getContents();
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

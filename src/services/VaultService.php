<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\secrets\services;

use Craft;
use craft\base\Component;
use putyourlightson\secrets\Secrets;

class VaultService extends Component
{
    private ?array $data = null;

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
    public function addValue(string $key, string $value): void
    {
        $data = $this->getData();
        $data[$key] = $value;

        $this->save($data);
    }

    /**
     * Deletes the value from the vault.
     */
    public function deleteValue(string $key): void
    {
        $data = $this->getData();

        if (isset($data[$key])) {
            unset($data[$key]);
        }

        $this->save($data);
    }

    /**
     * Returns all values from the vault.
     */
    public function getData(): array
    {
        if ($this->data !== null) {
            return $this->data;
        }

        $this->data = [];
        $contents = Secrets::$plugin->storage->getContents();

        if (empty($contents)) {
            return $this->data;
        }

        $json = Craft::$app->security->decryptByKey($contents, Secrets::$plugin->settings->encryptionKey);
        $this->data = json_decode($json, true);

        return $this->data;
    }

    private function save(array $data): void
    {
        $json = json_encode($data);
        $contents = Craft::$app->security->encryptByKey($json, Secrets::$plugin->settings->encryptionKey);

        Secrets::$plugin->storage->saveContents($contents);
    }
}

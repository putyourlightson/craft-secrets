[![Stable Version](https://img.shields.io/packagist/v/putyourlightson/craft-secrets?label=stable)]((https://packagist.org/packages/putyourlightson/craft-secrets))
[![Total Downloads](https://img.shields.io/packagist/dt/putyourlightson/craft-secrets)](https://packagist.org/packages/putyourlightson/craft-secrets)

<p align="center"><img width="130" src="https://raw.githubusercontent.com/putyourlightson/craft-secrets/develop/src/icon.svg"></p>

# Secrets Plugin for Craft CMS

The Secrets plugin allows you to store and manage secrets in an encrypted file. There are some benefits to storing secrets this way, instead of the conventional approach of storing them as plaintext in the `.env` file.

1. Secrets are encrypted and cannot be revealed without the encryption key.
2. The encrypted file can be committed to your repository, meaning you avoid having to send secrets in plaintext to other developers. You also end up with a history of changes to the file.
3. If secrets change or are rotated then there is only one file that needs to be updated. 

## Usage

```php
use putyourlightson\secrets\Secrets;

// Returns the value of the `apiKey` secret.
Secrets::getValue('apiKey');

// Returns the value of the `apiKey` secret, defaulting to a provided value.
Secrets::getValue('apiKey', '1234567890');
```

### Console Commands

```shell
# Adds or overwrites a kay/value pair.
./craft secrets/vault/add apiSecret 1234567890wqertyuiop

# Deletes the value of a provided kay.
./craft secrets/vault/delete apiSecret

# Reveals all key/value pairs.
./craft secrets/vault/reveal

# Reveals the value of a provided kay.
./craft secrets/vault/reveal apiSecret
```

### Config Settings

#### `filePath`

The path of the encrypted secrets file. Defaults to `/config/secrets.enc`.

#### `encryptionKey`

A cryptographically secure key to use for encryption and decryption. Defaults to the value of Craft's  `SECURITY_KEY` environment variable.

To modify the settings, copy the `config.php` file to your project’s main config directory as `secrets.php` and uncomment any settings you wish to change.

## License

This plugin is licensed for free under the MIT License.

## Requirements

Craft CMS 3.0.3 or later.

## Installation

To install the plugin, search for “Secrets” in the Craft Plugin Store, or install manually using composer.

```
composer require putyourlightson/craft-secrets:^1.0.0-beta.1
```

## Credits

This plugin is inspired by the [Laravel Credentials](https://github.com/beyondcode/laravel-credentials) package by [Marcel Pociot](https://github.com/mpociot).

Icon by <a href="https://smashicons.com/" title="Smashicons">Smashicons</a>.

---

Created by [PutYourLightsOn](https://putyourlightson.com/).

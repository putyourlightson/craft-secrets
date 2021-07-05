[![Stable Version](https://img.shields.io/packagist/v/putyourlightson/craft-secrets?label=stable)]((https://packagist.org/packages/putyourlightson/craft-secrets))
[![Total Downloads](https://img.shields.io/packagist/dt/putyourlightson/craft-secrets)](https://packagist.org/packages/putyourlightson/craft-secrets)

<p align="center"><img width="130" src="https://raw.githubusercontent.com/putyourlightson/craft-secrets/develop/src/icon.svg"></p>

# Secrets Plugin for Craft CMS

The Secrets plugin allows you to store and manage secrets in an encrypted file. There are some benefits to storing secrets this way, instead of the conventional approach of storing them as plaintext in the `.env` file.

1. Secrets are encrypted and cannot be revealed without the encryption key.
2. The encrypted file can be committed to your repository, meaning you avoid having to send secrets in plaintext to other developers. You also end up with a history of changes to the file.
3. If secrets change or are rotated then there is only one file that needs to be updated. 

![Secrets CLI](https://putyourlightson.com/assets/images/plugins/secrets/secrets-cli.png)

## Documentation

Learn more and read the documentation at [putyourlightson.com/plugins/secrets »](https://putyourlightson.com/plugins/secrets)

## License

This plugin is licensed for free under the MIT License.

## Requirements

Craft CMS 3.0.3 or later.

## Installation

To install the plugin, search for “Secrets” in the Craft Plugin Store, or install manually using composer.

```
composer require putyourlightson/craft-secrets
```

---

Created by [PutYourLightsOn](https://putyourlightson.com/).

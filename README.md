# Simple HTML to SSML converter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tmeister/ssml.svg?style=flat-square)](https://packagist.org/packages/tmeister/ssml)
[![Build Status](https://img.shields.io/travis/tmeister/ssml/master.svg?style=flat-square)](https://travis-ci.org/tmeister/ssml)
[![Quality Score](https://img.shields.io/scrutinizer/g/tmeister/ssml.svg?style=flat-square)](https://scrutinizer-ci.com/g/tmeister/ssml)
[![Total Downloads](https://img.shields.io/packagist/dt/tmeister/ssml.svg?style=flat-square)](https://packagist.org/packages/tmeister/ssml)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require tmeister/ssml
```

## Usage

``` php
$html2ssml = new Html2Ssml($html);
$ssml      = $html2ssml->getSsml();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email noone@tmeister.net instead of using the issue tracker.

## Credits

- [Enrique Chavez](https://github.com/tmeister)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).

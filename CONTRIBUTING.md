# Contributing

Thank you for contributing to `brixion/ulu-php`!

## Requirements

- PHP 8.2 or higher
- [Composer](https://getcomposer.org/)

## Setup

```bash
composer install
```

## Before opening a pull request

Run the quality checks locally:

```bash
composer test
composer analyse
composer cs:check
```

To auto-fix code style issues:

```bash
composer cs:fix
```

All checks must pass in CI before a pull request can be merged.

## Pull requests

- Keep changes focused and well-tested
- Follow the existing code style
- Add or update tests when changing behavior
- Open an issue first for large changes if you are unsure about the approach

## Issues

Report bugs and request features via [GitHub Issues](https://github.com/brixion/ulu-php/issues).

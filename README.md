Pre Build - WIP
===============

[![Latest Stable Version](https://img.shields.io/packagist/v/mf/pre-build.svg)](https://packagist.org/packages/mf/pre-build)
[![Total Downloads](https://img.shields.io/packagist/dt/mf/pre-build.svg)](https://packagist.org/packages/mf/pre-build)
[![License](https://img.shields.io/packagist/l/mf/pre-build.svg)](https://packagist.org/packages/mf/pre-build)
[![Build Status](https://travis-ci.org/MortalFlesh/pre-build.svg?branch=master)](https://travis-ci.org/MortalFlesh/pre-build)
[![Coverage Status](https://coveralls.io/repos/github/MortalFlesh/pre-build/badge.svg?branch=master)](https://coveralls.io/github/MortalFlesh/pre-build?branch=master)

Pre build commands for exporting variables for building a package

## Installation
```bash
composer require mf/pre-build
```


## How to run it?
```bash
vendor/bin/pre-build-console pre-build:parse-variables -c .pre-build.yml
```

## Example of config file
```yaml
pre-build:
    parse:
        git:
            commit: GIT_COMMIT
            url:    GIT_URL
            branch: GIT_BRANCH
```

Pre Build
=========

[![Latest Stable Version](https://img.shields.io/packagist/v/mf/pre-build.svg)](https://packagist.org/packages/mf/pre-build)
[![Total Downloads](https://img.shields.io/packagist/dt/mf/pre-build.svg)](https://packagist.org/packages/mf/pre-build)
[![License](https://img.shields.io/packagist/l/mf/pre-build.svg)](https://packagist.org/packages/mf/pre-build)
[![Tests and linting](https://github.com/MortalFlesh/pre-build/actions/workflows/tests.yaml/badge.svg)](https://github.com/MortalFlesh/pre-build/actions/workflows/tests.yaml)
[![Coverage Status](https://coveralls.io/repos/github/MortalFlesh/pre-build/badge.svg?branch=master)](https://coveralls.io/github/MortalFlesh/pre-build?branch=master)

Pre build commands for exporting variables for building a package

## Installation
```bash
composer require mf/pre-build
```


## How to run it?
```bash
source <(php vendor/bin/pre-build-console pre-build:parse-variables)
```

### Example of config file
- all keys are optional
```yaml
pre-build:
    parse:
        git:
            commit: GIT_COMMIT
            url:    GIT_URL
            branch: GIT_BRANCH
            tag:    GIT_TAG
        md5sum:
            path/to/file: FILE_SUM 
```

### Result:
```bash
$ echo $GIT_COMMIT
$ echo $GIT_URL
$ echo $GIT_BRANCH
$ echo $GIT_TAG
$ echo $FILE_SUM
```


### Show list of available commands
```bash
vendor/bin/pre-build-console list
```

### Usage:
```bash
vendor/bin/pre-build-console [command] [arguments]
```

#### Available commands:
     help                       Displays help for a command
     list                       Lists commands
    pre-build
     pre-build:parse-variables  Parse variables by given config file
 

## Pre-build
Parse variables by given config file

### Usage
```bash
vendor/bin/pre-build-console pre-build:parse-variables [options]
```

### Arguments:
    environment                Environment to release
    message                    Release message

### Options:
    -c, --config=CONFIG    Path to config [default: "./.pre-build.yml"]
    -o, --output[=OUTPUT]  Output format [std, visual] [default: "std"]
    -h, --help             Display this help message
    -q, --quiet            Do not output any message
    -V, --version          Display this application version
        --ansi             Force ANSI output
        --no-ansi          Disable ANSI output
    -n, --no-interaction   Do not ask any interactive question
    -v|vv|vvv, --verbose   Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

# phpdoc-phpcs-sniffs
Based on Squiz version without some their stuff and new feature for PHPCBF.

## Installation

Just run:

```bash
git archive --remote=git@github.com:brunoric/phpdoc-phpcs-sniffs.git HEAD bin/installer | tar -xO | bash
```
It will install the standard and its dependencies.

## Usage

You just need to pass the Smartbox as parameter and the path of the file
to be inspected:

```bash
phpcs --standard=Smartbox /path/file.php
```


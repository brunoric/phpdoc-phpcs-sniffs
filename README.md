# PHPDoc-for-PHPCS-PHPCBF
Based on Squiz without some their stuff

##Installing
After the install of PHPCS/PHPCBF place on /usr/share/php/PHP/CodeSniffer/ and load the content of this repo ina folder called PHPDoc.

##How to use
I use two bash alias for fast use:

```
alias phpdoc='phpcs -d memory_limit=512M --ignore=*cmb*,index.php,*.js,WP_*,CPT_* --standard=PHPDoc'
alias phpdoccbf='phpcbf -d memory_limit=512M --ignore=*cmb*,index.php,*.js,WP_*,CPT_* --standard=PHPDoc'
```

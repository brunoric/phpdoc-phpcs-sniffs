<?php
/**
 * PHPDoc_Sniffs_Commenting_PostStatementCommentSniff.
 * Based on Squiz
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @author    Daniele Scasciafratte <daniele@codeat.it>
 * @copyright 2006-2014 PHPDoc Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * PHPDoc_Sniffs_Commenting_PostStatementCommentSniff.
 *
 * Checks to ensure that there are no comments after statements.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 PHPDoc Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: 2.3.3
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHPDoc_Sniffs_Commenting_PostStatementCommentSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
                                   'PHP',
                                   'JS',
                                  );


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_COMMENT);

    }//end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (substr($tokens[$stackPtr]['content'], 0, 2) !== '//') {
            return;
        }

        $commentLine = $tokens[$stackPtr]['line'];
        $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);

        if ($tokens[$lastContent]['line'] !== $commentLine) {
            return;
        }

        if ($tokens[$lastContent]['code'] === T_CLOSE_CURLY_BRACKET) {
            return;
        }

        // Special case for JS files.
        if ($tokens[$lastContent]['code'] === T_COMMA
            || $tokens[$lastContent]['code'] === T_SEMICOLON
        ) {
            $lastContent = $phpcsFile->findPrevious(T_WHITESPACE, ($lastContent - 1), null, true);
            if ($tokens[$lastContent]['code'] === T_CLOSE_CURLY_BRACKET) {
                return;
            }
        }

    }//end process()


}//end class

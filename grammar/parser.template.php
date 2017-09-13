<?php
$meta #
#semval($) $this->semValue
#semval($,%t) $this->semValue
#semval(%n) $this->stackPos-(%l-%n)
#semval(%n,%t) $this->stackPos-(%l-%n)

namespace Prerano\Parser;

use Prerano\Parser\{
    ParserAbstract,
    Error
};
use Prerano\Language;
use Prerano\AST\Node;
use Prerano\AST\Node\{
    Expr,
    Name,
    Scalar,
    Stmt
};
#include;

/* This is an automatically GENERATED file, which should not be manually edited.
 * Instead edit one of the following:
 *  * the grammar files grammar/language.y
 *  * the skeleton file grammar/parser.template.php
 *  * the preprocessing script grammar/rebuildParsers.php
 */
class Parser extends ParserAbstract
{
    protected $tokenToSymbolMapSize = #(YYMAXLEX);
    protected $actionTableSize = #(YYLAST);
    protected $gotoTableSize = #(YYGLAST);

    protected $invalidSymbol = #(YYBADCH);
    protected $errorSymbol = #(YYINTERRTOK);
    protected $defaultAction = #(YYDEFAULT);
    protected $unexpectedTokenRule = #(YYUNEXPECTED);

    protected $YY2TBLSTATE  = #(YY2TBLSTATE);
    protected $YYNLSTATES   = #(YYNLSTATES);

    protected $symbolToName = array(
        #listvar terminals
    );

    protected $tokenToSymbol = array(
        #listvar yytranslate
    );

    protected $action = array(
        #listvar yyaction
    );

    protected $actionCheck = array(
        #listvar yycheck
    );

    protected $actionBase = array(
        #listvar yybase
    );

    protected $actionDefault = array(
        #listvar yydefault
    );

    protected $goto = array(
        #listvar yygoto
    );

    protected $gotoCheck = array(
        #listvar yygcheck
    );

    protected $gotoBase = array(
        #listvar yygbase
    );

    protected $gotoDefault = array(
        #listvar yygdefault
    );

    protected $ruleToNonTerminal = array(
        #listvar yylhs
    );

    protected $ruleToLength = array(
        #listvar yylen
    );
#if -t

    protected $productions = array(
        #production-strings;
    );
#endif
#reduce

    protected function reduceRule%n() {
        %b
    }
#noact

    protected function reduceRule%n() {
        $this->semValue = $this->semStack[$this->stackPos];
    }
#endreduce
}
#tailcode;

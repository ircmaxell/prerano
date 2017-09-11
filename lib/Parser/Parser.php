<?php

namespace Prerano\Parser;

use Prerano\Parser\ParserAbstract;
use Prerano\Parser\Error;
use Prerano\AST\Node;
use Prerano\AST\Node\Expr;
use Prerano\AST\Node\Name;
use Prerano\AST\Node\Scalar;
use Prerano\AST\Node\Stmt;

/* This is an automatically GENERATED file, which should not be manually edited.
 * Instead edit one of the following:
 *  * the grammar files grammar/language.y
 *  * the skeleton file grammar/parser.template.php
 *  * the preprocessing script grammar/rebuildParsers.php
 */
class Parser extends ParserAbstract
{
    protected $tokenToSymbolMapSize = 266;
    protected $actionTableSize = 26;
    protected $gotoTableSize = 6;

    protected $invalidSymbol = 16;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 3;
    protected $YYNLSTATES   = 19;

    protected $symbolToName = array(
        "EOF",
        "error",
        "T_IF",
        "T_ELSE",
        "T_NAMESPACE",
        "T_STRING",
        "T_LNUMBER",
        "T_DNUMBER",
        "';'",
        "'\\\\'",
        "'('",
        "')'",
        "'{'",
        "'}'",
        "'='",
        "'$'"
    );

    protected $tokenToSymbol = array(
            0,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   15,   16,   16,   16,
           10,   11,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,    8,
           16,   14,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,    9,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   12,   16,   13,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,    1,    2,   16,    3,
           16,   16,    4,    5,    6,    7
    );

    protected $action = array(
            3,    0,   26,    8,   38,   39,    7,   31,    4,   40,
           18,   27,    0,   11,   17,   32,   23,    0,    0,    0,
           33,    0,    0,   34,    0,    6
    );

    protected $actionCheck = array(
            2,    0,    5,    4,    6,    7,    3,    8,   10,    5,
           12,    5,   -1,   15,    9,    8,    8,   -1,   -1,   -1,
           11,   -1,   -1,   13,   -1,   14
    );

    protected $actionBase = array(
            0,   -1,   10,   -2,   -2,   -2,   -2,   -2,   -3,    3,
            1,    4,    7,   11,    8,    5,    9,    6,    0,    0,
           -2,   -2
    );

    protected $actionDefault = array(
            3,    1,32767,32767,32767,32767,32767,32767,32767,   23,
        32767,32767,32767,   17,32767,    6,32767,32767,   10
    );

    protected $goto = array(
            5,   16,    9,   37,   41,   28
    );

    protected $gotoCheck = array(
            9,    9,    9,    9,    9,    8
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,    0,    0,    3,   -3,
            0,    0
    );

    protected $gotoDefault = array(
        -32768,   10,    1,   21,   14,   24,   15,    2,   30,   12,
           35,   13
    );

    protected $ruleToNonTerminal = array(
            0,    1,    2,    2,    3,    3,    4,    6,    6,    7,
            7,    5,    5,    8,    9,    9,    9,    9,    9,    9,
            9,   11,   10,   10
    );

    protected $ruleToLength = array(
            1,    1,    2,    0,    3,    1,    1,    1,    3,    2,
            0,    1,    1,    2,    3,    3,    4,    1,    3,    1,
            1,    2,    2,    0
    );

    protected $productions = array(
        "start : start",
        "start : top_statement_list",
        "top_statement_list : top_statement_list top_statement",
        "top_statement_list : /* empty */",
        "top_statement : T_NAMESPACE namespace_name ';'",
        "top_statement : statement",
        "namespace_name : namespace_name_parts",
        "namespace_name_parts : T_STRING",
        "namespace_name_parts : namespace_name_parts '\\\\' T_STRING",
        "statement_list : statement_list non_empty_statement",
        "statement_list : /* empty */",
        "statement : non_empty_statement",
        "statement : ';'",
        "non_empty_statement : expr ';'",
        "expr : '(' expr ')'",
        "expr : '{' statement_list '}'",
        "expr : T_IF expr expr else_expr",
        "expr : variable",
        "expr : variable '=' expr",
        "expr : T_LNUMBER",
        "expr : T_DNUMBER",
        "variable : '$' T_STRING",
        "else_expr : T_ELSE expr",
        "else_expr : /* empty */"
    );

    protected function reduceRule0()
    {
        $this->semValue = $this->semStack[$this->stackPos];
    }

    protected function reduceRule1()
    {
        $this->semValue = $this->handleNamespaces($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule2()
    {
        if (is_array($this->semStack[$this->stackPos-(2-2)])) {
            $this->semValue = array_merge($this->semStack[$this->stackPos-(2-1)], $this->semStack[$this->stackPos-(2-2)]);
        } else {
            $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
            $this->semValue = $this->semStack[$this->stackPos-(2-1)];
        };
    }

    protected function reduceRule3()
    {
        $this->semValue = array();
    }

    protected function reduceRule4()
    {
        $this->semValue = new Stmt\Namespace_($this->semStack[$this->stackPos-(3-2)], null, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule5()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule6()
    {
        $this->semValue = new Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule7()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule8()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule9()
    {
        $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule10()
    {
        $this->semValue = array();
    }

    protected function reduceRule11()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule12()
    {
        $startAttributes = $this->startAttributeStack[$this->stackPos-(1-1)];
        if (isset($startAttributes['comments'])) {
            $this->semValue = new Stmt\Nop(['comments' => $startAttributes['comments']]);
        } else {
            $this->semValue = null;
        };
        if ($this->semValue === null) {
            $this->semValue = array();
        } /* means: no statement */
    }

    protected function reduceRule13()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule14()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule15()
    {
        $this->semValue = new Expr\Block($this->semStack[$this->stackPos-(3-2)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule16()
    {
        $this->semValue = new Expr\If_($this->semStack[$this->stackPos-(4-2)], $this->semStack[$this->stackPos-(4-3)], $this->semStack[$this->stackPos-(4-4)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule17()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule18()
    {
        $this->semValue = new Expr\Assign($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule19()
    {
        $this->semValue = $this->parseLNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule20()
    {
        $this->semValue = new Scalar\DNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule21()
    {
        $this->semValue = new Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule22()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-2)];
    }

    protected function reduceRule23()
    {
        $this->semValue = null;
    }
}

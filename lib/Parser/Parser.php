<?php

namespace Prerano\Parser;

use Prerano\Parser\ParserAbstract;
use Prerano\Parser\Error;
use Prerano\Language;
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
    protected $tokenToSymbolMapSize = 264;
    protected $actionTableSize = 35;
    protected $gotoTableSize = 6;

    protected $invalidSymbol = 21;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 11;
    protected $YYNLSTATES   = 26;

    protected $symbolToName = array(
        "EOF",
        "error",
        "T_TYPE",
        "'|'",
        "'&'",
        "'('",
        "')'",
        "'*'",
        "'?'",
        "'<'",
        "'>'",
        "T_PACKAGE",
        "T_STRING",
        "T_PROTECTED",
        "T_PUBLIC",
        "T_LNUMBER",
        "T_DNUMBER",
        "';'",
        "'\\\\'",
        "'='",
        "','"
    );

    protected $tokenToSymbol = array(
            0,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,    4,   21,
            5,    6,    7,   21,   20,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   17,
            9,   19,   10,    8,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   18,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,    3,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,   21,   21,   21,   21,
           21,   21,   21,   21,   21,   21,    1,    2,   11,   12,
           13,   14,   15,   16
    );

    protected $action = array(
            3,    4,    5,   35,   44,    0,   45,   46,    1,   14,
           37,   38,   36,   34,    4,    5,   52,   53,   47,   25,
           15,   33,   31,    0,   32,    2,    0,    0,    0,    0,
            0,   20,    0,    0,    6
    );

    protected $actionCheck = array(
            5,    3,    4,    2,    6,    0,    7,    8,    9,    2,
           15,   16,   11,   12,    3,    4,   13,   14,   10,   17,
           11,   17,   12,   -1,   12,   19,   -1,   -1,   -1,   -1,
           -1,   18,   -1,   -1,   20
    );

    protected $actionBase = array(
            9,   -5,   -5,   -5,   -5,   -5,   -5,   -2,   11,   11,
           11,    1,   -1,   -1,    3,   10,    7,    5,    2,   13,
           12,    4,    6,    8,   14,    0,    0,    1,    1,    1,
            1,    1,    1,   -1,   -1,   -1,   -1
    );

    protected $actionDefault = array(
        32767,   23,32767,32767,32767,32767,32767,32767,   13,   25,
           24,32767,   16,   17,   28,32767,    1,32767,32767,    4,
        32767,32767,32767,32767,   22,    3
    );

    protected $goto = array(
            8,    7,   12,   13,   10,   22
    );

    protected $gotoCheck = array(
           10,   10,   10,   10,   10,    7
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,    0,   -6,    0,    0,
           -2,    0,    0
    );

    protected $gotoDefault = array(
        -32768,   17,   18,   16,   28,   19,   21,   40,   41,   11,
            9,   23,   24
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    4,    7,    7,
            7,    8,    8,    6,   10,   10,   10,   10,   10,   10,
           10,   10,   11,   11,   12,   12,    9,    9,    9
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    1,    1,
            1,    1,    1,    5,    1,    1,    3,    3,    3,    2,
            2,    4,    1,    0,    3,    1,    1,    1,    0
    );

    protected $productions = array(
        "start : start",
        "start : T_PACKAGE namespace_name ';' top_statement_list",
        "top_statement_list : top_statement_list statement",
        "top_statement_list : /* empty */",
        "namespace_name : namespace_name_parts",
        "namespace_name_parts : T_STRING",
        "namespace_name_parts : namespace_name_parts '\\\\' T_STRING",
        "statement : type_decl ';'",
        "identifier : T_STRING",
        "identifier : T_TYPE",
        "identifier : T_PACKAGE",
        "scalar : T_LNUMBER",
        "scalar : T_DNUMBER",
        "type_decl : T_TYPE optional_modifier identifier '=' type_expr",
        "type_expr : identifier",
        "type_expr : scalar",
        "type_expr : type_expr '|' type_expr",
        "type_expr : type_expr '&' type_expr",
        "type_expr : '(' type_expr ')'",
        "type_expr : type_expr '*'",
        "type_expr : type_expr '?'",
        "type_expr : type_expr '<' type_expr_list '>'",
        "type_expr_list : non_empty_type_expr_list",
        "type_expr_list : /* empty */",
        "non_empty_type_expr_list : non_empty_type_expr_list ',' type_expr",
        "non_empty_type_expr_list : type_expr",
        "optional_modifier : T_PROTECTED",
        "optional_modifier : T_PUBLIC",
        "optional_modifier : /* empty */"
    );

    protected function reduceRule0()
    {
        $this->semValue = $this->semStack[$this->stackPos];
    }

    protected function reduceRule1()
    {
        $this->semValue = new Node\Stmt\Package($this->semStack[$this->stackPos-(4-2)], $this->semStack[$this->stackPos-(4-4)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
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
        $this->semValue = new Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule5()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule6()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule7()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule8()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule9()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule10()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule11()
    {
        $this->semValue = $this->parseLNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule12()
    {
        $this->semValue = $this->parseDNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule13()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-5)], $this->semStack[$this->stackPos-(5-2)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule14()
    {
        $this->semValue = new Node\Expr\Type\Named($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule15()
    {
        $this->semValue = new Node\Expr\Type\Value($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule16()
    {
        $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule17()
    {
        $this->semValue = new Node\Expr\Type\Intersection($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule18()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule19()
    {
        $this->semValue = new Node\Expr\Type\Pointer($this->semStack[$this->stackPos-(2-1)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule20()
    {
        $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(2-1)], new Node\Expr\Type(new Node\Name('null', $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule21()
    {
        $this->semValue = new Node\Expr\Type\Specification($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule22()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule23()
    {
        $this->semValue = array();
    }

    protected function reduceRule24()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule25()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule26()
    {
        $this->semValue = Language\Package::PROTECTED;
    }

    protected function reduceRule27()
    {
        $this->semValue = Language\Package::PUBLIC;
    }

    protected function reduceRule28()
    {
        $this->semValue = Language\Package::PRIVATE;
    }
}

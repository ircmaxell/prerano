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
    protected $tokenToSymbolMapSize = 273;
    protected $actionTableSize = 121;
    protected $gotoTableSize = 96;

    protected $invalidSymbol = 37;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 88;
    protected $YYNLSTATES   = 116;

    protected $symbolToName = array(
        "EOF",
        "error",
        "T_EQUALS",
        "'+'",
        "'-'",
        "'*'",
        "'/'",
        "'%'",
        "'|'",
        "'&'",
        "'('",
        "')'",
        "'?'",
        "'<'",
        "'>'",
        "':'",
        "','",
        "T_SKINNY_ARROW",
        "T_TYPE",
        "T_FUNCTION",
        "T_ON",
        "T_IS",
        "T_ELSE",
        "T_SCOPE_OPERATOR",
        "';'",
        "T_PACKAGE",
        "T_STRING",
        "T_PROTECTED",
        "T_PUBLIC",
        "T_LNUMBER",
        "T_DNUMBER",
        "T_ENUM",
        "T_MATCH",
        "'='",
        "'{'",
        "'}'",
        "'$'"
    );

    protected $tokenToSymbol = array(
            0,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   36,    7,    9,   37,
           10,   11,    5,    3,   16,    4,   37,    6,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   15,   24,
           13,   33,   14,   12,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   34,    8,   35,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,   37,   37,   37,   37,
           37,   37,   37,   37,   37,   37,    1,    2,   17,   18,
           19,   20,   21,   22,   23,   25,   26,   27,   28,   29,
           30,   31,   32
    );

    protected $action = array(
           17,    0,   12,-32766,   61,   62,   38,-32766,  132,   68,
          134,  110,    5,   47,-32766,  133,  131,   63,   60,  136,
          137,   13,  102,   -1,  171,   18,   67,   19,   20,   21,
           22,   23,   24,-32766,-32766,   12,-32766,  152,   39,   33,
        -32766,  144,   68,   14,   41,   42,   47,   94,  145,   36,
          157,  158,-32766,-32766,-32766,  145,   36,    6,   26,   34,
        -32766,  136,  137,   35,-32766,   43,   16,  112,   44,   46,
          169,  176,  143,  108,  172,   65,  111,  121,  146,  129,
           25,   15,   37,   45,    0,    0,    0,    0,    0,    0,
            0,   64,   93,    0,  183,  195,  193,    0,   89,    0,
          122,    0,    0,    0,    0,    0,    0,    0,   40,   75,
            0,  113,   59,  114,  115,    0,  184,  196,  194,    0,
           66
    );

    protected $actionCheck = array(
           10,    0,   10,    5,   18,   19,   20,    2,   18,   17,
           20,   22,   15,   21,   10,   25,   26,   31,   16,   29,
           30,   10,   32,    0,   35,   10,   36,    2,    3,    4,
            5,    6,    7,   29,   30,   10,   32,   35,   10,   10,
           36,    5,   17,   16,    8,    9,   21,   19,   12,   13,
           27,   28,    2,    3,    4,   12,   13,   15,   16,   10,
           32,   29,   30,   10,   36,   11,   33,   34,   11,   11,
           11,   11,   11,   11,   11,   19,   24,   26,   14,   24,
           15,   33,   16,   16,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   23,   23,   -1,   24,   24,   24,   -1,   25,   -1,
           26,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   33,   33,
           -1,   34,   34,   34,   34,   -1,   35,   35,   35,   -1,
           36
    );

    protected $actionBase = array(
           73,  -11,   81,   82,   83,   79,   80,   70,   63,   62,
           71,   72,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,   25,   25,   25,
           25,   25,   25,   28,   28,   28,   28,   28,   28,   28,
           28,   28,   28,   28,   28,   28,   28,   28,    5,   33,
           33,   56,   61,   84,   50,   50,   36,   36,   36,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,  -14,
           -2,   23,   -8,   -8,   -8,   32,   75,   29,   78,   43,
           43,   49,   76,    2,   48,   43,   65,   11,   42,   51,
            1,   52,   69,   74,   53,   68,   54,   66,   57,   67,
           64,   58,   15,   68,   68,   55,   59,   27,   77,   60,
           -3,    0,    0,    0,    0,    0,    0,  -10,  -10,  -10,
          -10,  -10,  -10,   25,   25,   25,   25,   25,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,   25,   36,   36,   36,   36,   36,
           25,   25,    0,    0,    0,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,    0,   36,    0,    0,    0,
            0,    0,   68,   68,   68,    0,    0,   68,   68,    0,
           68,    0,   68,   68
    );

    protected $actionDefault = array(
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,   70,   70,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,   51,   14,   74,
           73,   82,   81,   47,   47,   33,   33,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,   66,32767,
        32767,32767,32767,32767,   61,   62,   22,   35,   34,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
           54,   43,   64,   63,   65,32767,32767,32767,32767,   25,
           26,32767,   39,32767,   50,   31,   57,32767,32767,32767,
        32767,32767,    4,32767,32767,   23,32767,   46,32767,   32,
        32767,32767,32767,   57,   58,32767,32767,   69,32767,32767,
        32767,    3,    8,   76,    8,    8
    );

    protected $goto = array(
           86,   86,   86,  140,  140,  140,  140,  140,  140,  140,
          140,  140,  140,  140,  140,  140,  140,  140,    3,    4,
          109,   95,   95,   95,   95,   95,   95,   95,   95,   95,
           95,   95,   95,   95,   95,   95,  187,  101,  100,  161,
          153,  164,    0,    0,    0,  156,    0,   82,   82,   76,
           77,   78,  135,   81,   84,  104,   87,   31,    0,    0,
            0,   10,   11,    0,    0,    0,    0,    0,   29,   29,
           29,   27,    7,    8,    9,   48,   54,   55,   72,   73,
           74,   30,   32,   57,   57,    0,   51,   52,   56,   79,
           80,   49,   85,   58,   50,   70
    );

    protected $gotoCheck = array(
           14,   14,   14,   15,   15,   15,   15,   15,   15,   15,
           15,   15,   15,   15,   15,   15,   15,   15,    6,    6,
           27,   14,   14,   14,   14,   14,   14,   14,   14,   14,
           14,   14,   14,   14,   14,   14,   30,   22,   18,   23,
           21,   25,   -1,   -1,   -1,   15,   -1,   14,   14,   14,
           14,   14,   14,   14,   14,   14,   14,   13,   -1,   -1,
           -1,   13,   13,   -1,   -1,   -1,   -1,   -1,   13,   13,
           13,   13,   13,   13,   13,   13,   13,   13,   13,   13,
           13,   13,   13,   17,   17,   -1,   17,   17,   17,   17,
           17,   17,   17,   17,   17,   17
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,  -96,    0,    0,    0,
            0,    0,    0,   56,  -12,  -30,    0,   48,    2,    0,
            0,  -20,    3,  -11,    0,    4,    0,    7,    0,    0,
           22,    0,    0
    );

    protected $gotoDefault = array(
        -32768,   90,   91,   71,  118,   92,    2,  123,  125,  126,
          127,  128,  105,   28,  103,  175,   69,   53,   98,   99,
           83,  154,   96,  160,   97,  165,  168,  106,    1,  107,
          188,  191,   88
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    7,   12,   14,   14,   14,   14,   14,
           15,   15,    8,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   18,   18,   19,   19,    9,   20,   20,   21,
           21,   16,   16,   16,   10,   11,   22,   22,   24,   24,
           25,   25,   13,   13,   13,   13,   13,   13,   13,   13,
           13,   26,   26,   26,   26,   26,   26,   23,   23,   27,
           27,   29,   29,   30,   30,   28,   28,   31,   31,   31,
           31,   32,   32
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    2,    1,    1,    1,    1,    1,    3,
            1,    1,    5,    1,    1,    3,    3,    3,    2,    2,
            4,    5,    1,    0,    3,    1,    6,    3,    1,    1,
            3,    1,    1,    0,    8,   10,    1,    0,    3,    1,
            3,    5,    1,    4,    3,    7,    3,    1,    2,    1,
            6,    3,    3,    3,    3,    3,    3,    3,    3,    1,
            0,    3,    1,    3,    1,    2,    0,    4,    5,    4,
            5,    3,    1
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
        $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule8()
    {
        $this->semValue = array();
    }

    protected function reduceRule9()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule10()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule11()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule12()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule13()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule14()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule15()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule16()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule17()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule18()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule19()
    {
        $this->semValue = new Node\Name\Qualified($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule20()
    {
        $this->semValue = $this->parseLNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule21()
    {
        $this->semValue = $this->parseDNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule22()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-5)], $this->semStack[$this->stackPos-(5-1)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule23()
    {
        $this->semValue = new Node\Expr\Type\Named($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule24()
    {
        $this->semValue = new Node\Expr\Type\Value($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule25()
    {
        $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule26()
    {
        $this->semValue = new Node\Expr\Type\Intersection($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule27()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule28()
    {
        $this->semValue = new Node\Expr\Type\Pointer($this->semStack[$this->stackPos-(2-1)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule29()
    {
        $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(2-1)], new Node\Expr\Type(new Node\Name('null', $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule30()
    {
        $this->semValue = new Node\Expr\Type\Specification($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule31()
    {
        $this->semValue = new Node\Expr\Type\Function_($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-5)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule32()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule33()
    {
        $this->semValue = array();
    }

    protected function reduceRule34()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule35()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule36()
    {
        $this->semValue = new Node\Stmt\Enum($this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->semStack[$this->stackPos-(6-1)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule37()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule38()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule39()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(1-1)], new Node\Expr\Type\Value(null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes), 0, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule40()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(3-1)], new Node\Expr\Type\Value($this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes), 0, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule41()
    {
        $this->semValue = Language\Package::PROTECTED;
    }

    protected function reduceRule42()
    {
        $this->semValue = Language\Package::PUBLIC;
    }

    protected function reduceRule43()
    {
        $this->semValue = Language\Package::PRIVATE;
    }

    protected function reduceRule44()
    {
        $this->semValue = new Node\Stmt\Function_($this->semStack[$this->stackPos-(8-3)], $this->semStack[$this->stackPos-(8-5)], $this->semStack[$this->stackPos-(8-7)], $this->semStack[$this->stackPos-(8-8)], $this->semStack[$this->stackPos-(8-1)], $this->startAttributeStack[$this->stackPos-(8-1)] + $this->endAttributes);
    }

    protected function reduceRule45()
    {
        $this->semValue = new Node\Stmt\ExprFunction($this->semStack[$this->stackPos-(10-3)], $this->semStack[$this->stackPos-(10-5)], $this->semStack[$this->stackPos-(10-7)], $this->semStack[$this->stackPos-(10-9)], $this->semStack[$this->stackPos-(10-10)], $this->semStack[$this->stackPos-(10-1)], $this->startAttributeStack[$this->stackPos-(10-1)] + $this->endAttributes);
    }

    protected function reduceRule46()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule47()
    {
        $this->semValue = [];
    }

    protected function reduceRule48()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule49()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule50()
    {
        $this->semValue = new Node\Stmt\Parameter($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], null, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule51()
    {
        $this->semValue = new Node\Stmt\Parameter($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-5)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule52()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule53()
    {
        $this->semValue = new Node\Expr\FuncCall($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule54()
    {
        $this->semValue = new Node\Expr\Is($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule55()
    {
        $this->semValue = new Node\Expr\Match($this->semStack[$this->stackPos-(7-3)], $this->semStack[$this->stackPos-(7-6)], $this->startAttributeStack[$this->stackPos-(7-1)] + $this->endAttributes);
    }

    protected function reduceRule56()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule57()
    {
        $this->semValue = new Node\Expr\IdentifierReference($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule58()
    {
        $this->semValue = new Node\Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule59()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule60()
    {
        $this->semValue = new Node\Expr\MethodCall($this->semStack[$this->stackPos-(6-1)], $this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule61()
    {
        $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule62()
    {
        $this->semValue = new Node\Expr\BinaryOp\Minus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule63()
    {
        $this->semValue = new Node\Expr\BinaryOp\Div($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule64()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mul($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule65()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mod($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule66()
    {
        $this->semValue = new Node\Expr\BinaryOp\Equals($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule67()
    {
        $this->semValue = [$this->semStack[$this->stackPos-(3-2)]];
    }

    protected function reduceRule68()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule69()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule70()
    {
        $this->semValue = [];
    }

    protected function reduceRule71()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule72()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule73()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule74()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule75()
    {
        $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule76()
    {
        $this->semValue = array();
    }

    protected function reduceRule77()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(4-1)], [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule78()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule79()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule80()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule81()
    {
        $this->semValue = new Node\Expr\BinaryOp\BooleanOr($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule82()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }
}

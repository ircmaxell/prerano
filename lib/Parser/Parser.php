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
    protected $actionTableSize = 115;
    protected $gotoTableSize = 93;

    protected $invalidSymbol = 36;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 85;
    protected $YYNLSTATES   = 112;

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
            0,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   35,    7,    9,   36,
           10,   11,    5,    3,   16,    4,   36,    6,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   15,   23,
           13,   32,   14,   12,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   33,    8,   34,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,   36,   36,   36,   36,
           36,   36,   36,   36,   36,   36,    1,    2,   36,   17,
           18,   19,   20,   21,   22,   24,   25,   26,   27,   28,
           29,   30,   31
    );

    protected $action = array(
           11,    7,-32766,   60,   61,   31,    0,  128,   12,  130,
        -32766,   40,   32,   -1,  129,  127,   62,-32766,  132,  133,
           91,   99,-32766,-32766,-32766,   66,   13,   14,   15,   16,
           17,   18,  106,-32766,    7,-32766,-32766,-32766,-32766,  153,
          154,   59,-32766,  140,   40,  167,   34,   35,  141,   29,
          141,   29,    6,   20,  132,  133,   26,   27,   28,  148,
           10,  108,   36,   37,   39,  165,  139,  105,  168,   86,
           65,   63,  142,  107,    5,   19,    9,    8,   30,   38,
            0,    0,   64,    0,    0,    0,    0,   90,    0,  125,
          178,  190,  188,    0,    0,  117,  118,    0,    0,    0,
            0,    0,    0,    0,   33,   70,    0,  109,   58,  110,
          111,    0,  179,  191,  189
    );

    protected $actionCheck = array(
           10,   10,    5,   17,   18,   19,    0,   17,   10,   19,
            2,   20,   10,    0,   24,   25,   30,   10,   28,   29,
           18,   31,    2,    3,    4,   35,    2,    3,    4,    5,
            6,    7,   21,   31,   10,   28,   29,   35,   31,   26,
           27,   16,   35,    5,   20,   34,    8,    9,   12,   13,
           12,   13,   15,   16,   28,   29,   10,   10,   10,   34,
           32,   33,   11,   11,   11,   11,   11,   11,   11,   24,
           35,   22,   14,   23,   15,   15,   32,   16,   16,   16,
           -1,   -1,   18,   -1,   -1,   -1,   -1,   22,   -1,   23,
           23,   23,   23,   -1,   -1,   25,   25,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   32,   32,   -1,   33,   33,   33,
           33,   -1,   34,   34,   34
    );

    protected $actionBase = array(
           45,   11,   78,   79,   80,   76,   77,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,   67,   57,   56,   68,   69,    2,    2,    2,    2,
            2,    2,    2,    2,    2,    2,    2,    2,    2,    2,
            2,   24,   24,   24,   24,   24,   24,   28,   28,    8,
           64,   55,   35,   38,   38,   38,   20,   20,    7,    7,
            7,    7,    7,    7,    7,    7,    7,  -14,   -3,   13,
           26,   72,   46,   75,   36,   36,   47,   73,   25,   44,
           36,   -9,   -9,   -9,   60,   37,   70,    6,   50,   65,
           71,   48,   49,   51,   62,   52,   63,   58,   53,   -2,
           49,   49,   66,   54,   61,   74,   59,    0,    0,    0,
            0,    0,    0,  -10,  -10,  -10,  -10,  -10,  -10,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,   24,   24,   24,   24,   24,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,    0,    0,    0,    0,    0,    0,   38,
           38,   24,   38,   38,   38,    0,    0,    0,   24,   24,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,    0,
           38,    0,    0,   49,   49,   49,    0,    0,   49,   49,
            0,   49,    0,    0,    0,    0,   49
    );

    protected $actionDefault = array(
        32767,32767,32767,32767,32767,32767,32767,   69,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,   47,   47,   33,   33,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,   51,   14,   73,   72,   81,   80,32767,32767,   65,
        32767,32767,32767,   22,   35,   34,   60,   61,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,   54,   43,
        32767,32767,32767,32767,   25,   26,32767,   39,32767,   50,
           31,   63,   62,   64,   57,32767,32767,32767,32767,    4,
        32767,32767,   23,32767,   46,32767,   32,32767,32767,32767,
           57,   58,32767,32767,   68,32767,32767,    3,    8,   75,
            8,    8
    );

    protected $goto = array(
           84,   84,  136,  136,  136,  136,  136,  136,  136,  136,
          136,  136,  136,  136,  136,  136,  136,    3,    4,   92,
           92,   92,   92,   92,   92,   92,   92,   92,   92,   92,
           92,   92,   92,   92,  182,   98,   97,  157,  149,  160,
            0,    0,    0,    0,    0,    0,  152,    0,    0,    0,
            0,   77,   77,   71,   72,   73,  131,   76,   79,  101,
           45,    0,    0,    0,   24,   25,   43,   43,   41,   21,
           22,   23,   49,   56,   57,   81,   82,   83,   44,   46,
           54,   54,    0,   50,   51,   53,   74,   75,   47,   80,
           55,   48,   68
    );

    protected $gotoCheck = array(
           14,   14,   15,   15,   15,   15,   15,   15,   15,   15,
           15,   15,   15,   15,   15,   15,   15,    6,    6,   14,
           14,   14,   14,   14,   14,   14,   14,   14,   14,   14,
           14,   14,   14,   14,   30,   22,   18,   23,   21,   25,
           -1,   -1,   -1,   -1,   -1,   -1,   15,   -1,   -1,   -1,
           -1,   14,   14,   14,   14,   14,   14,   14,   14,   14,
           13,   -1,   -1,   -1,   13,   13,   13,   13,   13,   13,
           13,   13,   13,   13,   13,   13,   13,   13,   13,   13,
           17,   17,   -1,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   17
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,  -93,    0,    0,    0,
            0,    0,    0,   59,   -7,  -24,    0,   52,    7,    0,
            0,  -21,    8,  -11,    0,    9,    0,    0,    0,    0,
           26,    0,    0
    );

    protected $gotoDefault = array(
        -32768,   87,   88,   69,  114,   89,    2,  119,  121,  122,
          123,  124,  102,   42,  100,  171,   67,   52,   95,   96,
           78,  150,   93,  156,   94,  161,  164,  103,    1,  104,
          183,  186,   85
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    7,   12,   14,   14,   14,   14,   14,
           15,   15,    8,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   18,   18,   19,   19,    9,   20,   20,   21,
           21,   16,   16,   16,   10,   11,   22,   22,   24,   24,
           25,   25,   13,   13,   13,   13,   13,   13,   13,   13,
           26,   26,   26,   26,   26,   26,   23,   23,   27,   27,
           29,   29,   30,   30,   28,   28,   31,   31,   31,   31,
           32,   32
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    2,    1,    1,    1,    1,    1,    3,
            1,    1,    5,    1,    1,    3,    3,    3,    2,    2,
            4,    5,    1,    0,    3,    1,    6,    3,    1,    1,
            3,    1,    1,    0,    8,   10,    1,    0,    3,    1,
            3,    5,    1,    4,    3,    7,    3,    1,    2,    1,
            3,    3,    3,    3,    3,    3,    3,    3,    1,    0,
            3,    1,    3,    1,    2,    0,    4,    5,    4,    5,
            3,    1
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
        $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule61()
    {
        $this->semValue = new Node\Expr\BinaryOp\Minus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule62()
    {
        $this->semValue = new Node\Expr\BinaryOp\Div($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule63()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mul($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule64()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mod($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule65()
    {
        $this->semValue = new Node\Expr\BinaryOp\Equals($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule66()
    {
        $this->semValue = [$this->semStack[$this->stackPos-(3-2)]];
    }

    protected function reduceRule67()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule68()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule69()
    {
        $this->semValue = [];
    }

    protected function reduceRule70()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule71()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule72()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule73()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule74()
    {
        $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule75()
    {
        $this->semValue = array();
    }

    protected function reduceRule76()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(4-1)], [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule77()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule78()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule79()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule80()
    {
        $this->semValue = new Node\Expr\BinaryOp\BooleanOr($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule81()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }
}

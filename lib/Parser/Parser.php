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
    protected $tokenToSymbolMapSize = 277;
    protected $actionTableSize = 141;
    protected $gotoTableSize = 153;

    protected $invalidSymbol = 43;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 103;
    protected $YYNLSTATES   = 142;

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
        "'?'",
        "'<'",
        "'>'",
        "':'",
        "','",
        "T_SKINNY_ARROW",
        "T_TYPE",
        "T_FUNCTION",
        "T_IMPORT",
        "T_ON",
        "T_AS",
        "T_CLASS",
        "T_IS",
        "T_ELSE",
        "T_SCOPE_OPERATOR",
        "T_PIPE_ARROW",
        "'('",
        "')'",
        "'['",
        "']'",
        "';'",
        "T_PACKAGE",
        "T_STRING",
        "T_PROTECTED",
        "T_PUBLIC",
        "T_LNUMBER",
        "T_DNUMBER",
        "T_ENUM",
        "T_MATCH",
        "'{'",
        "'}'",
        "'='",
        "'$'"
    );

    protected $tokenToSymbol = array(
            0,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   42,    7,    9,   43,
           26,   27,    5,    3,   14,    4,   43,    6,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   13,   30,
           11,   41,   12,   10,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   28,   43,   29,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   39,    8,   40,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,   43,   43,   43,   43,
           43,   43,   43,   43,   43,   43,    1,    2,   15,   16,
           17,   18,   19,   20,   21,   22,   23,   24,   25,   31,
           32,   33,   34,   35,   36,   37,   38
    );

    protected $action = array(
          162,   74,  165,  164,  166,-32766,-32766,-32766,   62,   72,
           14,  171,   10,  197,  198,  163,  161,    0,   65,  169,
          170,   37,  121,   67,    6,   26,   73,   16,   17,   18,
           19,   20,   21,-32766,  137,-32766,  136,  109,   -1,   68,
           22,   63,-32766,-32766,-32766,-32766,   38,   46,-32766,-32766,
           23,    7,  134,  138,-32766,   13,   64,  186,-32766,   69,
          184,   22,-32766,   40,   41,  185,   35,  192,   46,  214,
            5,   23,    7,  185,   35,  169,  170,   25,   66,   11,
           24,   36,   44,  108,    8,  219,   70,   42,    9,  139,
           61,  140,  141,    0,  173,    0,   15,   34,   32,   33,
            0,   43,   45,  209,  211,  210,  183,  131,  215,    0,
            0,    0,  135,  172,  157,  230,  242,  240,    0,  104,
            0,  147,  148,    0,    0,    0,    0,    0,    0,    0,
            0,  174,  231,  243,  241,    0,   12,   39,   91,    0,
           71
    );

    protected $actionCheck = array(
           16,   20,   18,   19,   20,    2,    3,    4,   11,   14,
           26,   30,   28,   33,   34,   31,   32,    0,   16,   35,
           36,   19,   38,   21,   13,   14,   42,    2,    3,    4,
            5,    6,    7,   26,   39,   28,   39,   17,    0,   37,
           15,   14,   35,   36,    2,   38,   26,   22,   28,   42,
           25,   26,   23,   39,    5,   41,   18,   12,   38,   24,
            5,   15,   42,    8,    9,   10,   11,   40,   22,   40,
           13,   25,   26,   10,   11,   35,   36,   13,   17,   14,
           14,   14,   14,   24,   26,   29,   17,   27,   26,   39,
           39,   39,   39,   -1,   40,   -1,   26,   26,   26,   26,
           -1,   27,   27,   27,   27,   27,   27,   27,   27,   -1,
           -1,   -1,   30,   30,   30,   30,   30,   30,   -1,   31,
           -1,   32,   32,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   40,   40,   40,   40,   -1,   41,   41,   41,   -1,
           42
    );

    protected $actionBase = array(
           88,   29,   92,   93,   94,   52,   53,  -16,  -16,  -16,
          -16,  -16,  -16,  -16,  -16,  -16,  -16,  -16,  -16,  -16,
          -16,  -16,  -16,  -16,  -16,  -16,  -16,   85,   81,   80,
           86,   87,   20,   20,   20,   20,   20,   20,   20,   20,
           20,   20,   20,   20,   20,   20,   20,   25,   25,   25,
           25,   25,   25,   25,   25,   25,   42,   14,   14,    3,
            3,    7,    7,    7,    7,    7,    7,    7,    7,    7,
            7,    7,    7,    7,    7,   69,   79,   98,    2,   55,
           55,   55,   38,   46,   46,   46,   49,   54,   91,  -19,
           -3,   40,   96,   72,   51,   63,   63,   73,   -5,   97,
           27,   95,   64,   11,   89,   17,   82,   59,   90,   71,
           35,   83,   60,   67,   74,   68,   45,   35,   61,   75,
           35,   70,   35,   56,   66,   35,   84,   58,   62,   76,
           65,   50,   77,   78,   57,    0,    0,    0,    0,    0,
            0,    0,    0,  -16,  -16,  -16,  -16,  -16,  -16,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,   25,
           25,   25,   25,   25,  -16,  -16,  -16,  -16,  -16,  -16,
          -16,  -16,  -16,  -16,  -16,  -16,  -16,  -16,  -16,    0,
            0,    0,    0,    0,    0,    0,    0,    0,   25,   55,
           55,   25,   25,  -16,  -16,  -16,  -16,  -16,  -16,  -16,
          -16,  -16,  -16,  -16,  -16,  -16,  -16,   55,   55,   55,
           61,    0,    0,    0,  -20,    0,    0,    0,   55,  -20,
          -20,   35,   35,    0,   35,   35,   35,    0,    0,   35,
            0,   35,    0,   35,   35
    );

    protected $actionDefault = array(
        32767,32767,32767,32767,32767,32767,32767,   91,   91,   91,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,   79,32767,32767,32767,32767,32767,
        32767,32767,   61,   61,   47,   47,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,   65,   81,   16,
        32767,   95,   80,   94,  103,  102,   87,32767,32767,   82,
           83,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,   36,
           49,   48,   57,   85,   84,   86,   71,   57,   57,32767,
        32767,32767,32767,32767,32767,   39,   40,32767,32767,   53,
        32767,   64,   74,32767,32767,32767,32767,    4,32767,32767,
           37,32767,32767,   60,32767,   46,32767,   26,32767,32767,
           25,32767,   74,32767,   78,   75,32767,   66,   66,32767,
           90,32767,32767,32767,32767,    3,   34,   34,    8,   97,
            8,    8
    );

    protected $goto = array(
          102,  102,  102,  234,  102,   80,   80,  119,   75,   76,
           79,   95,   96,   57,  187,   81,   58,   86,  132,  133,
          127,  128,    3,    4,  116,  110,  110,  110,  110,  110,
          110,  110,  110,  110,  110,  110,  110,  110,  110,  110,
          204,  201,  193,  111,  153,   78,   88,    0,    0,    0,
            0,    0,    0,    0,   99,  117,   99,   89,   92,   93,
           90,   94,  160,   97,  101,  120,  125,   54,   49,   49,
           49,   30,   31,    0,    0,    0,   48,    0,   47,   27,
           28,   29,   56,   59,   60,   83,   84,   85,   50,   50,
           52,   53,   55,  180,  180,  180,  180,  180,  180,  180,
          180,  180,  180,  180,  180,  180,  180,  180,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,  196
    );

    protected $gotoCheck = array(
           16,   16,   16,   39,   16,   23,   23,   28,   23,   23,
           23,   23,   23,   23,   23,   23,   23,   23,   33,   33,
           32,   32,    6,    6,   24,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           31,   29,   27,   17,   10,   20,   21,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   16,   16,   16,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   15,   15,   15,
           15,   15,   15,   -1,   -1,   -1,   15,   -1,   15,   15,
           15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
           15,   15,   15,   19,   19,   19,   19,   19,   19,   19,
           19,   19,   19,   19,   19,   19,   19,   19,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   19
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0, -118,    0,    0,    0,
          -38,    0,    0,    0,    0,   66,   -7,  -31,    0,   61,
          -37,  -91,    0,  -29,  -11,    0,    0,  -21,  -26,  -17,
            0,    4,   -2,   10,    0,    0,    0,    0,    0,   -8,
            0,    0
    );

    protected $gotoDefault = array(
        -32768,  105,  106,   82,  144,  107,    2,  149,  151,  152,
          177,  154,  155,  156,  126,   51,  122,  159,   98,  218,
          118,   87,  175,   77,  114,  115,  100,  194,  112,  200,
          113,  205,  208,  129,  212,    1,  123,  124,  130,  235,
          238,  103
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    4,    4,    7,   14,   16,   16,   17,
           17,   17,   17,   17,   17,   18,   18,   19,   19,   12,
           12,   13,   13,   21,   21,   22,    8,   23,   23,   23,
           23,   23,   23,   23,   23,   23,   24,   24,   25,   25,
            9,   26,   26,   27,   27,   20,   20,   20,   10,   11,
           28,   28,   30,   30,   31,   31,   15,   15,   15,   15,
           32,   32,   32,   32,   32,   32,   32,   32,   36,   36,
           37,   37,   34,   34,   34,   34,   34,   34,   29,   29,
           33,   33,   38,   38,   39,   39,   35,   35,   40,   40,
           40,   40,   41,   41
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    1,    1,    2,    1,    1,    3,    1,
            1,    1,    1,    1,    1,    3,    1,    1,    1,    3,
            5,    6,    8,    2,    0,    1,    5,    1,    1,    3,
            3,    3,    2,    2,    4,    5,    1,    0,    3,    1,
            6,    3,    1,    1,    3,    1,    1,    0,    8,   10,
            1,    0,    3,    1,    3,    5,    1,    4,    6,    6,
            1,    3,    7,    3,    1,    2,    1,    3,    1,    2,
            3,    1,    3,    3,    3,    3,    3,    3,    3,    3,
            1,    0,    3,    1,    3,    1,    2,    0,    4,    5,
            4,    5,    3,    1
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
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule14()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule15()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule16()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule17()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule18()
    {
        $this->semValue = new Node\Name\Qualified($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule19()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule20()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule21()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule22()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule23()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule24()
    {
        $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule25()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule26()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule27()
    {
        $this->semValue = $this->parseLNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule28()
    {
        $this->semValue = $this->parseDNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule29()
    {
        $this->semValue = new Node\Stmt\Import($this->semStack[$this->stackPos-(3-2)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule30()
    {
        $this->semValue = new Node\Stmt\Alias($this->semStack[$this->stackPos-(5-2)], $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule31()
    {
        $this->semValue = new Node\Stmt\Class_($this->semStack[$this->stackPos-(6-3)], [], $this->semStack[$this->stackPos-(6-5)], $this->semStack[$this->stackPos-(6-1)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule32()
    {
        $this->semValue = new Node\Stmt\Class_($this->semStack[$this->stackPos-(8-3)], $this->semStack[$this->stackPos-(8-5)], $this->semStack[$this->stackPos-(8-7)], $this->semStack[$this->stackPos-(8-1)], $this->startAttributeStack[$this->stackPos-(8-1)] + $this->endAttributes);
    }

    protected function reduceRule33()
    {
        if (is_array($this->semStack[$this->stackPos-(2-2)])) {
            $this->semValue = array_merge($this->semStack[$this->stackPos-(2-1)], $this->semStack[$this->stackPos-(2-2)]);
        } else {
            $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
            $this->semValue = $this->semStack[$this->stackPos-(2-1)];
        };
    }

    protected function reduceRule34()
    {
        $this->semValue = array();
    }

    protected function reduceRule35()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule36()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-5)], $this->semStack[$this->stackPos-(5-1)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule37()
    {
        $this->semValue = new Node\Expr\Type\Named($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule38()
    {
        $this->semValue = new Node\Expr\Type\Value($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule39()
    {
        $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule40()
    {
        $this->semValue = new Node\Expr\Type\Intersection($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule41()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule42()
    {
        $this->semValue = new Node\Expr\Type\Pointer($this->semStack[$this->stackPos-(2-1)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule43()
    {
        $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(2-1)], new Node\Expr\Type(new Node\Name('null', $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule44()
    {
        $this->semValue = new Node\Expr\Type\Specification($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule45()
    {
        $this->semValue = new Node\Expr\Type\Function_($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-5)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule46()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule47()
    {
        $this->semValue = array();
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
        $this->semValue = new Node\Stmt\Enum($this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->semStack[$this->stackPos-(6-1)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule51()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule52()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule53()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(1-1)], new Node\Expr\Type\Value(null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes), 0, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule54()
    {
        $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(3-1)], new Node\Expr\Type\Value($this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes), 0, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule55()
    {
        $this->semValue = Language\Package::PROTECTED;
    }

    protected function reduceRule56()
    {
        $this->semValue = Language\Package::PUBLIC;
    }

    protected function reduceRule57()
    {
        $this->semValue = Language\Package::PRIVATE;
    }

    protected function reduceRule58()
    {
        $this->semValue = new Node\Stmt\Function_($this->semStack[$this->stackPos-(8-3)], $this->semStack[$this->stackPos-(8-5)], $this->semStack[$this->stackPos-(8-7)], $this->semStack[$this->stackPos-(8-8)], $this->semStack[$this->stackPos-(8-1)], $this->startAttributeStack[$this->stackPos-(8-1)] + $this->endAttributes);
    }

    protected function reduceRule59()
    {
        $this->semValue = new Node\Stmt\ExprFunction($this->semStack[$this->stackPos-(10-3)], $this->semStack[$this->stackPos-(10-5)], $this->semStack[$this->stackPos-(10-7)], $this->semStack[$this->stackPos-(10-9)], $this->semStack[$this->stackPos-(10-10)], $this->semStack[$this->stackPos-(10-1)], $this->startAttributeStack[$this->stackPos-(10-1)] + $this->endAttributes);
    }

    protected function reduceRule60()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule61()
    {
        $this->semValue = [];
    }

    protected function reduceRule62()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule63()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule64()
    {
        $this->semValue = new Node\Stmt\Parameter($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], null, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule65()
    {
        $this->semValue = new Node\Stmt\Parameter($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-5)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule66()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule67()
    {
        $this->semValue = new Node\Expr\FuncCall($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule68()
    {
        $this->semValue = new Node\Expr\Pipe($this->semStack[$this->stackPos-(6-1)], $this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule69()
    {
        $this->semValue = new Node\Expr\MethodCall($this->semStack[$this->stackPos-(6-1)], $this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule70()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule71()
    {
        $this->semValue = new Node\Expr\Is($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule72()
    {
        $this->semValue = new Node\Expr\Match($this->semStack[$this->stackPos-(7-3)], $this->semStack[$this->stackPos-(7-6)], $this->startAttributeStack[$this->stackPos-(7-1)] + $this->endAttributes);
    }

    protected function reduceRule73()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule74()
    {
        $this->semValue = new Node\Expr\IdentifierReference($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule75()
    {
        $this->semValue = new Node\Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule76()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule77()
    {
        $this->semValue = new Node\Expr\Array_($this->semStack[$this->stackPos-(3-2)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule78()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule79()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule80()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule81()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule82()
    {
        $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule83()
    {
        $this->semValue = new Node\Expr\BinaryOp\Minus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule84()
    {
        $this->semValue = new Node\Expr\BinaryOp\Div($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule85()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mul($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule86()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mod($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule87()
    {
        $this->semValue = new Node\Expr\BinaryOp\Equals($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule88()
    {
        $this->semValue = [$this->semStack[$this->stackPos-(3-2)]];
    }

    protected function reduceRule89()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule90()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule91()
    {
        $this->semValue = [];
    }

    protected function reduceRule92()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule93()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule94()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule95()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule96()
    {
        $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule97()
    {
        $this->semValue = array();
    }

    protected function reduceRule98()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(4-1)], [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule99()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule100()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule101()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule102()
    {
        $this->semValue = new Node\Expr\BinaryOp\BooleanOr($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule103()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }
}

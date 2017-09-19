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
    protected $tokenToSymbolMapSize = 276;
    protected $actionTableSize = 141;
    protected $gotoTableSize = 97;

    protected $invalidSymbol = 42;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 102;
    protected $YYNLSTATES   = 138;

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
        "'['",
        "']'",
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
            0,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   41,    7,    9,   42,
           10,   11,    5,    3,   18,    4,   42,    6,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   17,   29,
           15,   40,   16,   14,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   12,   42,   13,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   38,    8,   39,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,    1,    2,   19,   20,
           21,   22,   23,   24,   25,   26,   27,   28,   30,   31,
           32,   33,   34,   35,   36,   37
    );

    protected $action = array(
           13,-32766,    9,-32766,-32766,-32766,   59,    7,    0,   29,
          158,   61,  161,  160,  162,-32766,   68,-32766,  213,-32766,
          159,  157,   62,   38,  165,  166,    8,  120,   30,   -1,
        -32766,   67,   15,   16,   17,   18,   19,   20,   56,  108,
            7,-32766,-32766,  180,-32766,   57,   32,   33,-32766,   68,
           66,   58,  181,   27,    5,-32766,   38,   14,   69,-32766,
          130,  132,  134,  167,   12,   24,  188,  181,   27,   25,
          133,   26,  207,    6,   23,  193,  194,   34,  165,  166,
           35,   37,  205,  212,  179,  128,  208,  131,   60,   64,
           63,  107,  182,  168,   22,  103,   10,   21,   28,   36,
           11,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,  153,  224,  236,  234,    0,    0,  143,  144,    0,
            0,    0,    0,    0,    0,    0,  135,   55,  136,  137,
            0,  169,  170,  225,  237,  235,    0,   31,   88,    0,
           65
    );

    protected $actionCheck = array(
           10,    2,   12,    2,    3,    4,   20,   10,    0,   23,
           20,   25,   22,   23,   24,    5,   19,   10,   13,   12,
           30,   31,   36,   26,   34,   35,   10,   37,   10,    0,
           12,   41,    2,    3,    4,    5,    6,    7,   15,   21,
           10,   34,   35,    5,   37,   18,    8,    9,   41,   19,
           18,   22,   14,   15,   17,   37,   26,   10,   24,   41,
           27,   38,   38,   29,   40,   10,   39,   14,   15,   10,
           38,   10,   39,   17,   18,   32,   33,   11,   34,   35,
           11,   11,   11,   11,   11,   11,   11,   29,   21,   21,
           28,   28,   16,   29,   17,   30,   18,   18,   18,   18,
           40,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   29,   29,   29,   29,   -1,   -1,   31,   31,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   38,   38,   38,   38,
           -1,   39,   39,   39,   39,   39,   -1,   40,   40,   -1,
           41
    );

    protected $actionBase = array(
           65,   33,   94,   95,   96,   90,   91,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,   18,   18,   18,   18,   18,   18,
           18,   18,   18,   18,   18,   18,   18,   18,   18,   83,
           75,   74,   84,   85,   30,   30,   30,   30,   30,   30,
           30,   30,   -1,   24,   24,    7,    7,    7,    7,    7,
            7,    7,    7,    7,    7,    7,    7,    7,    7,    7,
           68,   73,   99,    1,    1,  -14,   38,   38,   38,   29,
           10,   92,   93,   34,   23,   -3,   -3,   -3,   44,   97,
           55,   89,   53,   53,   59,   32,   98,   27,   60,   53,
           77,   16,   56,   86,    8,   58,   63,   87,   61,   62,
           64,   66,   80,   69,   81,   76,   62,   67,   70,   62,
           47,   62,    5,   79,   62,   82,   71,   78,   88,   72,
           37,    0,    0,    0,    0,    0,    0,    0,    0,  -10,
          -10,  -10,  -10,  -10,  -10,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,  -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,   30,   30,   30,
           30,   30,    0,    0,    0,    0,    0,    0,    0,    0,
           30,   38,   38,  -10,  -10,  -10,  -10,  -10,  -10,  -10,
          -10,  -10,  -10,  -10,  -10,  -10,  -10,  -10,   38,   38,
           38,   30,   30,   67,    0,    0,    0,   43,   38,   43,
           43,   62,   62,    0,    0,    0,    0,   62,   62,   62,
            0,    0,   62,    0,   62,    0,   62,    0,   62,   62
    );

    protected $actionDefault = array(
        32767,32767,32767,32767,32767,32767,32767,   89,   89,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,   77,32767,32767,   61,   61,   47,   47,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,   65,   79,   16,   93,   78,   92,
          101,  100,   85,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,   80,   81,32767,   36,   49,   48,   57,
           68,   57,   57,32767,32767,   83,   82,   84,32767,32767,
        32767,32767,   39,   40,32767,32767,   53,32767,   64,   45,
           71,32767,32767,32767,32767,32767,    4,32767,32767,   37,
        32767,32767,   60,32767,   46,32767,   26,32767,32767,   25,
        32767,   71,32767,   76,   72,32767,32767,   88,32767,32767,
        32767,    3,   34,   34,    8,   95,    8,    8
    );

    protected $goto = array(
          100,  100,  129,  100,   77,   77,  228,   70,   71,   76,
           92,   93,   53,   99,   78,   54,   80,  109,  109,  109,
          109,  109,  109,  109,  109,  109,  109,  109,  109,  109,
          109,  109,  176,  176,  176,  176,  176,  176,  176,  176,
          176,  176,  176,  176,  176,  176,  176,  118,   96,  116,
           96,   83,   89,   90,   84,   91,  156,   94,   98,  119,
          124,  101,   50,    3,    4,  115,   42,   43,   47,   47,
           45,   47,   44,   39,   40,   41,   52,   73,   74,   85,
           86,   87,   48,   49,   51,  200,  197,  189,  110,  149,
           75,   82,    0,    0,    0,    0,  192
    );

    protected $gotoCheck = array(
           16,   16,   33,   16,   23,   23,   38,   23,   23,   23,
           23,   23,   23,   23,   23,   23,   23,   16,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   19,   19,   19,   19,   19,   19,   19,   19,
           19,   19,   19,   19,   19,   19,   19,   28,   16,   16,
           16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
           16,   16,   15,    6,    6,   24,   15,   15,   15,   15,
           15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
           15,   15,   15,   15,   15,   31,   29,   27,   17,   10,
           20,   21,   -1,   -1,   -1,   -1,   19
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,  -73,    0,    0,    0,
           10,    0,    0,    0,    0,   61,   -7,   19,    0,    8,
           11,  -42,    0,  -22,   38,    0,    0,   30,   22,   32,
            0,   57,    0,   -6,    0,    0,    0,    0,   -4,    0,
            0
    );

    protected $gotoDefault = array(
        -32768,  104,  105,   79,  140,  106,    2,  145,  147,  148,
          173,  150,  151,  152,  125,   46,  121,  155,   95,  211,
          117,   81,  171,   72,  113,  114,   97,  190,  111,  196,
          112,  201,  204,  126,    1,  122,  123,  127,  229,  232,
          102
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    4,    4,    7,   14,   16,   16,   17,
           17,   17,   17,   17,   17,   18,   18,   19,   19,   12,
           12,   13,   13,   21,   21,   22,    8,   23,   23,   23,
           23,   23,   23,   23,   23,   23,   24,   24,   25,   25,
            9,   26,   26,   27,   27,   20,   20,   20,   10,   11,
           28,   28,   30,   30,   31,   31,   15,   15,   15,   15,
           15,   15,   15,   15,   15,   15,   35,   35,   36,   36,
           32,   32,   32,   32,   32,   32,   29,   29,   33,   33,
           37,   37,   38,   38,   34,   34,   39,   39,   39,   39,
           40,   40
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    1,    1,    2,    1,    1,    3,    1,
            1,    1,    1,    1,    1,    3,    1,    1,    1,    3,
            5,    6,    8,    2,    0,    1,    5,    1,    1,    3,
            3,    3,    2,    2,    4,    5,    1,    0,    3,    1,
            6,    3,    1,    1,    3,    1,    1,    0,    8,   10,
            1,    0,    3,    1,    3,    5,    1,    4,    3,    7,
            3,    1,    2,    1,    6,    3,    1,    2,    3,    1,
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
        $this->semValue = new Node\Expr\Is($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule69()
    {
        $this->semValue = new Node\Expr\Match($this->semStack[$this->stackPos-(7-3)], $this->semStack[$this->stackPos-(7-6)], $this->startAttributeStack[$this->stackPos-(7-1)] + $this->endAttributes);
    }

    protected function reduceRule70()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule71()
    {
        $this->semValue = new Node\Expr\IdentifierReference($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule72()
    {
        $this->semValue = new Node\Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule73()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule74()
    {
        $this->semValue = new Node\Expr\MethodCall($this->semStack[$this->stackPos-(6-1)], $this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule75()
    {
        $this->semValue = new Node\Expr\Array_($this->semStack[$this->stackPos-(3-2)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule76()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule77()
    {
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule78()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule79()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule80()
    {
        $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule81()
    {
        $this->semValue = new Node\Expr\BinaryOp\Minus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule82()
    {
        $this->semValue = new Node\Expr\BinaryOp\Div($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule83()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mul($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule84()
    {
        $this->semValue = new Node\Expr\BinaryOp\Mod($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule85()
    {
        $this->semValue = new Node\Expr\BinaryOp\Equals($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule86()
    {
        $this->semValue = [$this->semStack[$this->stackPos-(3-2)]];
    }

    protected function reduceRule87()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule88()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule89()
    {
        $this->semValue = [];
    }

    protected function reduceRule90()
    {
        $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)];
        $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule91()
    {
        $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule92()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule93()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule94()
    {
        $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)];
        $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule95()
    {
        $this->semValue = array();
    }

    protected function reduceRule96()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(4-1)], [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule97()
    {
        $this->semValue = new Node\Expr\MatchEntry($this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule98()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, [$this->semStack[$this->stackPos-(4-3)]], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule99()
    {
        $this->semValue = new Node\Expr\MatchEntry(null, $this->semStack[$this->stackPos-(5-4)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule100()
    {
        $this->semValue = new Node\Expr\BinaryOp\BooleanOr($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule101()
    {
        $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }
}

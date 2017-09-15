<?php

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

/* This is an automatically GENERATED file, which should not be manually edited.
 * Instead edit one of the following:
 *  * the grammar files grammar/language.y
 *  * the skeleton file grammar/parser.template.php
 *  * the preprocessing script grammar/rebuildParsers.php
 */
class Parser extends ParserAbstract
{
    protected $tokenToSymbolMapSize = 272;
    protected $actionTableSize = 88;
    protected $gotoTableSize = 76;

    protected $invalidSymbol = 30;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 64;
    protected $YYNLSTATES   = 85;

    protected $symbolToName = array(
        "EOF",
        "error",
        "'+'",
        "'|'",
        "'&'",
        "'('",
        "')'",
        "'*'",
        "'?'",
        "'<'",
        "'>'",
        "':'",
        "','",
        "T_TYPE",
        "T_FUNCTION",
        "T_ON",
        "T_IS",
        "T_SCOPE_OPERATOR",
        "T_PACKAGE",
        "T_STRING",
        "T_PROTECTED",
        "T_PUBLIC",
        "T_LNUMBER",
        "T_DNUMBER",
        "T_ENUM",
        "';'",
        "'='",
        "'{'",
        "'}'",
        "'$'"
    );

    protected $tokenToSymbol = array(
            0,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   29,   30,    4,   30,
            5,    6,    7,    2,   12,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   11,   25,
            9,   26,   10,    8,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   27,    3,   28,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,   30,   30,   30,   30,
           30,   30,   30,   30,   30,   30,    1,   30,   13,   14,
           15,   16,   30,   17,   18,   19,   20,   21,   22,   23,
           24,   30
    );

    protected $action = array(
          101,    6,  103,   35,    6,  102,  100,   18,   19,  105,
          106,  113,  114,   13,   36,   37,   15,   -1,    0,  121,
           16,    7,  146,   42,    7,   38,   42,    8,-32766,   69,
            2,-32766,-32766,  105,  106,-32766,-32766,  126,  127,   10,
           11,   24,    5,   84,   12,    3,   20,   21,   23,  142,
          112,   40,   24,    4,   83,  115,   64,    9,   17,   14,
           22,    0,    0,    0,    0,    0,   39,   68,    0,    0,
           90,   91,    0,    0,    0,    0,    0,    0,   98,  145,
            0,   54,    0,   34,    0,  138,    0,   41
    );

    protected $actionCheck = array(
           13,    7,   15,   12,    7,   18,   19,    3,    4,   22,
           23,    7,    8,    9,   13,   14,   15,    0,    0,   28,
            5,   27,   28,   29,   27,   24,   29,    2,    2,   14,
            5,    3,    4,   22,   23,   22,   23,   20,   21,    5,
            5,   16,   26,   27,    5,   12,    6,    6,    6,    6,
            6,   14,   16,   26,   25,   10,   18,   11,   26,   12,
           12,   -1,   -1,   -1,   -1,   -1,   17,   17,   -1,   -1,
           19,   19,   -1,   -1,   -1,   -1,   -1,   -1,   25,   25,
           -1,   26,   -1,   27,   -1,   28,   -1,   29
    );

    protected $actionBase = array(
           38,   -6,   -3,   -3,   -3,   -3,   -3,   -3,   -3,   -3,
           15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
           15,   15,   15,   15,   15,   16,   16,   37,   44,   58,
            4,    4,    4,    4,   13,   13,   13,   13,   13,   13,
           13,   13,   13,    1,   54,   57,   17,   28,   28,   28,
           25,   25,   25,   25,   11,   32,   34,   56,   35,   55,
           -9,   27,   26,   46,   51,   18,   29,   50,   52,   39,
           49,   40,   47,   41,   48,   45,   42,   49,   36,   49,
           53,   43,   33,    0,    0,    0,  -13,  -13,  -13,  -13,
          -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,
          -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,
            4,    4,    4,    4,    4,    0,    0,    0,    0,  -13,
          -13,  -13,  -13,  -13,  -13,  -13,  -13,  -13,    0,   25,
           25,    0,    4,    4,    4,    0,    0,    0,    0,    0,
           49,   49,   49,   49,   49,    0,   49,   25,   49
    );

    protected $actionDefault = array(
        32767,32767,   63,32767,32767,32767,32767,32767,32767,32767,
           47,   47,   33,   33,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
           22,   35,   34,   59,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,   43,   25,   26,   31,
           51,   14,   67,   66,32767,32767,32767,32767,32767,   39,
        32767,   50,   56,   54,32767,32767,32767,    4,32767,32767,
           23,32767,   46,32767,   32,32767,32767,   54,   58,   55,
        32767,32767,   62,    3,    8
    );

    protected $goto = array(
           77,   63,   63,   77,   77,   77,   77,   77,   77,   31,
           31,  149,   27,   28,   30,   47,   48,   25,   49,   32,
           26,   33,  137,  137,  137,  137,  137,  137,  137,  137,
          137,   76,   75,   59,   59,   55,   56,   57,  104,   58,
           61,   79,   51,  133,  130,   50,   44,   78,   45,   62,
           53,  122,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,  125
    );

    protected $gotoCheck = array(
           14,   14,   14,   14,   14,   14,   14,   14,   14,   17,
           17,   28,   17,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   15,   15,   15,   15,   15,   15,   15,   15,
           15,   22,   18,   14,   14,   14,   14,   14,   14,   14,
           14,   14,   13,   25,   23,   13,   13,   13,   13,   13,
           13,   21,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   15
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,   41,   -1,   21,    0,   -3,   19,    0,
            0,   16,   20,   18,    0,   29,    0,    0,    8
    );

    protected $gotoDefault = array(
        -32768,   65,   66,   46,   87,   67,    1,   92,   94,   95,
           96,   97,   80,   52,   70,  109,   43,   29,   73,   74,
           60,  123,   71,  129,   72,  134,   81,   82,  150
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    7,   12,   14,   14,   14,   14,   14,
           15,   15,    8,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   18,   18,   19,   19,    9,   20,   20,   21,
           21,   16,   16,   16,   10,   11,   22,   22,   24,   24,
           25,   25,   13,   13,   13,   13,   13,   13,   13,   13,
           23,   23,   26,   26,   27,   27,   28,   28
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    2,    1,    1,    1,    1,    1,    3,
            1,    1,    5,    1,    1,    3,    3,    3,    2,    2,
            4,    5,    1,    0,    3,    1,    6,    3,    1,    1,
            3,    1,    1,    0,    8,   10,    1,    0,    3,    1,
            3,    5,    1,    3,    1,    2,    3,    4,    2,    3,
            3,    3,    1,    0,    3,    1,    3,    1
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
         if (is_array($this->semStack[$this->stackPos-(2-2)])) { $this->semValue = array_merge($this->semStack[$this->stackPos-(2-1)], $this->semStack[$this->stackPos-(2-2)]); } else { $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)]; $this->semValue = $this->semStack[$this->stackPos-(2-1)]; };
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
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule7()
    {
         $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)]; $this->semValue = $this->semStack[$this->stackPos-(2-1)];
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
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
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
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
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
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
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
         $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule54()
    {
         $this->semValue = new Node\Expr\IdentifierReference($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule55()
    {
         $this->semValue = new Node\Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule56()
    {
         $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule57()
    {
         $this->semValue = new Node\Expr\FuncCall($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule58()
    {
         $this->semValue = new Node\Expr\PointerDereference($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule59()
    {
         $this->semValue = new Node\Expr\Is($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule60()
    {
         $this->semValue = [$this->semStack[$this->stackPos-(3-2)]];
    }

    protected function reduceRule61()
    {
         $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule62()
    {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule63()
    {
         $this->semValue = [];
    }

    protected function reduceRule64()
    {
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule65()
    {
         $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule66()
    {
         $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule67()
    {
         $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }
}


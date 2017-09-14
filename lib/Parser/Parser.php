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
    protected $tokenToSymbolMapSize = 268;
    protected $actionTableSize = 79;
    protected $gotoTableSize = 76;

    protected $invalidSymbol = 29;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 57;
    protected $YYNLSTATES   = 79;

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
        "T_TYPE",
        "T_FUNCTION",
        "T_ON",
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
        "','",
        "'{'",
        "'}'",
        "'$'"
    );

    protected $tokenToSymbol = array(
            0,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   28,   29,    4,   29,
            5,    6,    7,    2,   25,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   11,   23,
            9,   24,   10,    8,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   26,    3,   27,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,   29,   29,   29,   29,
           29,   29,   29,   29,   29,   29,    1,   12,   13,   14,
           15,   16,   17,   18,   19,   20,   21,   22
    );

    protected $action = array(
           95,   19,   97,   78,   96,   94,   10,   11,   99,  100,
          107,  108,    4,   32,   33,    7,   -1,    8,   31,    0,
          115,-32766,-32766,   34,   20,   62,   99,  100,-32766,-32766,
            1,  137,   38,    2,  120,  121,    3,   16,   14,   12,
           15,   69,  135,  106,   35,   61,   77,   92,  109,   38,
           21,    6,    0,   36,    0,    0,    0,   57,    0,   84,
           85,    0,    0,    0,    0,    0,    0,    0,    9,   18,
           43,    0,   13,   17,    0,   30,    0,    0,   37
    );

    protected $actionCheck = array(
           12,   24,   14,   26,   16,   17,    3,    4,   20,   21,
            7,    8,    9,   12,   13,   14,    0,    5,   25,    0,
           27,    3,    4,   22,    2,   13,   20,   21,   20,   21,
            5,   27,   28,    5,   18,   19,    5,    5,   11,    6,
            6,    6,    6,    6,   15,   15,   23,   23,   10,   28,
           11,   25,   -1,   13,   -1,   -1,   -1,   16,   -1,   17,
           17,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   24,   24,
           24,   -1,   25,   25,   -1,   26,   -1,   -1,   28
    );

    protected $actionBase = array(
           41,   12,   12,   12,   12,    4,   12,   12,   12,   12,
           12,   12,   12,   12,   12,   12,   21,   21,   21,   21,
           21,   21,  -23,  -23,   40,   37,   50,    3,    3,    3,
            8,    8,    8,    8,    8,    8,    8,    8,    8,    1,
           16,   18,   18,    6,   44,   25,   49,   28,   46,   -7,
           45,   22,   22,   22,   22,   39,   22,   42,   19,   23,
           30,   43,   31,   29,   33,   26,   35,   47,   38,   27,
           34,   29,   29,   24,   32,   36,   48,    0,    0,    0,
          -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,
          -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,
          -12,    3,    3,    3,    3,    3,    0,    0,    0,  -12,
          -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,    0,    0,
            3,    3,    0,   29,   29,   29,   29,   29,    0,   29,
           32,   32,   32,   32,   29,   32
    );

    protected $actionDefault = array(
        32767,   47,   47,   33,   33,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,   60,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,   22,   35,   34,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
           43,   25,   26,32767,32767,32767,32767,32767,   39,32767,
           50,   51,   57,   14,   64,   53,   63,32767,32767,32767,
            4,32767,32767,   23,32767,   46,32767,   32,32767,32767,
        32767,   53,   54,32767,   55,32767,   59,    3,    8
    );

    protected $goto = array(
           71,   68,  127,   70,   53,  140,  124,  116,    0,    0,
            0,   55,   55,   71,   71,   71,   71,   51,   52,   74,
           56,    0,    0,    0,    0,   48,   48,   44,   45,   46,
           98,   47,   50,   72,   28,   28,    0,  131,   24,   25,
           27,   41,   42,   22,   29,  110,   23,    0,  131,  131,
          131,  131,  131,  131,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,  119
    );

    protected $gotoCheck = array(
           14,   18,   25,   22,   13,   28,   23,   21,   -1,   -1,
           -1,   14,   14,   14,   14,   14,   14,   13,   13,   13,
           13,   -1,   -1,   -1,   -1,   14,   14,   14,   14,   14,
           14,   14,   14,   14,   17,   17,   -1,   15,   17,   17,
           17,   17,   17,   17,   17,   17,   17,   -1,   15,   15,
           15,   15,   15,   15,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   -1,   15
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,   -1,   -5,   32,    0,   31,   -3,    0,
            0,  -24,    1,  -17,    0,   -4,    0,    0,  -12
    );

    protected $gotoDefault = array(
        -32768,   58,   59,   40,   81,   60,    5,   86,   88,   89,
           90,   91,   73,   54,   63,  103,   39,   26,   66,   67,
           49,  117,   64,  123,   65,  128,   75,   76,  141
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    7,   12,   14,   14,   14,   14,   14,
           15,   15,    8,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   18,   18,   19,   19,    9,   20,   20,   21,
           21,   16,   16,   16,   10,   11,   22,   22,   24,   24,
           25,   25,   13,   13,   13,   13,   13,   23,   23,   26,
           26,   27,   27,   28,   28
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    2,    1,    1,    1,    1,    1,    3,
            1,    1,    5,    1,    1,    3,    3,    3,    2,    2,
            4,    6,    1,    0,    3,    1,    6,    3,    1,    1,
            3,    1,    1,    0,    8,   10,    1,    0,    3,    1,
            3,    5,    1,    1,    2,    3,    4,    2,    3,    1,
            0,    3,    1,    3,    1
    );

    protected function reduceRule0() {
        $this->semValue = $this->semStack[$this->stackPos];
    }

    protected function reduceRule1() {
         $this->semValue = new Node\Stmt\Package($this->semStack[$this->stackPos-(4-2)], $this->semStack[$this->stackPos-(4-4)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule2() {
         if (is_array($this->semStack[$this->stackPos-(2-2)])) { $this->semValue = array_merge($this->semStack[$this->stackPos-(2-1)], $this->semStack[$this->stackPos-(2-2)]); } else { $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)]; $this->semValue = $this->semStack[$this->stackPos-(2-1)]; };
    }

    protected function reduceRule3() {
         $this->semValue = array();
    }

    protected function reduceRule4() {
         $this->semValue = new Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule5() {
         $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule6() {
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule7() {
         $this->semStack[$this->stackPos-(2-1)][] = $this->semStack[$this->stackPos-(2-2)]; $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule8() {
         $this->semValue = array();
    }

    protected function reduceRule9() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule10() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule11() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule12() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule13() {
         $this->semValue = $this->semStack[$this->stackPos-(2-1)];
    }

    protected function reduceRule14() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule15() {
         $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule16() {
         $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule17() {
         $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule18() {
         $this->semValue = new Node\Name($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule19() {
         $this->semValue = new Node\Name\Qualified($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule20() {
         $this->semValue = $this->parseLNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule21() {
         $this->semValue = $this->parseDNumber($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule22() {
         $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-5)], $this->semStack[$this->stackPos-(5-1)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule23() {
         $this->semValue = new Node\Expr\Type\Named($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule24() {
         $this->semValue = new Node\Expr\Type\Value($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule25() {
         $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule26() {
         $this->semValue = new Node\Expr\Type\Intersection($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule27() {
         $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule28() {
         $this->semValue = new Node\Expr\Type\Pointer($this->semStack[$this->stackPos-(2-1)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule29() {
         $this->semValue = new Node\Expr\Type\Union($this->semStack[$this->stackPos-(2-1)], new Node\Expr\Type(new Node\Name('null', $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes), $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule30() {
         $this->semValue = new Node\Expr\Type\Specification($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule31() {
         $this->semValue = new Node\Expr\Type\Function_($this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-6)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule32() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule33() {
         $this->semValue = array();
    }

    protected function reduceRule34() {
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule35() {
         $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule36() {
         $this->semValue = new Node\Stmt\Enum($this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-5)], $this->semStack[$this->stackPos-(6-1)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
    }

    protected function reduceRule37() {
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule38() {
         $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule39() {
         $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(1-1)], new Node\Expr\Type\Value(null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes), 0, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule40() {
         $this->semValue = new Node\Stmt\Type($this->semStack[$this->stackPos-(3-1)], new Node\Expr\Type\Value($this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes), 0, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule41() {
         $this->semValue = Language\Package::PROTECTED;
    }

    protected function reduceRule42() {
         $this->semValue = Language\Package::PUBLIC;
    }

    protected function reduceRule43() {
         $this->semValue = Language\Package::PRIVATE;
    }

    protected function reduceRule44() {
         $this->semValue = new Node\Stmt\Function_($this->semStack[$this->stackPos-(8-3)], $this->semStack[$this->stackPos-(8-5)], $this->semStack[$this->stackPos-(8-7)], $this->semStack[$this->stackPos-(8-8)], $this->semStack[$this->stackPos-(8-1)], $this->startAttributeStack[$this->stackPos-(8-1)] + $this->endAttributes);
    }

    protected function reduceRule45() {
         $this->semValue = new Node\Stmt\ExprFunction($this->semStack[$this->stackPos-(10-3)], $this->semStack[$this->stackPos-(10-5)], $this->semStack[$this->stackPos-(10-7)], $this->semStack[$this->stackPos-(10-9)], $this->semStack[$this->stackPos-(10-10)], $this->semStack[$this->stackPos-(10-1)], $this->startAttributeStack[$this->stackPos-(10-1)] + $this->endAttributes);
    }

    protected function reduceRule46() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule47() {
         $this->semValue = [];
    }

    protected function reduceRule48() {
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule49() {
         $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule50() {
         $this->semValue = new Node\Stmt\Parameter($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], null, $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule51() {
         $this->semValue = new Node\Stmt\Parameter($this->semStack[$this->stackPos-(5-3)], $this->semStack[$this->stackPos-(5-1)], $this->semStack[$this->stackPos-(5-5)], $this->startAttributeStack[$this->stackPos-(5-1)] + $this->endAttributes);
    }

    protected function reduceRule52() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule53() {
         $this->semValue = new Node\Expr\IdentifierReference($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule54() {
         $this->semValue = new Node\Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule55() {
         $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule56() {
         $this->semValue = new Node\Expr\FuncCall($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule57() {
         $this->semValue = [$this->semStack[$this->stackPos-(2-2)]];
    }

    protected function reduceRule58() {
         $this->semValue = $this->semStack[$this->stackPos-(3-2)];
    }

    protected function reduceRule59() {
         $this->semValue = $this->semStack[$this->stackPos-(1-1)];
    }

    protected function reduceRule60() {
         $this->semValue = [];
    }

    protected function reduceRule61() {
         $this->semStack[$this->stackPos-(3-1)][] = $this->semStack[$this->stackPos-(3-3)]; $this->semValue = $this->semStack[$this->stackPos-(3-1)];
    }

    protected function reduceRule62() {
         $this->semValue = array($this->semStack[$this->stackPos-(1-1)]);
    }

    protected function reduceRule63() {
         $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule64() {
         $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }
}


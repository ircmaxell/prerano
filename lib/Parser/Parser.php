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
    protected $tokenToSymbolMapSize = 268;
    protected $actionTableSize = 82;
    protected $gotoTableSize = 63;

    protected $invalidSymbol = 29;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE  = 58;
    protected $YYNLSTATES   = 80;

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
           96,   20,   98,   20,   97,   95,   12,   13,  100,  101,
          108,  109,    6,   33,   34,    9,   -1,   10,   32,    0,
          116,  139,   39,   35,   39,   63,   18,   21,   79,-32766,
        -32766,  100,  101,    2,  121,  122,    3,-32766,-32766,    4,
            5,   16,   14,   19,   70,  136,  107,   36,   62,    7,
           78,  110,   93,   22,    0,    0,   37,    0,    0,    0,
           58,    0,   85,   86,    0,    0,    0,    0,    0,    0,
            0,   11,   17,   44,    0,    8,   15,    0,   31,    0,
            0,   38
    );

    protected $actionCheck = array(
           12,    7,   14,    7,   16,   17,    3,    4,   20,   21,
            7,    8,    9,   12,   13,   14,    0,    5,   25,    0,
           27,   27,   28,   22,   28,   13,   24,    2,   26,    3,
            4,   20,   21,    5,   18,   19,    5,   20,   21,    5,
            5,   11,    6,    6,    6,    6,    6,   15,   15,   25,
           23,   10,   23,   11,   -1,   -1,   13,   -1,   -1,   -1,
           16,   -1,   17,   17,   -1,   -1,   -1,   -1,   -1,   -1,
           -1,   24,   24,   24,   -1,   25,   25,   -1,   26,   -1,
           -1,   28
    );

    protected $actionBase = array(
           44,   -6,   12,   12,   -4,   12,   12,   12,   -4,   12,
           12,   12,   12,   12,   12,   12,   12,   -4,   -4,   12,
           -4,   -4,   -4,    2,    2,   43,   40,   53,    3,    3,
            3,   17,   17,   17,   17,   17,   17,   17,   17,   17,
            1,   16,   26,   26,   11,   47,   28,   52,   31,   49,
           -7,   48,   25,   25,   25,   25,   42,   25,   45,   19,
           27,   33,   46,   35,   32,   36,   24,   38,   51,   41,
           30,   37,   32,   32,   29,   34,   39,   50,    0,    0,
            0,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,
          -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,
          -12,  -12,  -12,    3,    3,    3,    3,    3,    0,    0,
            0,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,  -12,
            0,    0,    3,    3,    0,   32,   32,   32,   32,   32,
            0,   32,   34,   34,   34,   34,   32,   34
    );

    protected $actionDefault = array(
        32767,32767,   47,   47,   61,   33,   33,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,32767,32767,32767,32767,32767,32767,32767,   22,   35,
           34,32767,32767,32767,32767,32767,32767,32767,32767,32767,
        32767,   43,   25,   26,32767,32767,32767,32767,32767,   39,
        32767,   50,   51,   58,   14,   65,   53,   64,32767,32767,
        32767,    4,32767,32767,   23,32767,   46,32767,   32,32767,
        32767,32767,   53,   54,32767,   55,32767,   60,    3,    8
    );

    protected $goto = array(
           72,   71,   69,   56,  128,  125,  117,   56,  132,  142,
            0,  132,    0,    0,    0,  132,   72,   72,    0,   72,
           72,   72,    0,    0,  132,  132,    0,  132,  132,  132,
           49,   49,   45,   46,   47,   99,   48,   51,   73,   29,
           29,   54,    0,   25,   26,   28,   42,   43,   23,   30,
          111,  120,    0,   24,    0,    0,    0,   52,   53,    0,
          137,   75,   57
    );

    protected $gotoCheck = array(
           14,   22,   18,   14,   25,   23,   21,   14,   15,   28,
           -1,   15,   -1,   -1,   -1,   15,   14,   14,   -1,   14,
           14,   14,   -1,   -1,   15,   15,   -1,   15,   15,   15,
           14,   14,   14,   14,   14,   14,   14,   14,   14,   17,
           17,   13,   -1,   17,   17,   17,   17,   17,   17,   17,
           17,   15,   -1,   17,   -1,   -1,   -1,   13,   13,   -1,
           13,   13,   13
    );

    protected $gotoBase = array(
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    0,   40,   -1,    7,    0,   34,   -4,    0,
            0,  -26,   -2,  -19,    0,   -3,    0,    0,    1
    );

    protected $gotoDefault = array(
        -32768,   59,   60,   41,   82,   61,    1,   87,   89,   90,
           91,   92,   74,   55,   64,  104,   40,   27,   67,   68,
           50,  118,   65,  124,   66,  129,   76,   77,  143
    );

    protected $ruleToNonTerminal = array(
            0,    1,    3,    3,    2,    5,    5,    6,    6,    4,
            4,    4,    4,    7,   12,   14,   14,   14,   14,   14,
           15,   15,    8,   17,   17,   17,   17,   17,   17,   17,
           17,   17,   18,   18,   19,   19,    9,   20,   20,   21,
           21,   16,   16,   16,   10,   11,   22,   22,   24,   24,
           25,   25,   13,   13,   13,   13,   13,   13,   23,   23,
           26,   26,   27,   27,   28,   28
    );

    protected $ruleToLength = array(
            1,    4,    2,    0,    1,    1,    3,    2,    0,    1,
            1,    1,    1,    2,    1,    1,    1,    1,    1,    3,
            1,    1,    5,    1,    1,    3,    3,    3,    2,    2,
            4,    6,    1,    0,    3,    1,    6,    3,    1,    1,
            3,    1,    1,    0,    8,   10,    1,    0,    3,    1,
            3,    5,    1,    1,    2,    3,    4,    2,    2,    3,
            1,    0,    3,    1,    3,    1
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
        $this->semValue = new Node\Expr\Type\Function_($this->semStack[$this->stackPos-(6-3)], $this->semStack[$this->stackPos-(6-6)], $this->startAttributeStack[$this->stackPos-(6-1)] + $this->endAttributes);
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
        $this->semValue = new Node\Expr\IdentifierReference($this->semStack[$this->stackPos-(1-1)], $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }

    protected function reduceRule54()
    {
        $this->semValue = new Node\Expr\Variable($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule55()
    {
        $this->semValue = new Node\Expr\BinaryOp\Plus($this->semStack[$this->stackPos-(3-1)], $this->semStack[$this->stackPos-(3-3)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule56()
    {
        $this->semValue = new Node\Expr\FuncCall($this->semStack[$this->stackPos-(4-1)], $this->semStack[$this->stackPos-(4-3)], $this->startAttributeStack[$this->stackPos-(4-1)] + $this->endAttributes);
    }

    protected function reduceRule57()
    {
        $this->semValue = new Node\Expr\PointerDereference($this->semStack[$this->stackPos-(2-2)], $this->startAttributeStack[$this->stackPos-(2-1)] + $this->endAttributes);
    }

    protected function reduceRule58()
    {
        $this->semValue = [$this->semStack[$this->stackPos-(2-2)]];
    }

    protected function reduceRule59()
    {
        $this->semValue = $this->semStack[$this->stackPos-(3-2)];
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
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(3-3)], $this->semStack[$this->stackPos-(3-1)], $this->startAttributeStack[$this->stackPos-(3-1)] + $this->endAttributes);
    }

    protected function reduceRule65()
    {
        $this->semValue = new Node\Arg($this->semStack[$this->stackPos-(1-1)], null, $this->startAttributeStack[$this->stackPos-(1-1)] + $this->endAttributes);
    }
}

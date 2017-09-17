<?php
declare(strict_types=1);

namespace Prerano\Parser;

use Generator;

class Lexer
{
    const TOKEN_MAP = [
        'protected' => Tokens::T_PROTECTED,
        'package' => Tokens::T_PACKAGE,
        'public' => Tokens::T_PUBLIC,
        'match' => Tokens::T_MATCH,
        'else' => Tokens::T_ELSE,
        'enum' => Tokens::T_ENUM,
        'type' => Tokens::T_TYPE,
        '::' => Tokens::T_SCOPE_OPERATOR,
        '->' => Tokens::T_SKINNY_ARROW,
        '==' => Tokens::T_EQUALS,
        'fn' => Tokens::T_FUNCTION,
        'is' => Tokens::T_IS,
        'on' => Tokens::T_ON,
        '!' => 0x21,
        '#' => 0x23,
        '$' => 0x24,
        '%' => 0x25,
        '&' => 0x26,
        '(' => 0x28,
        ')' => 0x29,
        '*' => 0x2a,
        '+' => 0x2b,
        ',' => 0x2c,
        '-' => 0x2d,
        '.' => 0x2e,
        '/' => 0x2f,
        ':' => 0x3a,
        ';' => 0x3b,
        '<' => 0x3c,
        '=' => 0x3d,
        '>' => 0x3e,
        '?' => 0x3f,
        '@' => 0x40,
        '[' => 0x5b,
        '\\' => 0x5c,
        ']' => 0x5d,
        '{' => 0x7b,
        '|' => 0x7c,
        '}' => 0x7d,
        '~' => 0x7e,
    ];

    protected $generator;

    public function setInput(string $input)
    {
        $this->input  = $input;
        $this->generator = $this->scan($input);
    }

    public function next()
    {
        if ($this->generator->valid()) {
            $return = $this->generator->current();
            $this->generator->next();
            return $return;
        }
        return [
            'value' => "\0",
            'id' => 0,
            'filePos' => 0,
            'linePos' => 0,
            'startLine' => 0,
            'endLine' => 0,
        ];
    }

    protected function scan($input): Generator
    {
        static $regex;

        if (!isset($regex)) {
            $regex = sprintf(
                '/(?P<catch>(?:%s))|(?P<noncatch>%s)/',
                implode(')|(?:', $this->getCatchablePatterns()),
                implode('|', $this->getNonCatchablePatterns())
            );
        }

        $flags = PREG_SET_ORDER | PREG_OFFSET_CAPTURE;
        preg_match_all($regex, $input, $matches, $flags);
        $lines = 1;
        $linePos = 0;
        $offset = 0;

        foreach ($matches as $match) {
            if ($match[0][1] !== $offset) {
                var_dump($regex);
                throw new \RuntimeException("Untokenizable character at offset $offset: '" . substr($input, $offset, 10) . "'");
            }
            // Must remain before 'value' assignment since it can change content
            $newLines = preg_match_all('(\r\n?|\n)', $match[0][0], $matchedNewLines, $flags);
            $matchLength = strlen($match[0][0]);

            if ($match['catch'][1] !== -1) {
                $catch = $match['catch'][0];
                $type = $this->getType($catch);
                yield [
                    'value' => $catch,
                    'id'  => $type,
                    'filePos' => $offset,
                    'linePos' => $linePos,
                    'startLine' => $lines,
                    'endLine' => $lines + $newLines,
                ];
            }
            if ($newLines > 0) {
                $last = end($matchedNewLines);
                $r = strrpos($last[0][0], "\r");
                $n = strrpos($last[0][0], "\n");
                $end = $n;
                if ($r !== false && $n !== false) {
                    $end = max($r, $n);
                } elseif ($r !== false) {
                    $end = $r;
                }
                $linePos = $matchLength - $end - 1;
            } else {
                $linePos += $matchLength;
            }
            $offset = $match[0][1] + $matchLength;
            $lines += $newLines;
        }
    }
  
    /**
     * Lexical catchable patterns.
     *
     * @return array
     */
    protected function getCatchablePatterns()
    {
        $baseTokens = array_map(function ($string) {
            $str = preg_quote($string, '/');
            if (ctype_alpha($str)) {
                // enforce word boundary on either side to prevent partial identifier matches
                $str = '(?<!\w)' . $str . '(?!\w)';
            }
            return $str;
        }, array_keys(self::TOKEN_MAP));
        return array_merge($baseTokens, [
            '[a-zA-Z_][a-zA-Z0-9_]*', // identifier
            '[0-9]+(?:\.[0-9]+)?', // number
        ]);
    }

    /**
     * Lexical non-catchable patterns.
     *
     * @return array
     */
    protected function getNonCatchablePatterns()
    {
        return [
            '\s+',
            '[\r\n]+',
        ];
    }

    /**
     * Retrieve token type. Also processes the token value if necessary.
     *
     * @param string $value
     *
     * @return integer
     */
    protected function getType(string &$value)
    {
        if (isset(self::TOKEN_MAP[$value])) {
            return self::TOKEN_MAP[$value];
        }
        if (ctype_digit($value[0])) {
            return strpos($value, '.') !== false ? Tokens::T_DNUMBER : Tokens::T_LNUMBER;
        }
        return Tokens::T_STRING;
    }
}

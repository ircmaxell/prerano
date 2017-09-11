<?php

$meta #
#semval($) $this->semValue
#semval($,%t) $this->semValue
#semval(%n) $this->stackPos-(%l-%n)
#semval(%n,%t) $this->stackPos-(%l-%n)

namespace Prerano\Parser;
#include;

/** GENERATED FILE based on grammar/language.y **/
final class Tokens
{
#tokenval
    const %s = %n;
#endtokenval
}
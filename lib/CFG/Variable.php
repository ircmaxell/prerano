<?php

namespace Prerano\CFG;

use Prerano\Type;

interface Variable
{
    public function getId(): int;
    public function getType(): Type;
}

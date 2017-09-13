<?php

namespace Prerano\Language;

interface Variable
{
    public function getId(): int;

    public function getInferredType(): Type;

    public function getDeclaredType(): Type;

    public function setInferredType(Type $type = null);
}

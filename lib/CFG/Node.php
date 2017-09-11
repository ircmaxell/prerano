<?php

namespace Prerano\CFG;

use Prerano\Type;

interface Node
{
    public function getSubNodeNames(): array;

    /**
     * Gets the type of the node.
     *
     * @return string Type of the node
     */
    public function getName(): string;

    /**
     * Gets line the node started in.
     *
     * @return int Line
     */
    public function getLine(): int;

    /**
     * Sets an attribute on a node.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function setAttribute($key, $value);

    /**
     * Returns whether an attribute exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasAttribute($key);

    /**
     * Returns the value of an attribute.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function &getAttribute($key, $default = null);

    /**
     * Returns all attributes for the given node.
     *
     * @return array
     */
    public function getAttributes();
}

<?php

/**
 * @param string $className
 * @return string[]
 */
function get_class_constants($className) {
    $class = new ReflectionClass($className);
    return $class->getConstants();
}
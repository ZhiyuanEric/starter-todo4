<?php

/**
 * Task entity class, with setter methods for each property.
 */
class Entity extends CI_Model {

    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));

        if (method_exists($this, $method))
        {
            $this->$method($value);

            return $this;
        }

        // Otherwise, just set the property value directly.
        $this->$key = $value;

        return $this;
    }

    public function __get($key) {
        return $this->$key;
    }
}

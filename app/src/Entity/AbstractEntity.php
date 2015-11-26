<?php
    namespace Showcase\Entity;
    
    use ObjectivePHP\Primitives\String\Str;

    class AbstractEntity implements \ArrayAccess
    {
        /**
         * Whether a offset exists
         *
         * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
         *
         * @param mixed $offset <p>
         *                      An offset to check for.
         *                      </p>
         *
         * @return boolean true on success or false on failure.
         * </p>
         * <p>
         * The return value will be casted to boolean if non-boolean was returned.
         * @since 5.0.0
         */
        public function offsetExists($offset)
        {
            $property = lcfirst(Str::cast($offset)->split('_')->each(function (&$part)
            {
                $part = ucfirst($part);
            })->join(''));

            return isset($this->$property);
        }

        /**
         * Offset to retrieve
         *
         * @link  http://php.net/manual/en/arrayaccess.offsetget.php
         *
         * @param mixed $offset <p>
         *                      The offset to retrieve.
         *                      </p>
         *
         * @return mixed Can return all value types.
         * @since 5.0.0
         */
        public function offsetGet($offset)
        {
            $getter = 'get' . Str::cast($offset)->split('_')->each(function(&$part) { $part = ucfirst($part);})->join('');
            if(method_exists($this, $getter))
            {
                return $this->$getter();
            }

            return $this->$offset;
        }

        /**
         * Offset to set
         *
         * @link  http://php.net/manual/en/arrayaccess.offsetset.php
         *
         * @param mixed $offset <p>
         *                      The offset to assign the value to.
         *                      </p>
         * @param mixed $value  <p>
         *                      The value to set.
         *                      </p>
         *
         * @return void
         * @since 5.0.0
         */
        public function offsetSet($offset, $value)
        {
            $setter = 'set' . Str::cast($offset)->split('_')->each(function (&$part)
                {
                    $part = ucfirst($part);
                })->join('')
            ;

            if(!method_exists($this, $setter))
            {
                $setter = null;
            }

            throw new \Exception('It is forbidden to set values using array access.' . ($setter) ? ' Please use ' . get_class($this) . '::' . $setter . '() instead.' : ' Moreover, no setter was found on current class for ' . $offset . '.');
        }

        /**
         * Offset to unset
         *
         * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
         *
         * @param mixed $offset <p>
         *                      The offset to unset.
         *                      </p>
         *
         * @return void
         * @since 5.0.0
         */
        public function offsetUnset($offset)
        {
            $setter = 'set' . Str::cast($offset)->split('_')->each(function (&$part)
                {
                    $part = ucfirst($part);
                })->join('')
            ;

            if (!method_exists($this, $setter))
            {
                $setter = null;
            }

            throw new \Exception('It is forbidden to unset values using array access.' . ($setter) ? ' Please use ' . get_class($this) . '::' . $setter . '() instead.' : ' Moreover, no setter was found on current class for ' . $offset . '.');
        }

    }
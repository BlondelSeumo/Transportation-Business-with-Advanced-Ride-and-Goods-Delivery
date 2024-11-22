<?php

namespace App\Base\Services\Hash;

class HashGenerator implements HashGeneratorContract
{
    const SEPARATOR = '-';

    /**
     * The hash length.
     *
     * @var int
     */
    protected $length = 40;

    /**
     * The hash prefix.
     *
     * @var string|null
     */
    protected $prefix = null;

    /**
     * The hash suffix.
     *
     * @var string|null
     */
    protected $suffix = null;

    /**
     * The hash extension.
     *
     * @var string|null
     */
    protected $extension = null;

    /**
     * Generate the hash.
     *
     * @param int|null $length
     * @param string|null $prefix
     * @param string|null $suffix
     * @param string|null $extension
     * @return string
     */
    public function make($length = null, $prefix = null, $suffix = null, $extension = null)
    {
        $this->length($length)
            ->prefix($prefix)
            ->suffix($suffix)
            ->extension($extension);

        $hash = str_random($this->length);

        if (!is_null($this->prefix)) {
            $hash = $this->prefix . self::SEPARATOR . $hash;
        }

        if (!is_null($this->suffix)) {
            $hash .= self::SEPARATOR . $this->suffix;
        }

        if (!is_null($this->extension)) {
            $hash .= '.' . $this->extension;
        }

        return $hash;
    }

    /**
     * Set the hash length.
     *
     * @param int $length
     * @return $this
     */
    public function length($length)
    {
        if (is_numeric($length)) {
            $this->length = max($length, 1);
        }

        return $this;
    }

    /**
     * Set the hash prefix.
     *
     * @param string $prefix
     * @return $this
     */
    public function prefix($prefix)
    {
        if (is_string($prefix) || is_numeric($prefix)) {
            $this->prefix = $prefix;
        }

        return $this;
    }

    /**
     * Set the hash suffix.
     *
     * @param string $suffix
     * @return $this
     */
    public function suffix($suffix)
    {
        if (is_string($suffix) || is_numeric($suffix)) {
            $this->suffix = $suffix;
        }

        return $this;
    }

    /**
     * Set the hash extension.
     *
     * @param string $extension
     * @return $this
     */
    public function extension($extension)
    {
        if (is_string($extension)) {
            $this->extension = $extension;
        }

        return $this;
    }
}

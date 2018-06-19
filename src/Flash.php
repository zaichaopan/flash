<?php

namespace Zaichaopan\Flash;

use Illuminate\Session\Store;

class Flash implements \JsonSerializable
{
    const FLASH = 'flash';

    const VALID_TYPES = ['info', 'success', 'warning', 'danger', 'error'];

    protected $session;

    protected $type;

    protected $message;

    protected $options;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function type(): ?string
    {
        return $this->getKey('type');
    }

    public function message(): ?string
    {
        return $this->getKey('message');
    }

    public function options(): ?array
    {
        return $this->getKey('options');
    }

    public function ready(): bool
    {
        return !empty($this->get());
    }

    public function jsonSerialize()
    {
        return $this->get();
    }

    public function __call($name, $arguments)
    {
        if (in_array($name, static::VALID_TYPES)) {
            return $this->setFlash($name, ...$arguments);
        }

        throw new \BadMethodCallException(
            "Method [$name] does not exist on Flash."
        );
    }

    protected function setFlash(string $type, $message, array $options = []): void
    {
        $this->type = $type;
        $this->message = $message;
        $this->options = $options;
        $this->session->flash(static::FLASH, $this->toArray());
    }

    protected function get(): ?array
    {
        return $this->session->get(static::FLASH);
    }

    protected function toArray(): array
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
            'options' => $this->options,
        ];
    }

    /**
     *
     * @return null|string|array
     */
    protected function getKey(string $key)
    {
        $data = $this->get();

        return $data ? $data[$key] : null;
    }
}

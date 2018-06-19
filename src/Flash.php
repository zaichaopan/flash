<?php

namespace Zaichaopan\Flash;

use Illuminate\Session\Store;

class Flash
{
    const FLASH = 'flash';

    protected $session;

    protected $type = 'info';

    protected $message;

    protected $options = [];

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function info(string $message, array $options = []): void
    {
        $this->setFlash('info', $message, $options);
    }

    public function success(string $message, array $options = []): void
    {
        $this->setFlash('success', $message, $options);
    }

    public function warning(string $message, array $options = []): void
    {
        $this->setFlash('warning', $message, $options);
    }

    public function error(string $message, array $options = []): void
    {
        $this->setFlash('error', $message, $options);
    }

    public function danger(string $message, array $options = []): void
    {
        $this->setFlash('danger', $message, $options);
    }

    public function get(): ?array
    {
        return $this->session->get(static::FLASH);
    }

    public function message(): ?string
    {
        return $this->getKey('message');
    }

    public function type(): ?string
    {
        return $this->getKey('type');
    }

    public function options(): ?array
    {
        return $this->getKey('options');
    }

    public function ready(): bool
    {
        return !empty($this->get());
    }

    protected function setFlash(string $type, $message, array $options = []): void
    {
        $this->type = $type;
        $this->message = $message;
        $this->options = $options;
        $this->session->flash(static::FLASH, $this->toArray());
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

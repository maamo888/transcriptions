<?php

declare(strict_types=1);

namespace Maamo888\Transcriptions;

class Transcription
{
    public function __construct(protected array $lines)
    {
        $this->lines = array_slice(array_filter(array_map('trim', $lines)), 1);
    }

    public static function load(string $path): self
    {
        return new static(file($path));
    }

    public function lines(): Lines
    {
        return new Lines(array_map(
            fn ($line) => new Line((int) $line[0], $line[1], $line[2]),
            array_chunk($this->lines, 3)
        ));
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}

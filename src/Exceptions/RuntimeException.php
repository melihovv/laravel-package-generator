<?php

namespace Melihovv\LaravelPackageGenerator\Exceptions;

class RuntimeException extends \RuntimeException
{
    /**
     * @param string $command
     * @param int $exitStatusCode
     * @param int $code
     * @param \Exception|\Throwable|null $previous
     * @return static
     */
    public static function commandExecutionFailed(
        $command,
        $exitStatusCode,
        $code = 0,
        $previous = null
    ) {
        $message = sprintf(
            "\"$command\" exited with %s status code",
            $exitStatusCode
        );

        return new static($message, $code, $previous);
    }

    /**
     * @param string $path
     * @param int $code
     * @param \Exception|\Throwable|null $previous
     * @return static
     */
    public static function noAccessTo(
        $path,
        $code = 0,
        $previous = null
    ) {
        return new static("No access to [$path]", $code, $previous);
    }
}

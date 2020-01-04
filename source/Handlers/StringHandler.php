<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Handler;

class StringHandler implements Handler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return $converter->convert($subject);
    }
}

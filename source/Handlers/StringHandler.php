<?php

namespace CaseConverter\Handlers;

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

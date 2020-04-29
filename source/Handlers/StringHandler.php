<?php

namespace CaseConverter\Handlers;

use CaseConverter\Interfaces\Converter;

class StringHandler extends BaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, Converter $converter): string
    {
        return $converter->convert($subject);
    }
}

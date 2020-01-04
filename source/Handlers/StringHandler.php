<?php

namespace CaseConverter\Handlers;

class StringHandler extends BaseHandler
{
    /**
     * @inheritDoc
     */
    public function handle($subject, $converter)
    {
        return $converter->convert($subject);
    }
}

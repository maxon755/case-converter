<?php

namespace CaseConverter\Interfaces;

interface Handler
{
    /**
     * Handles particular type of subject.
     *
     * @param mixed $subject
     * @param Converter $converter
     *
     * @return mixed
     */
    public function handle($subject, $converter);
}

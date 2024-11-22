<?php

namespace App\Base\SMSTemplate;

use Exception;

class SMSTemplate
{
    /** Default SMS template language file name, also used as key prefix */
    const DEFAULT_TEMPLATE_FILE = 'sms';

    /** @var \Illuminate\Translation\Translator */
    protected $translator;

    /** @var string */
    protected $template;

    /** @var string */
    protected $message = '';

    /**
     * SMSTemplate constructor.
     *
     * @param string $name
     * @param array $replace
     * @param string|null $locale
     */
    public function __construct($name, array $replace = [], $locale = null)
    {
        $this->initializeTranslator();

        $this->validateTemplate($name, $locale);

        $this->generateTemplateMessage($replace, $locale);
    }

    /**
     * Get the message generated using the SMS template.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Initialize the translator.
     *
     * @throws Exception
     */
    protected function initializeTranslator()
    {
        $this->translator = app('translator');

        if (!$this->translator->hasForLocale(self::DEFAULT_TEMPLATE_FILE)) {
            throw new Exception('Missing SMS template language file.');
        }
    }

    /**
     * Validate the SMS template key and set the full key name.
     *
     * @param string $name
     * @param string|null $locale
     * @throws Exception
     */
    protected function validateTemplate($name, $locale = null)
    {
        if (!is_string($name)) {
            throw new Exception('Invalid SMS template name provided.');
        }

        $this->template = self::DEFAULT_TEMPLATE_FILE . '.' . $name;

        if (!$this->translator->has($this->template, $locale)) {
            throw new Exception('Provided SMS template does not exist.');
        }
    }

    /**
     * Generate and set the message using the SMS template and replacer provided.
     *
     * @param array $replace
     * @param string|null $locale
     */
    protected function generateTemplateMessage(array $replace = [], $locale = null)
    {
        $this->message = $this->translator->get($this->template, $replace, $locale);
    }

    /**
     * Get the message when casting to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}

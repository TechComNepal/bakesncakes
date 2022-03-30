<?php

namespace App\Traits;

/**
 * Trait FlashMessage
 * @package App\Traits
 */
trait FlashMessage
{
    protected $errorMessages = [];
    protected $successMessages = [];
    protected $infoMessages = [];
    protected $warningMessages = [];

    /**
     * In the setter function, we are running the switch statement on $type and setting the right property based on type.
     * we are checking if the $message is in array format if yes, then we are pushing all values from the array to our array property.
     * If it is a single message then simply pushing the message to our property.
     * @param $message
     * @param $type
     */
    public function setFlashMessage($message, $type)
    {
        $model = 'infoMessages';

        switch ($type) {
            case 'info':
                {
                    $model = 'infoMessages';
                }
                break;
            case 'error':
                {
                    $model = 'errorMessages';
                }
                break;
            case 'success':
                {
                    $model = 'successMessages';
                }
                break;
            case 'warning':
                {
                    $model = 'warningMessages';
                }
                break;
        }

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($this->$model, $value);
            }
        } else {
            array_push($this->$model, $message);
        }
    }

    /**
     * Return an array of all flash messages properties..
     * @return array
     */
    public function getFlashMessage()
    {
        return [
            'error' => $this->errorMessages,
            'info' => $this->infoMessages,
            'success' => $this->successMessages,
            'warning' => $this->warningMessages,
        ];
    }

    /**
     * Flushing flash messages to Laravel session
     */
    public function showFlashMessages()
    {
        session()->flash('error', $this->errorMessages);
        session()->flash('info', $this->infoMessages);
        session()->flash('success', $this->successMessages);
        session()->flash('warning', $this->warningMessages);
    }
}

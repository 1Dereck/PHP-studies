<?php

namespace Src\Helper;

trait FlashMessageTrait
{
    private function addErrorMessage(string $erroMessage): void
    {
        $_SESSION['erro_message'] = $erroMessage;
    }
}

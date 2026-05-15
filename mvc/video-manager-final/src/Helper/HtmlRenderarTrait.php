<?php 

namespace Src\Helper;

trait HtmlRenderarTrait
{
    private function renderTemplate(string $templateName, array $context = []): string
    {
        $templatePath = __DIR__ . "/../../views/";
        extract($context);

        ob_start();
        require $templatePath . $templateName . ".php";
        return ob_get_clean();
    }    
}

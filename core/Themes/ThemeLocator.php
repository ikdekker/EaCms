<?php

namespace EaCms\Themes;

use EaCms\Pageloading\PageLoader;
use Webmozart\Json\JsonDecoder;
use Webmozart\Json\JsonValidator;
use Webmozart\Json\UriRetriever\LocalUriRetriever;
use JsonSchema\Uri\UriRetriever;

class ThemeLocator {
    
    static public function go() {
        $themePath = "themes/";
        
        
        $themeDirs = array_diff(scandir(ROOTPATH . $themePath), [
            '..',
            '.',
        ]);

        if (empty($themeDirs)) {
            return [];
        }

        $loader = new PageLoader(null, $themePath);
        $decoder = new JsonDecoder();

$uriRetriever = new UriRetriever();
$uriRetriever->setUriRetriever(new LocalUriRetriever(
    ROOTPATH . 'res/schemas',
    array(
        'http://json-schema.org/draft-04/schema' => 'schema-4.0.json',
    )
));

        $validator = new JsonValidator(null, $uriRetriever);

        foreach ($themeDirs as $theme) {
            $themeSettings = $loader->load($theme . "/$theme.json");

            $data = $decoder->decode($themeSettings);
            $err = $validator->validate($data, __DIR__ . "/Schemas/themeschema");
            if (empty($err)) {
                $found[$theme] = ROOTPATH . "themes/" . $theme;
            }
        }
        
        return $found;
    }    
    
    
    
}

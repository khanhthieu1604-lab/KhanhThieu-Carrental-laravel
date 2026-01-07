<?php

$root = __DIR__;


$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {

    
    if ($file->getExtension() !== 'php') {
        continue;
    }

    
    if (str_contains($file->getPathname(), DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR)) {
        continue;
    }

    $code = file_get_contents($file->getPathname());
    $tokens = token_get_all($code);

    $output = '';

    foreach ($tokens as $token) {
        if (is_array($token)) {
            
            if ($token[0] === T_COMMENT || $token[0] === T_DOC_COMMENT) {
                continue;
            }
            $output .= $token[1];
        } else {
            $output .= $token;
        }
    }

    file_put_contents($file->getPathname(), $output);
}

echo "DONE: All PHP comments removed.\n";

<?php

$viewsPath = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($viewsPath, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {

    if (!str_ends_with($file->getFilename(), '.blade.php')) {
        continue;
    }

    $content = file_get_contents($file->getPathname());

    // 1. Blade comment {{-- --}}
    $content = preg_replace('/\{\{\-\-([\s\S]*?)\-\-\}\}/', '', $content);

    // 2. HTML comment <!-- -->
    $content = preg_replace('/<!--([\s\S]*?)-->/', '', $content);

    /**
     * 3. CSS comment /* *\/ trong <style>
     */
    $content = preg_replace_callback(
        '/<style\b[^>]*>([\s\S]*?)<\/style>/i',
        function ($m) {
            $css = preg_replace('/\/\*[\s\S]*?\*\//', '', $m[1]);
            return str_replace($m[1], $css, $m[0]);
        },
        $content
    );

    /**
     * 4. JS comment trong <script>
     * - Xóa // và /* *\/
     * - Tránh phá URL http:// https://
     */
    $content = preg_replace_callback(
        '/<script\b[^>]*>([\s\S]*?)<\/script>/i',
        function ($m) {
            $js = $m[1];

            // Xóa /* */ trước
            $js = preg_replace('/\/\*[\s\S]*?\*\//', '', $js);

            // Xóa // nhưng tránh http(s)://
            $js = preg_replace('/(^|[^:])\/\/.*$/m', '$1', $js);

            return str_replace($m[1], $js, $m[0]);
        },
        $content
    );

    file_put_contents($file->getPathname(), $content);
}

echo "DONE: Blade, HTML, CSS, and JS comments removed.\n";

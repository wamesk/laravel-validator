<?php declare(strict_types = 1);

namespace Wame\Validator\Utils;

class Helpers
{
    /**
     * Create dir recursive
     *
     * @param string $dir
     * @param int $chmod permission
     *
     * @return string
     */
    public static function createDir($dir, $chmod = 0777): string
    {
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $dir);

        if (!file_exists($path)) {
            mkdir($path, $chmod, true);
        }

        return $path;
    }

    /**
     * Copy directory with files
     *
     * @param string $from
     * @param string $to
     * @param bool $empty
     *
     * @return void
     */
    public static function copyDir(string $from, string $to): void
    {
        foreach (scandir($from) as $file) {
            if (in_array($file, ['.', '..'])) continue;

            $pathFrom = $from . DIRECTORY_SEPARATOR . $file;
            $pathTo = $to . DIRECTORY_SEPARATOR . $file;

            if (is_dir($pathFrom)) {
                self::createDir($pathTo);
                self::copyDir($pathFrom, $pathTo);
            } elseif (is_file($pathFrom)) {
                copy($pathFrom, $pathTo);
            }
        }
    }
}
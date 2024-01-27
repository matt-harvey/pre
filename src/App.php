<?php

declare(strict_types=1);

namespace MattHarvey\Pre;

final class App
{
    public static function run(array $argv): int
    {
        if (count($argv) > 1) {
            switch ($argv[1]) {
            case '-h': case '--help':
                echo 'Usage: pre <args...>' . PHP_EOL;
                echo 'Runs the contents of the first line of the file .pre in the current directory, ' .
                    'prefixed as a shell command to whatever remaining arguments are passed.' . PHP_EOL;
                return 0;
            }
        }

        $rest = [];

        for ($i = 1; $i < count($argv); $i++) {
            $rest[] = $argv[$i];
        }

        $rest = array_map(escapeshellcmd(...), $rest);
        if (file_exists('.pre') && is_file('.pre')) {
            $file = new \SplFileObject('.pre');
            $pre = $file->fgets();
            if ($pre) {
                $rest = [trim($pre), ...$rest];
            }
        }
        if (empty($rest)) {
            return 0;
        }
        $command = implode(' ', $rest);
        passthru($command, $result);
        return $result;
    }
}

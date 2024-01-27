#!/usr/bin/env php
<?php

declare(strict_types=1);

final class App
{
    public static function run(array $argv): int
    {
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

exit(App::run($argv));

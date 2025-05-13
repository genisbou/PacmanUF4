<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

use CodeIgniter\I18n\Time;


class Zip extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Developer';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'zip';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Clears logs, cache and session files before ZIP project contents';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'zip';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        if (is_dir(WRITEPATH . 'session')) {
            $files = new \CodeIgniter\Files\FileCollection();

            // clear session
            // @see https://codeigniter.com/user_guide/libraries/files.html

            $files->addDirectory(WRITEPATH . 'session');
            //$files->removePattern('#\index.html#');
            
            foreach ($files as $file) {
                if ($file->getBasename()!='index.html')
                    unlink($file->getRealPath());
            }
        }

        // clear log
        echo command('logs:clear --force'); // clear without prompt

        // clear cache
        echo command('cache:clear');

        //debugbar clear
        echo command('debugbar:clear');

        $defaultBackup = env('BAK','..\\');
        // $defaultBackup = env('BAK', '..\DemosCodeigniter');

        $relativePath = CLI::prompt('Store project to?', $defaultBackup);

        $this->zip($relativePath);
    }

    private function zip($relativePath)
    {
        // Get real path for our folder
        $rootPath = realpath(ROOTPATH);

        // $time = Time::today('Europa/Madrid', 'es_ES');
        $time = new Time('now');

        // Initialize archive object
        $zip = new \ZipArchive();

        $month = $time->getMonth() < 10 ? '0' . $time->getMonth() : $time->getMonth();
        $day = $time->getDay() < 10 ? '0' . $time->getDay() : $time->getDay();

        $zipname = realpath(ROOTPATH . "/" . $relativePath) . "/" . $time->getYear() . $month . $day . "-" . time() . '-' . basename(ROOTPATH) . ".zip";

        $zip->open($zipname, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        // @var SplFileInfo[] $files 
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        $currStep = 0;

        $totalFiles = $this->getNFiles($files);

        foreach ($files as $name => $file) {
            CLI::showProgress($currStep++, $totalFiles);

            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }
        // Zip archive will be created only after closing object
        $zip->close();

        CLI::showProgress(false);

        CLI::newLine();
        CLI::write('Project zip to: ' . CLI::color($zipname, 'green'));
        CLI::newLine();
    }


    private function getNFiles($itera)
    {
        $i = 0;
        foreach ($itera as $name => $file) {
            $i++;
        }
        return $i;
    }
}

<?php

namespace Litovchenko\MigrationAssistant\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Facades\Schema;

abstract class AbstractMakeCommand extends Command
{
    protected $signature = 'make:massist:table:create';
    protected $stubPath = 'migration.table.create.stub';
    protected $fileNamePrefix = 'table_create_';
    protected $fileNamePostfix = '.php';
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    abstract public function handle();

    abstract public function getStubVariables();

    public function getStubPath()
    {
        return __DIR__ . '/../../resources/stubs/' . $this->stubPath;
    }


    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);
        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        return $contents;
    }

    public function getSourceFilePath($fileName = '')
    {
        // return base_path('App\\Interfaces') . '\\' . $this->getSingularClassName($this->argument('name')) . 'Interface.php';
        $dt = Carbon::now()->format('Y_m_d_His');
        return database_path('migrations/' . $dt . '_' . $this->fileNamePrefix . $fileName . $this->fileNamePostfix);
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }

    protected function makeFile($fileName = '')
    {
        $path = $this->getSourceFilePath($fileName);
        $contents = $this->getSourceFile($path);
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File: {$path} created");
        } else {
            $this->info("File: {$path} already exits");
        }
    }

    protected function getAllTables()
    {
        $tablesArray = [];
        $i = 1;

        $allTables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($allTables as $tableName) {
            if (Schema::hasTable($tableName)) {
                $tablesArray[$i] = $tableName;
                $i++;
            }
        }

        return $tablesArray;
    }

    protected function getAllFieldsByTable($tableName)
    {
        $columnsArray = [];
        $i = 1;

        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($tableName);
        foreach ($columns as $column) {
            $columnsArray[$i] = $column->getName();
            $i++;
        }

        return $columnsArray;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DumpDatabaseToCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * - path: optional output directory under storage/app
     * - table: optional table name to export only that table
     */
    protected $signature = 'db:dump-csv {--path=db-dumps} {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump all SQLite tables (or a single table) into CSV files stored in storage/app/{path}';

    public function handle()
    {
        $path = $this->option('path') ?: 'db-dumps';
        $table = $this->option('table');

        // Ensure storage path exists
        Storage::makeDirectory($path);

        $connection = DB::connection();
        $driver = $connection->getDriverName();

        if ($driver !== 'sqlite') {
            $this->error("This command currently supports only sqlite connections. Current driver: {$driver}");
            return 1;
        }

        // Get tables from sqlite_master, excluding internal sqlite_ tables
        $tables = [];
        if ($table) {
            $tables = [$table];
        } else {
            $rows = $connection->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%';");
            foreach ($rows as $r) {
                $tables[] = is_object($r) ? $r->name : $r['name'];
            }
        }

        if (empty($tables)) {
            $this->info('No tables found to export.');
            return 0;
        }

        $this->info('Exporting tables: ' . implode(', ', $tables));

        foreach ($tables as $t) {
            try {
                $rows = $connection->table($t)->get();
            } catch (\Exception $e) {
                $this->error("Failed to read table {$t}: " . $e->getMessage());
                continue;
            }

            $filePath = $path . '/' . $t . '.csv';
            $fullPath = Storage::path($filePath);

            // Open file and write CSV
            $fp = fopen($fullPath, 'w');
            if ($fp === false) {
                $this->error("Unable to open file for writing: {$fullPath}");
                continue;
            }

            if ($rows->isEmpty()) {
                // write only header by getting columns from schema pragma
                $columns = $this->getSqliteTableColumns($connection, $t);
                if (!empty($columns)) {
                    fputcsv($fp, $columns);
                }
            } else {
                // write header
                $first = (array) $rows->first();
                fputcsv($fp, array_keys($first));

                foreach ($rows as $r) {
                    $row = (array) $r;
                    // Normalize values: convert objects/arrays to json
                    $row = array_map(function ($v) {
                        if (is_array($v) || is_object($v)) return json_encode($v);
                        return $v;
                    }, $row);
                    fputcsv($fp, $row);
                }
            }

            fclose($fp);
            $this->info("Wrote {$filePath}");
        }

        $this->info('Done.');
        return 0;
    }

    /**
     * Get column names for an sqlite table
     */
    protected function getSqliteTableColumns($connection, $table)
    {
        try {
            $cols = $connection->select("PRAGMA table_info('{$table}')");
            $names = [];
            foreach ($cols as $c) {
                $names[] = is_object($c) ? $c->name : $c['name'];
            }
            return $names;
        } catch (\Exception $e) {
            return [];
        }
    }
}

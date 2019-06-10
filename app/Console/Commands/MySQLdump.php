<?php

namespace CEM\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class MySQLdump extends Command
{
  //The name and signature of the console command.
  protected $signature = 'mysql:dump';
  protected $description = 'Create a MySQLdump';

  public function __construct() {
    parent::__construct();
  }

  public function handle() {
    $cmd =
    "mysqldump -h " . env('DB_HOST') .
    " -u "          . env('DB_USERNAME') .
    " -p\""         . env('DB_PASSWORD') . "\"" .
    " --databases " . env('DB_DATABASE') . " --compress ";
    $output = [];
    $name = "Backup.".date("d-m-y").".sql";

    exec($cmd, $output);

    $tmpfname = tempnam(sys_get_temp_dir(), $name);
    $handle = fopen($tmpfname, "w");
    fwrite($handle, implode($output, "\n"));
    Storage::putFileAs("backups", new File($tmpfname), $name);
    fclose($handle);
  }
}

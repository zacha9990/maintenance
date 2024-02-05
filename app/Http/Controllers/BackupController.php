<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }
     
    public function createBackup()
    {
        Artisan::call('backup:run', ['--only-db' => true]);

        // Get the path to the last backup file
        $backupFile = Storage::disk('local')->files('backups')[0];

        // Download the backup file
        return response()->download(storage_path("app/$backupFile"));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }
     
    public function createBackup()
    {
        $backupDestination = BackupDestination::create('local');

        $backupJob = BackupJobFactory::createFromArray(config('backup.backup'));

        $backupJob->run($backupDestination);

        $backupPath = $backupDestination->getFilesystemFile($backupJob->backupDestination());

        return response()->download($backupPath);
    }
}

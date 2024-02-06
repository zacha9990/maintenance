<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use File;
use Spatie\Backup\Tasks\Backup\BackupJob;

class BackupController extends Controller
{
    public function index()
    {
        // Get the list of files in storage/app/Laravel
        $files = Storage::files('Laravel');

        // Get file details
        $fileDetails = [];
        foreach ($files as $file) {
            $fileDetails[] = [
                'name' => pathinfo($file, PATHINFO_FILENAME),
                'created_at' => File::lastModified(storage_path("app/$file")),
                'download_link' => asset("storage/app/$file"),
            ];
        }

        // Sort by created_at
        usort($fileDetails, function ($a, $b) {
            return $a['created_at'] <=> $b['created_at'];
        });

        return view('backup.index', compact('fileDetails'));
    }
     
    public function createBackup()
    {
         // Create a new BackupJob
        $backupJob = new BackupJob();

        // Execute the backup
        $backupJob->run();

        // Optionally, you can redirect to a success page or display a success message
        return redirect()->back()->with('success', 'Database backup completed successfully!');
    }
}

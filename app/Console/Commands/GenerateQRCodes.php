<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Tool;

class GenerateQRCodes extends Command
{

    protected $signature = 'qrcode:generate';
    protected $description = 'Generate QR codes for tools with null QR code';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tools = Tool::whereNull('qrcode')->get();

        foreach ($tools as $tool) {
            $qrCodeUrl = env('APP_URL') . "qrcode/{$tool->id}";
            $qrCodePath = "qrcodes/{$tool->id}.png";

            $directory = storage_path('app/public/qrcodes');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            QrCode::format('png')->size(400)->generate($qrCodeUrl, storage_path("app/public/$qrCodePath"));

            $tool->qrcode = $qrCodePath;
            $tool->save();
        }

        $this->info('QR codes generated successfully.');
    }
}

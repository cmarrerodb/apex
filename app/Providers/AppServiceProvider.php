<?php

namespace App\Providers;

use Faker\Factory as FakerFactory;
use Illuminate\Filesystem\Filesystem;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
          return FakerFactory::create('es_CL');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        // Filesystem::macro('temporaryUrl', function ($disk, $filePath, $time = '+1 minutes') {
        //     $client = Storage::disk($disk)->getClient();
        //     $command = $client->getCommand('GetObject', [
        //         'Bucket' => config('filesystems.disks.'.$disk.'.bucket'),
        //         'Key' => $filePath,
        //     ]);

        //     $signedRequest = $client->createPresignedRequest($command, $time);
        //     return (string) $signedRequest->getUri();
        // });

        /* Macro para generar el nombre aleatoreo de un archivo en spaces */
        Filesystem::macro('hashName', function ($name = '') {
            if (!$name || $name == '') $name = random_bytes(64);
            return (string) sha1(md5($name));
        });

        /* Macro para calcular el tamaño del archivo en la unidad especifica */
        Filesystem::macro('sizeUnit', function ($bytes, $decimal_places = 2) {

            $K = number_format($bytes / 1024, $decimal_places);
            $M = number_format($bytes / 1048576, $decimal_places);
            $G = number_format($bytes / 1073741824, $decimal_places);

            if ($G >= 1) return $G.'Gb';
            if ($M >= 1) return $M.'Mb';
            return $K.'Kb';
        });

        /* Zona horaria por defecto*/
        date_default_timezone_set('America/Santiago');

    }
}

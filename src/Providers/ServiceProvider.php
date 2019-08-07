<?php

namespace Hpolthof\Auditable\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider As BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom($this->configFile('auditable.php'), 'auditable');

        $this->addBlueprintMacros();
    }

    public function boot()
    {
        $this->publishes([
            $this->configFile('auditable.php') => config_path('auditable.php')
        ]);
    }

    protected function configFile($filename)
    {
        return __DIR__ . '/../../config/'.$filename;
    }

    protected function addBlueprintMacros()
    {
        Blueprint::macro('auditable', function () {
            $fieldType = config('auditable.identifier_type', 'unsignedBigInteger');

            $this->{$fieldType}('created_by')->nullable()->index();
            $this->{$fieldType}('updated_by')->nullable()->index();
        });

        Blueprint::macro('dropAuditable', function () {
            $this->dropColumn(['created_by', 'updated_by']);
        });
    }
}
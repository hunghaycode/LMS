<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\ServiceProvider;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Schema::hasTable('smtp_settings')) {
            $smtpSetting = SmtpSetting::first();
 
            if ($smtpSetting) {
            $data = [
             'driver' => $smtpSetting->mailer, 
             'host' => $smtpSetting->host,
             'port' => $smtpSetting->port,
             'username' => $smtpSetting->username,
             'password' => $smtpSetting->password,
             'encryption' => $smtpSetting->encryption,
             'from' => [
                 'address' => $smtpSetting->from_address,
                 'name' => 'HungMr'
             ]
 
             ];
             Config::set('mail',$data);
            }
        } // end if
    }
}

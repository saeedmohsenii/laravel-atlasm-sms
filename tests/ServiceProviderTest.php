<?php

declare(strict_types=1);

namespace Atlasm\Sms\Tests;

use Atlasm\Sms\AtlasmSmsServiceProvider;
use Atlasm\Sms\Facades\AtlasmSms;
use Atlasm\Sms\SmsService;
use Orchestra\Testbench\TestCase;

class ServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [AtlasmSmsServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return ['AtlasmSms' => AtlasmSms::class];
    }

    public function test_default_config_is_merged(): void
    {
        $this->assertSame(20, config('atlasm-sms.timeout'));
        $this->assertTrue(config('atlasm-sms.verify_ssl'));
        $this->assertFalse(config('atlasm-sms.password_md5'));
    }

    public function test_service_is_registered_as_singleton(): void
    {
        $this->assertInstanceOf(SmsService::class, $this->app->make(SmsService::class));
        $this->assertSame(
            $this->app->make(SmsService::class),
            $this->app->make(SmsService::class)
        );
        $this->assertSame(
            $this->app->make(SmsService::class),
            $this->app->make('atlasm-sms')
        );
    }

    public function test_facade_resolves_to_the_service(): void
    {
        $this->assertInstanceOf(SmsService::class, AtlasmSms::getFacadeRoot());
    }
}

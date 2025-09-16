<?php

namespace App\Support\Jetstream;

class CustomFeatures
{
    public static function enabled(string $feature): bool
    {
        return in_array($feature, config('jetstream.features', []));
    }

    public static function optionEnabled(string $feature, string $option): bool
    {
        return static::enabled($feature) &&
               config("jetstream-options.{$feature}.{$option}") === true;
    }

    public static function managesProfilePhotos(): bool
    {
        return static::enabled(static::profilePhotos());
    }

    public static function hasApiFeatures(): bool
    {
        return static::enabled(static::api());
    }

    public static function hasTeamFeatures(): bool
    {
        return static::enabled(static::teams());
    }

    public static function sendsTeamInvitations(): bool
    {
        return static::optionEnabled(static::teams(), 'invitations');
    }

    public static function hasTermsAndPrivacyPolicyFeature(): bool
    {
        return static::enabled(static::termsAndPrivacyPolicy());
    }

    public static function hasAccountDeletionFeatures(): bool
    {
        return static::enabled(static::accountDeletion());
    }

    public static function profilePhotos(): string
    {
        return 'profile-photos';
    }

    public static function api(): string
    {
        return 'api';
    }

    public static function teams(array $options = []): string
    {
        if (! empty($options)) {
            config(['jetstream-options.teams' => $options]);
        }

        return 'teams';
    }

    public static function termsAndPrivacyPolicy(): string
    {
        return 'terms';
    }

    public static function accountDeletion(): string
    {
        return 'account-deletion';
    }

    public static function twoFactorAuthentication(array $options = []): string
    {
        if (! empty($options)) {
            config(['jetstream-options.two-factor-authentication' => $options]);
        }

        return 'two-factor-authentication';
    }
}
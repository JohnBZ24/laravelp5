<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('role')
                    ->required()
                    ->default('employee')
                    ->disabled(fn () => auth()->user()?->isManager() ?? false)
                    ->visible(fn () => ! auth()->user()?->isManager()),
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->default(fn () => auth()->user()?->isManager() ? auth()->user()->company_id : null)
                    ->disabled(fn () => auth()->user()?->isManager() ?? false)
                    ->required(),
            ]);
    }
}

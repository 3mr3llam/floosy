<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\SiteSocial;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\SiteSocialResource\Pages;

class SiteSocialResource extends Resource
{
    protected static ?string $model = SiteSocial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationLabel(): string
    {
        return __('pages.siteSocail');
    }
    public static function getModelLabel(): string
    {
        return __('pages.siteSocail');
    }
    public static function getNavigationGroup(): string
    {
        return __('pages.Settings');
    }
    public static function getPluralModelLabel(): string
    {
        return __('pages.siteSocail');
    }
    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationBadge(): ?string
    {
        return SiteSocial::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('pages.title'))
                    ->required()
                    ->validationMessages([
                        'required' => __('validation.required'),
                    ])
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->label(__('pages.url'))
                    ->validationMessages([
                        'required' => __('validation.required'),
                    ])
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('pages.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label(__('pages.url'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSocials::route('/'),
        ];
    }
}

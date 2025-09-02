<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SiteSetting;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\SiteSettingResource\Pages;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static bool $shouldRegisterNavigation = true;

    public static function getNavigationLabel(): string
    {
        return __('pages.site_setting');
    }
    public static function getModelLabel(): string
    {
        return __('pages.site_setting');
    }
    public static function getNavigationGroup(): string
    {
        return __('pages.Settings');
    }
    public static function getPluralModelLabel(): string
    {
        return __('pages.site_setting');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.setting'))
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->required()
                            ->label(__('pages.site_name'))
                            ->maxLength(255)
                            ->rule('string')
                            ->rule('min:2'),

                        Forms\Components\TextInput::make('fee_percentage')
                            ->numeric()
                            ->step('0.01')
                            ->suffix('%')
                            ->label('Fee Percentage (%)')
                            ->required()
                            ->minValue(0)
                            ->maxValue(100)
                            ->rules(['numeric', 'between:0,100']),

                        Forms\Components\TextInput::make('invoices_cumulative_value')
                            ->numeric()
                            ->step('0.01')
                            ->prefix('SAR')
                            ->label('Invoices Cumulative Value (SAR)')
                            ->required()
                            ->minValue(0)
                            ->rules(['numeric', 'min:0']),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->label(__('pages.site_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('fee_percentage')
                    ->label('Fee %')
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoices_cumulative_value')
                    ->label('Cumulative Value')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('pages.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('pages.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}

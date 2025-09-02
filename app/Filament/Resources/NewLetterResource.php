<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\NewLetter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\NewLetterResource\Pages;

class NewLetterResource extends Resource
{
    protected static ?string $model = NewLetter::class;
    public static function getNavigationLabel(): string
    {
        return __('pages.newLetter');
    }
    public static function getModelLabel(): string
    {
        return __('pages.newLetter');
    }
    public static function getNavigationGroup(): string
    {
        return __('pages.contact-newletter');
    }
    public static function getPluralModelLabel(): string
    {
        return __('pages.newLetter');
    }

    public static function getNavigationBadge(): ?string
    {
        return NewLetter::count();
    }
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.new_letter'))


                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label(__('pages.email'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ]),
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
                Tables\Columns\TextColumn::make('email')
                    ->label(__('pages.email'))
                    ->searchable(),
            ])->defaultSort('created_at', 'desc')

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
            'index' => Pages\ListNewLetters::route('/'),
        ];
    }
}

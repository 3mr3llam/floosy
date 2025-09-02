<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Contact;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\ContactResource\Pages;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function getNavigationLabel(): string
    {
        return __('pages.contact');
    }
    public static function getModelLabel(): string
    {
        return __('pages.contact');
    }
    public static function getNavigationGroup(): string
    {
        return __('pages.contact-newletter');
    }
    public static function getPluralModelLabel(): string
    {
        return __('pages.contact');
    }


    public static function getNavigationBadge(): ?string
    {
        return Contact::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__("pages.contact"))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('pages.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label(__('pages.email'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->label(__('pages.message'))
                            ->columnSpanFull(),
                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('pages.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('pages.email'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('pages.message'))
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
//            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
//            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SendNewLetter;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\SendNewLetterResource\Pages;

class SendNewLetterResource extends Resource
{
    protected static ?string $model = SendNewLetter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationLabel(): string
    {
        return __('pages.sendNewLetter');
    }
    public static function getModelLabel(): string
    {
        return __('pages.sendNewLetter');
    }
    public static function getNavigationGroup(): string
    {
        return __('pages.contact-newletter');
    }
    public static function getPluralModelLabel(): string
    {
        return __('pages.sendNewLetter');
    }

    public static function getNavigationBadge(): ?string
    {
        return sendNewLetter::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.sendNewLetter'))
                    ->description(__('pages.desc_form_sendNewLetter'))

                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->required()
                            ->validationMessages([
                                'required' => __('validation.required'),
                            ])->maxLength(255)
                            ->label(__('pages.subject')),


                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->validationMessages([
                                'required' => __('validation.required'),
                            ])->label(__('pages.message'))
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('deliay')
                            ->label(__('pages.deliay'))

                            ->required()
                            ->validationMessages([
                                'required' => __('validation.required'),
                            ])
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('pages.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('pages.updated_at'))

                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('pages.deleted_at'))

                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('message')
                    ->label(__('pages.message'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label(__('pages.subject'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('deliay')
                    ->label(__('pages.deliay'))
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
            'index' => Pages\ListSendNewLetters::route('/'),
        ];
    }
}

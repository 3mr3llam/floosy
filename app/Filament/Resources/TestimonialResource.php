<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Testimonial;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use App\Filament\Resources\TestimonialResource\Pages;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    public static function getNavigationLabel(): string
    {
        return __('pages.testimonial');

    }
    public static function getModelLabel(): string
    {
        return __('pages.testimonial');
    }
    public static function getNavigationGroup(): string
    {
        return __('pages.contact-newletter');
    }
    public static function getPluralModelLabel(): string
    {
        return __('pages.testimonial');
    }


    public static function getNavigationBadge(): ?string
    {
        return Testimonial::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.testimonial'))

                    ->schema([
                        Section::make(__('pages.category'))
                            ->description(__('pages.desc_form_category'))

                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->validationMessages([
                                        'required' => __('validation.required'),
                                    ])
                                    ->default(null),
                                Forms\Components\TextInput::make('message')
                                    ->maxLength(255)
                                    ->validationMessages([
                                        'required' => __('validation.required'),
                                    ])
                                    ->default(null),
                            ]),
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
                Tables\Columns\TextColumn::make('name')
                    ->label(__('pages.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('pages.message'))
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
            'index' => Pages\ListTestimonials::route('/'),
        ];
    }
}

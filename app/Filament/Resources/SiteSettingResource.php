<?php

namespace App\Filament\Resources;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SiteSetting;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Resources\Concerns\Translatable;
use App\Filament\Resources\SiteSettingResource\Pages;

class SiteSettingResource extends Resource
{
    use Translatable;

    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static bool $shouldRegisterNavigation = false;

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
                Tabs::make('post_tabs')->schema([
                    // General Settings Tab
                    Tabs\Tab::make(__('pages.general_settings'))->schema([
                        Section::make(__('pages.setting'))
                            ->schema([

                                // Select::make('default_lang')
                                //     ->options([

                                //         'ar' => 'AR',
                                //         'en' => 'En',
                                //     ])
                                //     ->required()
                                //     ->label(__('pages.default_lang'))
                                //     ->validationMessages([
                                //         'required' => __('validation.required'),
                                //     ]),


                                // Forms\Components\Select::make('default_currancy')
                                //     ->label(__('pages.default_currancy'))
                                //     ->options(Currancy::pluck('name', 'stand_for'))
                                //     ->validationMessages([
                                //         'required' => __('validation.required'),
                                //     ]),

                                Forms\Components\FileUpload::make('fav_icon')
                                    ->label(__('pages.fav_icon')),

                                Forms\Components\TextInput::make('site_name')
                                    ->required()
                                    ->label(__('pages.site_name'))
                                    ->validationMessages([
                                        'required' => __('validation.required'),
                                    ])
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('meta_title')
                                    ->label(__('pages.meta_title'))
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('meta_description')
                                    ->label(__('pages.meta_description'))
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('meta_keyWords')
                                    ->label(__('pages.meta_keyWords'))
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('meta_author')
                                    ->label(__('pages.meta_author'))
                                    ->maxLength(255),

                                Forms\Components\Toggle::make('is_open')
                                    ->label(__('pages.is_open'))
                                    ->onIcon('heroicon-m-bolt')
                                    ->offIcon('heroicon-m-user'),
                            ])
                            ->columns(2),
                    ]),

                    // Social Media Settings Tab
                    Tabs\Tab::make(__('pages.social_media_settings'))->schema([
                        Section::make(__('pages.social_media_settings'))
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->label(__('pages.email'))
                                    ->maxLength(255),

                                // Forms\Components\TextInput::make('second_mobile')
                                //     ->label(__('pages.second_mobile'))
                                //     ->maxLength(255),

                                // Forms\Components\TextInput::make('mobile')
                                //     ->label(__('pages.mobile'))
                                //     ->maxLength(255),

                                Forms\Components\TextInput::make('whatsapp')
                                    ->label(__('whatsapp')),

                                Forms\Components\TextInput::make('facebook')
                                    ->label(__('facebook')),

                                Forms\Components\TextInput::make('twitter')
                                    ->label(__('twitter')),

                                Forms\Components\TextInput::make('tiktok')
                                    ->label(__('tiktok')),

                                Forms\Components\TextInput::make('snapchat')
                                    ->label(__('snapchat')),

                                Forms\Components\TextInput::make('instagram')
                                    ->label(__('instagram')),
                            ])->columns(3),
                    ]),

                    // Payment Settings Tab
                    Tabs\Tab::make(__('pages.payment_settings'))->schema([
                        Section::make(__('pages.payment_settings'))
                            ->schema([
                                Forms\Components\TextInput::make('telr_store_id')
                                    ->label(__('pages.telr_store_id'))
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('telr_auth_key')
                                    ->label(__('pages.telr_auth_key'))
                                    ->maxLength(255),

                                Forms\Components\Toggle::make('telr_is_testing')
                                    ->label(__('pages.telr_is_testing'))
                            ])->columns(3),
                    ]),

                    // whatsapp Settings Tab
                    Tabs\Tab::make(__('pages.whatsapp_settings'))->schema([
                        Section::make(__('pages.whatsapp_settings'))
                            ->schema([
                                Forms\Components\TextInput::make('whatsapp_instance')
                                    ->label(__('pages.whatsapp_instance'))
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('whatsapp_token')
                                    ->label(__('pages.whatsapp_token'))
                                    ->maxLength(255),

                            ])->columns(2),
                    ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                Tables\Columns\TextColumn::make('default_lang')
                    ->label(__('pages.default_currdefault_langancy'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('default_payment')
                    ->label(__('pages.default_payment'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('default_currancy')
                    ->label(__('pages.default_currancy'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_author')
                    ->label(__('pages.meta_author'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('site_name')
                    ->label(__('pages.site_name'))
                    ->searchable(),


                Tables\Columns\TextColumn::make('meta_title')
                    ->label(__('pages.meta_title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_description')
                    ->label(__('pages.meta_description'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_keyWords')
                    ->label(__('Meta keyWords'))
                    ->searchable(),


                Tables\Columns\ImageColumn::make('fav_icon')
                    ->label(__('pages.fav_icon'))
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

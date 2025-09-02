<?php

namespace App\Filament\Resources\MerchantResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Facades\Filament;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('reference')->searchable(),
                Tables\Columns\TextColumn::make('client.name')->label('Client'),
                Tables\Columns\TextColumn::make('gross_amount')->money('sar'),
                Tables\Columns\TextColumn::make('fee_amount')->money('sar'),
                Tables\Columns\TextColumn::make('net_amount')->money('sar'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('entered_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'suspended' => 'Suspended',
                        'scheduled' => 'Scheduled',
                        'overdue' => 'Overdue',
                        'paid' => 'Paid',
                        'not_received' => 'Not Received',
                    ]),
            ])
            ->headerActions([])
            ->actions([
                ActionGroup::make([
                    Action::make('mark_paid')
                    ->label('Mark Paid')
                    ->color('success')
                    // ->visible(fn ($record) => $record->status->value === 'overdue')
                    ->authorize(fn () => true)
                    ->requiresConfirmation()
                    ->successNotificationTitle('Invoice marked as paid')
                    ->action(function ($record) {
                        $err = app(\App\Services\InvoiceStatusTransitionService::class)->markPaid($record);
                        if ($err) {
                            Notification::make()
                                ->title('Invoice update failed')
                                ->body($err)
                                ->danger()
                                ->sendToDatabase(auth()->user());
                        }
                    }),
                Action::make('not_received')
                    ->label('Not Received')
                    ->color('warning')
                    // ->visible(fn ($record) => $record->status->value === 'overdue')
                    ->authorize(fn () => true)
                    ->requiresConfirmation()
                    ->successNotificationTitle('Invoice marked as not received')
                    ->action(function ($record) {
                        $err = app(\App\Services\InvoiceStatusTransitionService::class)->markNotReceived($record);
                        if ($err) {
                            Notification::make()
                                ->title('Invoice update failed')
                                ->body($err)
                                ->danger()
                                ->sendToDatabase(auth()->user());
                        }
                    }),
                ]),
                
            ])
            ->bulkActions([]);
    }
}



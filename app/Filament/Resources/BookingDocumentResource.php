<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingDocumentResource\Pages;
use App\Filament\Resources\BookingDocumentResource\RelationManagers;
use App\Models\BookingDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingDocumentResource extends Resource
{
    protected static ?string $model = BookingDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('booking_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('document_type')
                    ->required(),
                Forms\Components\TextInput::make('file_path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('original_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file_size')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('uploaded_at')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_type'),
                Tables\Columns\TextColumn::make('file_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('uploaded_at')
                    ->dateTime()
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBookingDocuments::route('/'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThesisResource\Pages;
use App\Filament\Resources\ThesisResource\RelationManagers;
use App\Models\Thesis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class ThesisResource extends Resource
{
    protected static ?string $model = Thesis::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('summary')->required(),
                Forms\Components\TextInput::make('students')->required(),
                Forms\Components\Select::make('career_id')
                    ->relationship('career', 'name')
                    ->required(),
                    Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                Forms\Components\TextInput::make('grade')->numeric()->required(),
                Forms\Components\DatePicker::make('date')->required(),
                Forms\Components\BelongsToManyMultiSelect::make('professors')
                    ->relationship('professors', 'name')->required(),
                Forms\Components\FileUpload::make('document_path')
                    ->disk('public')
                    ->directory('thesis-documents')
                    ->openable()
                    ->acceptedFileTypes(['application/pdf', 'application/msword'])
                    ->required(),
                    //->preserveFilenames()
                    //->getUploadedFileNameForStorageUsing(
                    //    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                    //        ->prepend('custom-prefix-'),)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('career.name')->sortable()->searchable(),
                TextColumn::make('subject.name')->sortable()->searchable(),
                //TextColumn::make('grade')->sortable(),
                TextColumn::make('date')->sortable(),
                TextColumn::make('students')->sortable()->searchable(),
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
            'index' => Pages\ListTheses::route('/'),
            'create' => Pages\CreateThesis::route('/create'),
            'edit' => Pages\EditThesis::route('/{record}/edit'),
        ];
    }
}

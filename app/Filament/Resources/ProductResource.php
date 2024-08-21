<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('img')->label('Image')->disk('public')->directory('product_images')
                    ->nullable(),
                TextInput::make('buy_price')
                    ->required()
                    ->numeric(),
                TextInput::make('sell_price')
                    ->nullable()
                    ->numeric(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('weight')
                    ->nullable()
                    ->numeric(),
                Select::make('store_id')
                    ->label('Store')
                    ->relationship('store', 'name')
                    ->required(),
                TextInput::make('IKPU')->label("IKPU")
                    ->required()
                    ->maxLength(50),
                TextInput::make('status')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('pay_web')
                    ->nullable()
                    ->numeric(),
                TextInput::make('offer')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('shipping')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')->sortable()->toggleable(),
                TextColumn::make('name')->sortable()->searchable()->toggleable(),
                TextColumn::make('article')->sortable()->searchable()->toggleable(),
                TextColumn::make('code')->sortable()->searchable()->toggleable(),
                TextColumn::make('status')->sortable()->searchable()->toggleable(),
                TextColumn::make('store.name')->label('Store')->sortable()->searchable()->toggleable(),
                TextColumn::make('buy_price')->sortable()->toggleable(),
                TextColumn::make('sell_price')->sortable()->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
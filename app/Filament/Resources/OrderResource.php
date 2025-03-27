<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    // Eager Loading
    public static function query($query)
    {
        return $query->with(['user:id,name', 'product:id,name,price']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Pembeli')
                    ->required(),

                Forms\Components\TextInput::make('class')
                    ->label('Kelas')
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Akun User'),

                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->label('Produk')
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $product = Product::select(['id', 'price'])->find($state);
                            if ($product) {
                                $set('total_price', $product->price);
                            }
                        }
                    }),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->label('Jumlah')
                    ->afterStateUpdated(function ($state, callable $set) {
                        $product = Product::select(['id', 'price'])->find(request()->get('product_id'));
                        if ($product) {
                            $set('total_price', $product->price * $state);
                        }
                    }),

                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->label('Total Harga')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Pembeli')->sortable(),
                TextColumn::make('class')->label('Kelas')->sortable(),
                TextColumn::make('user.name')->label('Akun User')->sortable(),
                TextColumn::make('product.name')->label('Produk')->sortable(),
                TextColumn::make('quantity')->label('Jumlah')->sortable(),
                TextColumn::make('total_price')->label('Total Harga')->money('IDR')->sortable(),
                TextColumn::make('created_at')->label('Tanggal')->date(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus Pesanan'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pesanan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus pesanan yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus Pesanan Terpilih'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

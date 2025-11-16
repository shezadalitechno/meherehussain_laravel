<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HadithResource\Pages;
use App\Models\Hadith;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;

class HadithResource extends Resource
{
    protected static ?string $model = Hadith::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-duplicate';

    protected static UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('HadithContent')
                    ->tabs([
                        Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Select::make('collection_id')
                                    ->relationship('collection', 'title')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('book_id', null)),
                                Forms\Components\Select::make('book_id')
                                    ->relationship('book', 'title', fn ($query, $get) => 
                                        $query->where('collection_id', $get('collection_id'))
                                    )
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive()
                                    ->afterStateUpdated(fn (callable $set) => $set('chapter_id', null)),
                                Forms\Components\Select::make('chapter_id')
                                    ->relationship('chapter', 'title', fn ($query, $get) => 
                                        $query->where('book_id', $get('book_id'))
                                    )
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\TextInput::make('reference_number')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('grade')
                                    ->options([
                                        'Sahih' => 'Sahih',
                                        'Hasan' => 'Hasan',
                                        'Daif' => 'Daif',
                                        'Mawdu' => 'Mawdu',
                                    ])
                                    ->searchable(),
                            ]),
                        Tab::make('Arabic Text')
                            ->schema([
                                Forms\Components\RichEditor::make('text_arabic')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('English Translation')
                            ->schema([
                                Forms\Components\RichEditor::make('text_english')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Hinglish Translation')
                            ->schema([
                                Forms\Components\RichEditor::make('text_hinglish')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Urdu Translation')
                            ->schema([
                                Forms\Components\RichEditor::make('text_urdu')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Hindi Translation')
                            ->schema([
                                Forms\Components\RichEditor::make('text_hindi')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Narrators')
                            ->schema([
                                Forms\Components\Repeater::make('narrators')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\TextInput::make('narrator')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->defaultItems(0)
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Topics')
                            ->schema([
                                Forms\Components\Select::make('topics')
                                    ->relationship('topics', 'title')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('collection.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('book.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('chapter.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Sahih' => 'success',
                        'Hasan' => 'info',
                        'Daif' => 'warning',
                        'Mawdu' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('collection_id')
                    ->relationship('collection', 'title')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('grade')
                    ->options([
                        'Sahih' => 'Sahih',
                        'Hasan' => 'Hasan',
                        'Daif' => 'Daif',
                        'Mawdu' => 'Mawdu',
                    ]),
            ])
            ->recordActions([
                Actions\Action::make('view_frontend')
                    ->label('View Frontend')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Hadith $record): string => route('hadith.show', $record))
                    ->openUrlInNewTab(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHadith::route('/'),
            'create' => Pages\CreateHadith::route('/create'),
            'edit' => Pages\EditHadith::route('/{record}/edit'),
        ];
    }
}


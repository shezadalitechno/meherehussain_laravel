<?php

namespace App\Filament\Pages;

use App\Models\HeaderSetting;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;

class HeaderSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.header-settings';

    protected static UnitEnum|string|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $headerSetting = HeaderSetting::firstOrCreate([]);
        $this->form->fill([
            'site_title' => $headerSetting->site_title ?? 'Mehere Hussain',
            'tagline' => $headerSetting->tagline ?? '',
            'logo_id' => $headerSetting->logo_id,
            'navigation' => $headerSetting->navigationItems()->orderBy('order')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->label,
                    'link' => $item->link,
                    'order' => $item->order,
                ];
            })->toArray(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Site Information')
                    ->schema([
                        TextInput::make('site_title')
                            ->required()
                            ->maxLength(255)
                            ->label('Site Title'),
                        TextInput::make('tagline')
                            ->maxLength(255)
                            ->label('Tagline'),
                        Select::make('logo_id')
                            ->relationship('logo', 'alt', fn ($query) => $query->where('mime_type', 'like', 'image%'))
                            ->searchable()
                            ->preload()
                            ->label('Logo')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->alt ?? '')
                            ->getRelationshipTitleUsing(fn ($record) => $record->alt ?? ''),
                    ]),
                Section::make('Navigation Menu')
                    ->schema([
                        Repeater::make('navigation')
                            ->schema([
                                TextInput::make('label')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('link')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefix('/'),
                                TextInput::make('order')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->defaultItems(0)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $headerSetting = HeaderSetting::firstOrCreate([]);
        
        $headerSetting->update([
            'site_title' => $data['site_title'],
            'tagline' => $data['tagline'],
            'logo_id' => $data['logo_id'],
        ]);

        // Update navigation items
        $existingIds = collect($data['navigation'])->pluck('id')->filter();
        $headerSetting->navigationItems()->whereNotIn('id', $existingIds)->delete();

        foreach ($data['navigation'] as $index => $navItem) {
            if (isset($navItem['id'])) {
                $headerSetting->navigationItems()->where('id', $navItem['id'])->update([
                    'label' => $navItem['label'],
                    'link' => $navItem['link'],
                    'order' => $navItem['order'] ?? $index,
                ]);
            } else {
                $headerSetting->navigationItems()->create([
                    'label' => $navItem['label'],
                    'link' => $navItem['link'],
                    'order' => $navItem['order'] ?? $index,
                ]);
            }
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Header settings saved successfully!',
        ]);
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save')
                ->submit('save')
                ->color('primary'),
        ];
    }
}


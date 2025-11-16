<?php

namespace App\Filament\Pages;

use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;

class FooterSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.footer-settings';

    protected static UnitEnum|string|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $footerSetting = FooterSetting::firstOrCreate([]);
        $this->form->fill([
            'about_text' => $footerSetting->about_text ?? null,
            'contact_email' => $footerSetting->contact_email ?? '',
            'contact_address' => $footerSetting->contact_address ?? '',
            'contact_phone' => $footerSetting->contact_phone ?? '',
            'donate_link' => $footerSetting->donate_link ?? '',
            'links' => $footerSetting->links()->orderBy('order')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->label,
                    'link' => $item->link,
                    'order' => $item->order,
                ];
            })->toArray(),
            'languages' => $footerSetting->languages()->orderBy('order')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'language' => $item->language,
                    'order' => $item->order,
                ];
            })->toArray(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('About Section')
                    ->schema([
                        Forms\Components\RichEditor::make('about_text')
                            ->label('About Text')
                            ->columnSpanFull(),
                    ]),
                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('contact_email')
                            ->email()
                            ->maxLength(255)
                            ->label('Email'),
                        Textarea::make('contact_address')
                            ->rows(3)
                            ->label('Address'),
                        TextInput::make('contact_phone')
                            ->maxLength(255)
                            ->label('Phone'),
                        TextInput::make('donate_link')
                            ->url()
                            ->maxLength(255)
                            ->label('Donate Link'),
                    ]),
                Section::make('Quick Links')
                    ->schema([
                        Repeater::make('links')
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
                Section::make('Supported Languages')
                    ->schema([
                        Repeater::make('languages')
                            ->schema([
                                TextInput::make('language')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('order')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->defaultItems(0)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['language'] ?? null),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $footerSetting = FooterSetting::firstOrCreate([]);
        
        $footerSetting->update([
            'about_text' => $data['about_text'],
            'contact_email' => $data['contact_email'],
            'contact_address' => $data['contact_address'],
            'contact_phone' => $data['contact_phone'],
            'donate_link' => $data['donate_link'],
        ]);

        // Update links
        $existingLinkIds = collect($data['links'])->pluck('id')->filter();
        $footerSetting->links()->whereNotIn('id', $existingLinkIds)->delete();

        foreach ($data['links'] as $index => $link) {
            if (isset($link['id'])) {
                $footerSetting->links()->where('id', $link['id'])->update([
                    'label' => $link['label'],
                    'link' => $link['link'],
                    'order' => $link['order'] ?? $index,
                ]);
            } else {
                $footerSetting->links()->create([
                    'label' => $link['label'],
                    'link' => $link['link'],
                    'order' => $link['order'] ?? $index,
                ]);
            }
        }

        // Update languages
        $existingLangIds = collect($data['languages'])->pluck('id')->filter();
        $footerSetting->languages()->whereNotIn('id', $existingLangIds)->delete();

        foreach ($data['languages'] as $index => $language) {
            if (isset($language['id'])) {
                $footerSetting->languages()->where('id', $language['id'])->update([
                    'language' => $language['language'],
                    'order' => $language['order'] ?? $index,
                ]);
            } else {
                $footerSetting->languages()->create([
                    'language' => $language['language'],
                    'order' => $language['order'] ?? $index,
                ]);
            }
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Footer settings saved successfully!',
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


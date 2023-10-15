<?php

namespace TallStackUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use TallStackUi\View\Personalizations\Contracts\Personalize;
use TallStackUi\View\Personalizations\Traits\InteractWithProviders;

class Alert extends Component implements Personalize
{
    use InteractWithProviders;

    public function __construct(
        public ?string $title = null,
        public ?string $text = null,
        public ?string $icon = null,
        public string $color = 'primary',
        public bool $closeable = false,
        public bool $translucent = false,
        public bool $pulse = false,
        public string $style = 'solid',
    ) {
        $this->style = $this->translucent && $this->color !== 'white' ? 'translucent' : 'solid';

        $this->colors();
    }

    public function personalization(): array
    {
        return Arr::dot([
            'wrapper' => 'rounded-md p-4',
            'title' => [
                'text' => 'text-lg font-semibold',
                'wrapper' => 'flex items-center justify-between',
                'icon' => [
                    'wrapper' => 'ml-auto pl-3',
                    'size' => 'w-5 h-5',
                ],
            ],
            'text' => [
                'wrapper' => 'flex items-center justify-between',
                'icon' => [
                    'wrapper' => 'flex items-center',
                    'size' => 'w-5 h-5',
                ],
            ],
            'icon' => [
                'wrapper' => 'mr-2',
                'size' => 'w-5 h-5',
            ],
        ]);
    }

    public function render(): View
    {
        return view('tallstack-ui::components.alert');
    }
}

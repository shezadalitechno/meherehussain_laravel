@props(['items' => []])

@if(count($items) > 0)
    <div class="breadcrumbs text-sm mb-4">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            @foreach($items as $item)
                <li>
                    @if(isset($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        {{ $item['label'] }}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif


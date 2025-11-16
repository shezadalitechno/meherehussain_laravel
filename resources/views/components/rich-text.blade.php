@php
    if (is_string($content)) {
        $content = json_decode($content, true);
    }
    if (empty($content) || !isset($content['content'])) {
        return;
    }
@endphp

<div class="prose prose-lg max-w-none">
    @foreach($content['content'] ?? [] as $node)
        @if($node['type'] === 'paragraph')
            <p>
                @foreach($node['content'] ?? [] as $child)
                    @if($child['type'] === 'text')
                        @if(!empty($child['marks']))
                            @php
                                $marks = collect($child['marks'])->pluck('type')->toArray();
                            @endphp
                            @if(in_array('bold', $marks))
                                <strong>{{ $child['text'] }}</strong>
                            @elseif(in_array('italic', $marks))
                                <em>{{ $child['text'] }}</em>
                            @else
                                {{ $child['text'] }}
                            @endif
                        @else
                            {{ $child['text'] }}
                        @endif
                    @endif
                @endforeach
            </p>
        @elseif($node['type'] === 'heading')
            @php
                $level = $node['attrs']['level'] ?? 1;
            @endphp
            <h{{ $level }}>
                @foreach($node['content'] ?? [] as $child)
                    @if($child['type'] === 'text')
                        {{ $child['text'] }}
                    @endif
                @endforeach
            </h{{ $level }}>
        @elseif($node['type'] === 'bulletList' || $node['type'] === 'orderedList')
            <{{ $node['type'] === 'orderedList' ? 'ol' : 'ul' }}>
                @foreach($node['content'] ?? [] as $listItem)
                    @if($listItem['type'] === 'listItem')
                        <li>
                            @foreach($listItem['content'] ?? [] as $itemContent)
                                @if($itemContent['type'] === 'paragraph')
                                    @foreach($itemContent['content'] ?? [] as $text)
                                        @if($text['type'] === 'text')
                                            {{ $text['text'] }}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </li>
                    @endif
                @endforeach
            </{{ $node['type'] === 'orderedList' ? 'ol' : 'ul' }}>
        @endif
    @endforeach
</div>


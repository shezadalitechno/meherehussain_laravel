@extends('layouts.app')

@section('title', 'Scholars - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', ['items' => [['label' => 'Scholars']]])

    <h1 class="text-4xl font-bold mb-8">Islamic Scholars</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($scholars as $scholar)
            @include('components.scholar-card', ['scholar' => $scholar])
        @endforeach
    </div>

    <div class="mt-8">
        {{ $scholars->links() }}
    </div>
</div>
@endsection


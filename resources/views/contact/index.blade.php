@extends('layouts.app')

@section('title', 'Contact - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', ['items' => [['label' => 'Contact']]])

    <h1 class="text-4xl font-bold mb-8">Contact Us</h1>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" required value="{{ old('name') }}">
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered" required value="{{ old('email') }}">
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Message</span>
                    </label>
                    <textarea name="message" class="textarea textarea-bordered h-32" required>{{ old('message') }}</textarea>
                    @error('message')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


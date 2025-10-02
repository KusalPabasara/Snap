@extends('layouts.app')

@section('title', 'Register Your Shop')

@section('content')
<div class="min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card bg-base-100 shadow-2xl">
            <div class="card-body">
                <h2 class="card-title text-3xl mb-6">Register Your Shop</h2>

                <form method="POST" action="{{ route('shops.store') }}" class="space-y-4">
                    @csrf

                    <div class="form-control">
                        <label class="label"><span class="label-text">Shop Name</span></label>
                        <input type="text" name="name" class="input input-bordered" required />
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Description</span></label>
                        <textarea name="description" class="textarea textarea-bordered" rows="3"></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Address</span></label>
                        <input type="text" name="address" class="input input-bordered" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Latitude</span></label>
                            <input type="number" step="0.000001" name="latitude" class="input input-bordered" required />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Longitude</span></label>
                            <input type="number" step="0.000001" name="longitude" class="input input-bordered" required />
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Phone</span></label>
                        <input type="tel" name="phone" class="input input-bordered" required />
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Email</span></label>
                        <input type="email" name="email" class="input input-bordered" />
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Website</span></label>
                        <input type="url" name="website" class="input input-bordered" />
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">Register Shop</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

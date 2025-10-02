@extends('layouts.app')

@section('title', 'Manage Shops - Admin')

@section('content')
<div class="min-h-screen bg-base-200">
    <!-- Header -->
    <div class="bg-primary text-primary-content py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Manage Shops</h1>
                <p class="mt-2 opacity-90">Approve, reject, and manage all shops</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>Owner</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shops as $shop)
                                <tr>
                                    <td>
                                        <a href="{{ route('shops.show', $shop->id) }}" class="link link-hover font-semibold">
                                            {{ $shop->name }}
                                        </a>
                                    </td>
                                    <td>{{ $shop->owner->name }}</td>
                                    <td class="max-w-xs truncate">{{ $shop->address }}</td>
                                    <td>{{ $shop->phone }}</td>
                                    <td>
                                        @if($shop->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif($shop->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($shop->status === 'suspended')
                                            <span class="badge badge-error">Suspended</span>
                                        @else
                                            <span class="badge badge-ghost">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            @if($shop->status === 'pending')
                                                <form action="{{ route('admin.shops.approve', $shop->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.shops.reject', $shop->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-error btn-sm">Reject</button>
                                                </form>
                                            @elseif($shop->status === 'active')
                                                <form action="{{ route('admin.shops.reject', $shop->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Suspend</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.shops.approve', $shop->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8">
                                        <p class="text-lg opacity-70">No shops found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($shops->hasPages())
                    <div class="mt-6">
                        {{ $shops->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

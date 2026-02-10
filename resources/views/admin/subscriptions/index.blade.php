@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('_message')

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Subscription List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Email</a></li> --}}
                                <li class="breadcrumb-item active">Subscription List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Subscriptions</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="subscriptionList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search..." id="search-input">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="subscriptionTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="created">Date Subscribed</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($subscriptions as $subscription)
                                                <tr>
                                                    <td class="email">{{ $subscription->email }}</td>
                                                    <td class="created">{{ $subscription->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @if($subscriptions->isEmpty())
                                        <div class="noresult text-center mt-3">
                                            <h5>Sorry! No Results Found</h5>
                                            <p class="text-muted">No subscriptions available.</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    {{ $subscriptions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    window.tableManager = TableManager.init({
        tableId: 'subscriptionTable',
        searchInputId: 'search-input',
        searchColumns: ['.email'],
        noResultClass: 'noresult',
        rowSelector: 'tbody tr',
        showCountOnButton: false
    });
});
</script>
@endsection

@extends('layouts.backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include('_message')

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Contact Submissions</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                {{-- <li class="breadcrumb-item"><a href="{{ route('admin.contact-submissions.index') }}">Email</a></li> --}}
                                <li class="breadcrumb-item active">Contact Submissions</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Manage Contact Submissions</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="contactList">
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
                                    <table class="table align-middle table-nowrap" id="contactTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="mobile">Mobile</th>
                                                <th class="sort" data-sort="subject">Subject</th>
                                                <th class="sort" data-sort="message">Message</th>
                                                <th class="sort" data-sort="created">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($contacts as $contact)
                                                <tr>
                                                    <td class="name">{{ $contact->name }}</td>
                                                    <td class="email">{{ $contact->email }}</td>
                                                    <td class="mobile">{{ $contact->mobile ?? '-' }}</td>
                                                    <td class="subject">{{ $contact->subject }}</td>
                                                    <td class="message">
                                                        <a href="javascript:void(0);"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#messageModal{{ $contact->id }}">
                                                            {{ Str::limit($contact->message, 50) }}
                                                        </a>
                                                    </td>

                                                    <td class="created">{{ $contact->created_at->format('d M Y') }}</td>
                                                </tr>
                                                <!-- Message Modal -->
<div id="messageModal{{ $contact->id }}"
    class="modal fade"
    tabindex="-1"
    aria-labelledby="messageModalLabel{{ $contact->id }}"
    aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">

           <!-- Header -->
           <div class="modal-header">
               <h5 class="modal-title"
                   id="messageModalLabel{{ $contact->id }}">
                   Full Message
               </h5>

               <button type="button"
                       class="btn-close"
                       data-bs-dismiss="modal"
                       aria-label="Close"></button>
           </div>

           <!-- Body -->
           <div class="modal-body">
               <p class="text-muted mb-0">
                   {{ $contact->message }}
               </p>
           </div>

           <!-- Footer (ONLY ONE BUTTON) -->
           <div class="modal-footer">
               <button type="button"
                       class="btn btn-light"
                       data-bs-dismiss="modal">
                   Close
               </button>
           </div>

       </div>
   </div>
</div>

                                            @endforeach
                                        </tbody>
                                    </table>

                                    @if($contacts->isEmpty())
                                        <div class="noresult text-center mt-3">
                                            <h5>Sorry! No Results Found</h5>
                                            <p class="text-muted">No contact submissions available.</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">

                                        <!-- Previous -->
                                        <a class="page-item pagination-prev {{ $contacts->previousPageUrl() ? '' : 'disabled' }}"
                                           href="{{ $contacts->previousPageUrl() ?? 'javascript:void(0);' }}">
                                            Previous
                                        </a>

                                        <!-- Page Numbers -->
                                        <ul class="pagination listjs-pagination mb-0">
                                            @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                                                <li class="page-item {{ $contacts->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $contacts->url($i) }}">
                                                        {{ $i }}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>

                                        <!-- Next -->
                                        <a class="page-item pagination-next {{ $contacts->nextPageUrl() ? '' : 'disabled' }}"
                                           href="{{ $contacts->nextPageUrl() ?? 'javascript:void(0);' }}">
                                            Next
                                        </a>

                                    </div>
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
        tableId: 'contactTable',
        searchInputId: 'search-input',
        searchColumns: ['.name', '.email', '.subject', '.message'],
        noResultClass: 'noresult',
        rowSelector: 'tbody tr',
        showCountOnButton: false
    });
});
</script>
@endsection

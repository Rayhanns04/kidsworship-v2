@extends('layouts.app')

@section('title', 'KidsWorship | Common Times')

@section('modal')
    <div>
        {{-- Create Modal ----------------------------------- --}}
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create {{ $Title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ $Action }}/save-create" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Start Time</label>
                                <input type="text" class="form-control" name="start">
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">End Time</label>
                                <input type="text" class="form-control" name="end">
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Assets</label>
                                <select class="form-select" aria-label="Default select example" name="asset_id">
                                    <option selected>Open this select menu</option>
                                    @foreach ($allAssets as $allAsset)
                                        <option value="{{ $allAsset->id }}">{{ $allAsset->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="float-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Edit Modal ----------------------------------- --}}

        {{-- Edit Modal ----------------------------------- --}}
        @foreach ($commonTimes as $commonTime)
            <div class="modal fade" id="editModal{{ $commonTime->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit {{ $Title }} |
                                {{ $commonTime->id }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ $Action }}/save-edit/{{ $commonTime->id }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="rupiah1"
                                        value="{{ $commonTime->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Start Time</label>
                                    <input type="text" class="form-control" name="start"
                                        value="{{ $commonTime->startTime }}">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">End Time</label>
                                    <input type="text" class="form-control" name="end"
                                        value="{{ $commonTime->endTime }}">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Assets</label>
                                    <select class="form-select" aria-label="Default select example" name="asset_id">
                                        <option selected value="1">Please Change | Kosong</option>
                                        @foreach ($allAssets as $allAsset)
                                            <option value="{{ $allAsset->id }}">{{ $allAsset->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="float-end">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- End Edit Modal ----------------------------------- --}}
    </div>
@endsection

@section('content')
    <div class="page-heading d-md-flex justify-content-between">
        <h3>Table all {{ $Title }}</h3>
        <button type="button" class="btn btn-primary mr-3" data-bs-toggle="modal"
            data-bs-target="#createModal">Create</button>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <!-- Table with outer spacing -->
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Asset</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commonTimes as $commonTime)
                                <tr>
                                    <td class="text-bold-500">{{ $loop->iteration }}</td>
                                    <td>{{ $commonTime->name }}</td>
                                    <td>{{ $commonTime->startTime }}</td>
                                    <td>{{ $commonTime->endTime }}</td>
                                    <td>
                                        <a href="{{ asset('assets/images/allAsset/' . $commonTime->AllAsset->image) }}"
                                            target="_blank">View Image</a>
                                    </td>
                                    <td>
                                        <a href="#" type="button" class="btn btn-primary mx-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $commonTime->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </a>
                                        <a href="{{ $Action }}/{{ $commonTime->id }}" class=" mx-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

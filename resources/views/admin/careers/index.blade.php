@extends('layouts.site', ['title' => 'Manage Careers - Admin'])

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0"><i class="fas fa-briefcase me-2 text-primary"></i>Careers</h2>
                <a class="btn btn-primary" href="{{ route('admin.careers.create') }}">
                    <i class="fas fa-plus me-2"></i>Add Career
                </a>
            </div>

            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Education Level</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($careers as $career)
                            <tr>
                                <td class="fw-semibold">{{ $career->title }}</td>
                                <td>{{ $career->category ? ucfirst($career->category) : '-' }}</td>
                                <td>{{ $career->education_level ? ucfirst(str_replace('_', ' ', $career->education_level)) : '-' }}</td>
                                <td>
                                    <span class="badge {{ $career->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $career->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.careers.edit', $career) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this career?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $careers->links() }}
            </div>
        </div>
    </section>
@endsection

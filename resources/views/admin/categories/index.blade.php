@extends('admin.layout')

@section('title', 'Manage Categories')

{{-- fontawesome icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('header')
    @include('admin.partials._header')
@endsection

@section('content')
<div class="py-4 px-3 px-md-4">
    <div class="card mb-3 mb-md-4">
        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </nav>
            <!-- End Breadcrumb --> 
                <h2>Manage Categories</h2>
                <form id="createCategoryForm" class="form-inline mb-3">
                    @csrf
                    <input type="text" name="name" class="form-control mr-2" placeholder="New Category" required>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
                <table class="table table-bordered" id="categoryTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                        <tr data-id="{{ $cat->id }}">
                            <td class="cat-name">{{ $cat->name }}</td>
                            <td>{{ $cat->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $cat->updated_at->format('d M Y H:i') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info edit-btn"> <i class="fas fa-edit"></i> Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn"> <i class="fas fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="editCategoryRow" class="mt-4" style="display:none;">
                    <form id="editCategoryForm" class="form-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editCatId">
                        <input type="text" name="name" id="editCatName" class="form-control mr-2" required>
                        <button type="submit" class="btn btn-success mr-2"><i class="fas fa-check"></i> Update</button>
                        <button type="button" class="btn btn-light" id="cancelEditBtn"> <i class="fas fa-times"></i> Cancel</button>
                    </form>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end card -->
@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    // Create
    $('#createCategoryForm').submit(function(e){
        e.preventDefault();
        $.post('/admin/categories', $(this).serialize(), function(res){
            let cat = res.category;
            $('#categoryTable tbody').prepend(`
                <tr data-id="${cat.id}">
                    <td class="cat-name">${cat.name}</td>
                    <td>${(new Date(cat.created_at)).toLocaleString()}</td>
                    <td>${(new Date(cat.updated_at)).toLocaleString()}</td>
                    <td>
                        <button class="btn btn-sm btn-info edit-btn"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                </tr>
            `);
            $('#createCategoryForm')[0].reset();
        }).fail(function(xhr){
            alert(xhr.responseJSON.errors.name[0]);
        });
    });

    // Show inline edit form
    $(document).on('click', '.edit-btn', function(){
        let tr = $(this).closest('tr');
        let id = tr.data('id');
        let name = tr.find('.cat-name').text();
        $('#editCatId').val(id);
        $('#editCatName').val(name);
        $('#editCategoryRow').show();
        $('#editCatName').focus();
    });

    // Cancel edit
    $('#cancelEditBtn').click(function(){
        $('#editCategoryRow').hide();
        $('#editCategoryForm')[0].reset();
    });

    // Update
    $('#editCategoryForm').submit(function(e){
        e.preventDefault();
        let id = $('#editCatId').val();
        $.ajax({
            url: '/admin/categories/' + id,
            type: 'PUT',
            data: $(this).serialize(),
            success: function(res){
                let cat = res.category;
                let tr = $('#categoryTable tr[data-id="'+id+'"]');
                tr.find('.cat-name').text(cat.name);
                tr.find('td:nth-child(3)').text((new Date(cat.updated_at)).toLocaleDateString());
                $('#editCategoryRow').hide();
                $('#editCategoryForm')[0].reset();
            },
            error: function(xhr){
                alert(xhr.responseJSON.errors.name[0]);
            }
        });
    });

    // Delete
    $(document).on('click', '.delete-btn', function(){
        if(!confirm('Delete this category?')) return;
        let tr = $(this).closest('tr');
        let id = tr.data('id');
        $.ajax({
            url: '/admin/categories/' + id,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(){
                tr.remove();
            }
        });
    }); 
});
</script>
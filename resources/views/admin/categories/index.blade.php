@extends('admin.layouts.app')


@section('content')

 <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">API Key</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                        <li class="breadcrumb-item active">API Key</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div> --}}
                    <!-- end page title -->

                    
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="apiKeyList">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Les categories</h5>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <a href="{{ route('admin.categories.create') }}"
                                        class="btn btn-secondary create-btn">
                                            <i class="ri-add-line align-bottom me-1"></i> Ajouter
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card mb-3">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="name" scope="col">Nom de la catégorie</th>
                                                        <th class="sort" data-sort="description" scope="col">Description</th>
                                                        <th scope="col">Produits</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @forelse ($categories as $category)
                                                        <tr>
                                                            <td class="name">{{ $category->name }}</td>
                                                            <td class="description">{{ $category->description }}</td>
                                                            <td>{{ $category->products_count ?? $category->products()->count() }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-soft-secondary btn-sm dropdown-toggle"
                                                                        type="button"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false"
                                                                    >
                                                                        Actions
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li><a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">Modifier</a></li>
                                                                        <li>
                                                                            <form
                                                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                                                method="POST"
                                                                                onsubmit="return confirm('Supprimer cette catégorie ?');"
                                                                            >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="dropdown-item text-danger">Supprimer</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center py-4">Aucune catégorie trouvée.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        

                                        @php($isPaginator = $categories instanceof \Illuminate\Pagination\AbstractPaginator)
                                        @if ($isPaginator && $categories->hasPages())
                                            <div class="d-flex justify-content-end mt-3">
                                                {{ $categories->links() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            
            
            
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    

    
   

@endsection

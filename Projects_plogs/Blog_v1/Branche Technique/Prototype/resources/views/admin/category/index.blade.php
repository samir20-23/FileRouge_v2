@extends('layouts.admin')
    @section('content')
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des Articles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mb-2 justify-content-end">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ Route('category.create') }}" class="btn btn-primary btn-sm p-2 text-white"><i class="fas fa-plus"></i> Ajouter catégorie</a>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Table des catégories</h3>
                    </div>
                    <!-- /.card-header -->
                    @if($categories->isEmpty())
                        <p class="p-5 text-center">aucun article trouvé.</p>
                    @else
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>slug</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{ $categorie->id }}</td>
                                        <td>{{ $categorie->name }}</td>
                                        <td>{{ $categorie->slug }}</td>
                                        <td>{{ $categorie->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> </a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
    @endsection

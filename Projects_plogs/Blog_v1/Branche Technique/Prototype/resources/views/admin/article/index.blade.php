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
                            <li class="breadcrumb-item active">Articles</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mb-2 justify-content-end">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ Route('article.create') }}" class="btn btn-primary btn-sm p-2 text-white"><i class="fas fa-plus"></i> Ajouter article</a>
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
                        <h3 class="card-title">Table des Articles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Article 1</td>
                                    <td>Jean Dupont</td>
                                    <td>2024-12-20</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> </a>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Article 2</td>
                                    <td>Marie Curie</td>
                                    <td>2024-12-21</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> </a>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <!-- Plus de lignes ici -->
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
    @endsection

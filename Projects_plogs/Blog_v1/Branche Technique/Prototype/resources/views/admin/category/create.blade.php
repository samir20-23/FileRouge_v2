
@extends('layouts.admin')
    @section('content')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ajouter un catégorie</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ Route('category.store') }}" method="POST">
                @csrf <!-- Pour la sécurité CSRF -->
                <div class="card-body">
                    <!-- Champ Nom -->
                    <div class="form-group">
                        <label for="title">Nom</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Entrez le Nom">
                    </div>
                    <!-- Champ slug -->
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Entrez le slug">
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    @endsection

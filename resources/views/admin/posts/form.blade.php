<x-default-layout title="Création d'un post">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h1 class="text-base font-semibold leading-7 text-gray-900">Créer un post</h1>
                <p class="mt-1 text-sm leading-6 text-gray-600">Révélons au Monde nos talents d'écrivains !</p>

                <div class="mt-10 space-y-8 md:w-2/3">
                    <x-input name="title" label="Titre" />
                    <x-input name="slug" label="Slug" help="Laisser vide pour un slug auto. Si une valeur est renseignée, elle sera slugifiée avant d'être soumise à validation." />
                    <x-textarea name="content" label="Contenu du post"></x-textarea>
                    <x-input name="thumbnail" type="file" label="Vignette" />
                    <x-select name="category_id" label="Catégorie" :list="$categories" />
                    <x-select name="tag_ids" label="Etiquettes" :list="$tags" multiple />
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Publier</button>
        </div>
    </form>
</x-default-layout>

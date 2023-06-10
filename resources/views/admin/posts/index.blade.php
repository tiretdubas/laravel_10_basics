<x-default-layout title="Gestion des posts">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Posts</h1>
            <p class="mt-2 text-sm text-gray-700">Interface d'administration du blog.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('admin.posts.create') }}" class="inline-flex rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Créer un post</a>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Titre</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($posts as $post)
                        <tr class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ $post->title }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="{{ route('posts.show', ['post' => $post]) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                    Voir le post
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Editer
                                </a>
                            </td>
                            <td x-data class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                <a href="{{ route('admin.posts.destroy', ['post' => $post]) }}" @click.prevent="$refs.delete.submit()" class="text-indigo-600 hover:text-indigo-900">
                                    Supprimer
                                </a>
                                <form x-ref="delete" action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-default-layout>

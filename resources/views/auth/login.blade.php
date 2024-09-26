<x-auth-layout title="Connexion" :action="route('login')" submitMessage="Connexion">
    <x-input name="email" label="Adresse e-mail" type="email" />
    <x-input name="password" label="Mot de passe" type="password" />
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" class="form-checkbox h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="remember" class="ml-3 block text-sm leading-6 text-gray-900">Rester connecté</label>
        </div>
    </div>
</x-auth-layout>

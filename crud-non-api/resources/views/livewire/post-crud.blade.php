<x-slot name="header">
  <h2 class="text-center">Daftar Tempat Wisata di Kabupaten Tegal</h2>
</x-slot>
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
      @if (session()->has('message'))
      <div
        class="bg-red-700 border-t-4 border-teal-500 rounded-b text-white px-4 py-3 shadow-md my-3"
        role="alert"
      >
        <div class="flex">
          <div>
            <p class="text-sm">{{ session('message') }}</p>
          </div>
        </div>
      </div>
      @endif
      <button wire:click="create()" class="bg-gray-800 text-white font-bold py-2 px-4 rounded my-3 pt-2">
        Create Posts
      </button>
      @if( $isModalOpen) @include('livewire.create') @endif
      <table class="table-fixed w-full">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">Nama Wisata</th>
            <th class="px-4 py-2">Alamat</th>
            <th class="px-4 py-2">Descripsi</th>
            <th class="px-4 py-2">Kategori</th>
            <th class="px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($posts as $post)
          <tr>
            <td class="border px-4 py-2">{{ $post->id }}</td>
            <td class="border px-4 py-2">{{ $post->name }}</td>
            <td class="border px-4 py-2">{{ $post->address}}</td>
            <td class="border px-4 py-2">{{ $post->description }}</td>
            <td class="border px-4 py-2">{!! $post->category_label !!}</td>
            <td class="border px-4 py-2">
              <button wire:click="edit({{ $post->id}})"class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                Edit
              </button>
              <button
                wire:click="delete({{ $post->id}})"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Delete
              </button>
            </td>
          </tr>
          @empty
              <tr>
                <td class="border px-4 py-2 text-center" colspan="6">Tidak ada data untuk saat ini</td>
              </tr>
          @endforelse
          
        </tbody>
      </table>
    </div>
  </div>
</div>

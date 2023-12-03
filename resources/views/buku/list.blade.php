<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">
        @if(Session::has('pesan'))
            <div class="alert alert-success fade show" id="success-alert" role="alert">{{ Session::get('pesan') }}</div>
        @endif

        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <form action="{{ route('buku.listSearch') }}" method="get">
                        @csrf
                        <div class="input-group my-3">
                            <input type="text" name="kata" class="form-control" placeholder="Cari..." aria-label="Cari" style="border-radius: 8px 0 0 8px">
                            <button type="submit" class="btn btn-primary" style="border-radius: 0 8px 8px 0; background-color: #0D6FFB">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <table class="table table-striped table-bordered table-fixed">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">No.</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tgl. Terbit</th>
                            <th scope="col">rating</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_buku as $buku)
                        <tr>
                            
                            <td>{{ ++$no }}</td>
                            <td>
                                <div class="flex flex-row items-center">
                                    @if ($buku->filepath)
                                        <div class="h-10 w-10 m-3">
                                            <img
                                                class="h-full w-full rounded-full object-cover object-center"
                                                src="{{ asset($buku->filepath) }}"
                                                alt="thumbnail"
                                            />
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <p class="ml-2">{{ $buku->judul }}</p>
                                        @if ($buku->avg_rating > 0)
                                            <p class="text-green-500">"{{$buku->avg_rating}}"</p>
                                        @else
                                            <p class="text-red-500">Belum ada rating</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                            <td>{{ ($buku->tgl_terbit)->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group justify-center" role="group" style="overflow-x: auto;">
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning text-white">Tambah Rating</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>                
                
                <div>{{ $data_buku->links('vendor.pagination.bootstrap-5') }}</div>

            </div>
        </div>
    </div>

</x-app-layout>
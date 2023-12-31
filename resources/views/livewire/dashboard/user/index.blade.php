<div>

    <title>{{ $title }}</title>

    <div class="content-wrapper">
        <!-- title page -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0">{!! $icon !!} {{ $title_page }}
                            <button wire:click="create" class="badge bg-primary border-0 px-3 py-2"
                                style="font-size: 10pt;font-weight: normal;width: 135px;">
                                <span wire:loading.remove wire:target="create"><i class="bi bi-plus-lg"></i> Tambah
                                    Data</span>
                                <span wire:loading wire:target="create"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true" style="width: 13px; height: 13px;"></span>
                            </button>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- continer -->
        <section class="content">
            <div class="container-fluid">
                @if ($showLivewireCreate)
                    @livewire('dashboard.user.create')
                    <script>
                        $(document).ready(function() {
                            $('#createModal').modal('show');
                        });
                    </script>
                @endif
                @if ($showLivewireDelete)
                    @livewire('dashboard.user.delete', ['user' => $getUser])
                    <script>
                        $(document).ready(function() {
                            $('#deleteModal').modal('show');
                        });
                    </script>
                @endif
                <script>
                    $(document).on('click', '#closeModal', function() {
                        Livewire.emit('closeLivewire');
                    });
                </script>

                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select sm w-auto" wire:model="paginate">
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input wire:model="search" type="text" placeholder="Cari" class="form-control">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                        </div>
                        @if ($user->count())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align: center;">#</th>
                                            <th style="vertical-align: middle;">Nama Pengguna</th>
                                            <th style="vertical-align: middle;">Username</th>
                                            <th style="width: 150px;vertical-align: middle;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $data)
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $loop->iteration }}</td>
                                                <td style="vertical-align: middle;">{{ ucwords($data->nama) }}
                                                </td>
                                                <td style="vertical-align: middle;">{{ $data->username }}</td>
                                                <td>
                                                    @if ($auth->id == $data->id)
                                                        <button id="noHapus"
                                                            class="badge bg-danger mb-1 border-0 py-2"><i
                                                                class="bi bi-trash"></i></button>
                                                    @else
                                                        <button class="badge bg-danger mb-1 border-0 py-2"
                                                            wire:click="delete({{ $data->id }})"
                                                            ata-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Hapus">
                                                            <span wire:loading.remove
                                                                wire:target="delete({{ $data->id }})">
                                                                <i class="bi  bi-trash"></i>
                                                            </span>
                                                            <span wire:loading
                                                                wire:target="delete({{ $data->id }})"
                                                                class="spinner-border spinner-border-sm text-light"
                                                                role="status" aria-hidden="true"
                                                                style="width: 11px; height: 11px;"></span>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">{{ $user->links() }}</div>
                        @else
                            <hr>
                            <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                        @endif
                    </div>
                </div>

            </div>
        </section>

    </div>

    <script>
        $(document).on('click', '#noHapus', function() {
            Swal.fire({
                icon: 'error',
                'title': 'Sorry !',
                text: 'Tombol hapus tidak berfungsi saat anda sedang login',
                allowOutsideClick: false
            })
        })
    </script>


</div>

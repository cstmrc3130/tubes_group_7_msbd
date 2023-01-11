<div class="page-wrapper">

    {{-- ========== BREADCRUMB START ========== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Notifikasi</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== BREADCRUMB START ========== --}}



    {{-- ========== ALL NOTIFICATIONS START ========== --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                        <h4 class="card-title text-info m-0">Filter : </h4>



                        {{-- ========== FILTER BUTTON START ========== --}}
                        <div class="btn-group ml-3">
                            <button type="button" id="filter-value" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Terbaru
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" wire:click="FilterData('newest')">Terbaru</a>
                                <a class="dropdown-item" href="javascript:void(0)" wire:click="FilterData('last-week')">Minggu lalu</a>
                                <a class="dropdown-item" href="javascript:void(0)" wire:click="FilterData('last-month')">Bulan lalu</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" wire:click="FilterData('all')">Seluruhnya</a>
                            </div>
                        </div>
                        {{-- ========== FILTER BUTTON END ========== --}}

                    </div>

                    @foreach($studentProfileNotification as $notification)
                        @livewire('admin.student-profile-inline', 
                        [
                            'notificationID' => $notification->id, 
                            'name' => \App\Models\User::find($notification->data['user_id'])->student->name, 
                            'createdAt' => $notification->created_at->diffForHumans()
                        ],
                        key($notification->id))
                    @endforeach

                    @foreach($studentAbsentNotification as $notification)
                        @livewire('admin.student-absent-inline', 
                        [
                            'notificationID' => $notification->id, 
                            'name' => \App\Models\User::find($notification->data['user_id'])->student->name, 
                            'createdAt' => $notification->created_at->diffForHumans()
                        ],
                        key($notification->id))
                    @endforeach

                    <div class="d-flex border-top mt-3">
                        <button class="btn btn-block btn-outline-dark border-0 mt-1" wire:click="LoadMore()" @if($totalNotification < $amount) @disabled(true) @endif>
                            <span wire:loading.remove>Load More</span> 
                            <span wire:loading>Loading...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========== ALL NOTIFICATIONS END ========== --}}



    {{-- ========== FOOTER START ========== --}}
    <footer class="footer text-center">All Rights Reserved by Kelompok 7 KOM C © 2022. </footer>
    {{-- ========== FOOTER START ========== --}}

</div>

@push('additional-style')
@endpush

@push('additional-script')
    {{-- CHANGE FILTER BUTTON VALUE --}}
    <script>
        $(function ()
        {
            window.addEventListener('change-filter-value', e =>
            {
                if(e.detail.data == "newest")
                {
                    $('#filter-value').text("Terbaru")
                }
                else if (e.detail.data == "last-week")
                {
                    $('#filter-value').text("Minggu Lalu")
                }
                else if (e.detail.data == "last-month")
                {
                    $('#filter-value').text("Bulan Lalu")
                }
                else
                {
                    $('#filter-value').text("Seluruhnya")
                }
            })
        })
    </script>
@endpush

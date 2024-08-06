<div>
    @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
                <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                    <option value="บทความล่าสุด">บทความล่าสุด</option>
                    <option value="บทความเก่าสุด">บทความเก่าสุด</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterType">
                    <option value="ทุกประเภท">ทุกประเภท</option>
                    <option value="Software">Software</option>
                    <option value="Hardware">Hardware</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="/member/add_thesis" class="btn btn-success">เพิ่มบทความ</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>ชื่อบทความ</th>
                        <th>ประเภท</th>
                        <th>ปีการศึกษา</th>
                        <th>วันที่-เวลา</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thesis as $thesis_detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $thesis_detail->title }}</td>
                            <td>{{ $thesis_detail->type }}</td>
                            <td>{{ $thesis_detail->year_published }}</td>
                            <td>{{ $thesis_detail->updated_at }}</td>
                            <td>
                                @if ($thesis_detail->status == '1')
                                    <a wire:click='show({{ $thesis_detail->id_dissertation_article }})'
                                        class="btn btn-success"><i class='bx bxs-show'></i></a>
                                @else
                                    <a wire:click='hide({{ $thesis_detail->id_dissertation_article }})'
                                        class="btn btn-danger"><i class='bx bxs-hide'></i></a>
                                @endif
                                <a href="/member/edit_and_detail_thesis/{{ $thesis_detail->id_dissertation_article }}"
                                    class="btn btn-orange"><i class='bx bx-detail'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $thesis->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

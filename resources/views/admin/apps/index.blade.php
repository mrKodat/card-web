@extends('admin.layout.default')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-uppercase">Install/Update addons</h5>
            <div class="d-inline-flex">
                <a href="{{URL::to('admin/createsystem-addons')}}" class="btn btn-secondary px-2 d-flex">
                    <i class="fa-regular fa-plus mx-1"></i>Install/Update addons</a>
            </div>
        </div>
        <div class="row search_row">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="installed-tab" data-bs-toggle="tab" href="#installed" role="tab" aria-controls="installed" aria-selected="true">Installed Addons</a>
                            <a class="nav-link" id="available-tab" data-bs-toggle="tab" href="#available" role="tab" aria-controls="available" aria-selected="false">Available Addons</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="installed" role="tabpanel" aria-labelledby="installed-tab">
                            <div class="row">
                                @forelse(App\Models\SystemAddons::all() as $key => $addon)
                                <div class="col-md-6 col-lg-3 mt-3">
                                    <div class="card">
                                        <img class="img-fluid" src='{!! asset("storage/app/public/addons/".$addon->image) !!}' alt="">
                                        <div class="card-body">
                                            <h5 class="card-title mt-3">{{ ucfirst($addon->name) }}</h5>
                                        </div>
                                        <div class="card-footer">
                                            <p class="card-text d-inline"><small class="text-muted">Version : {{ $addon->version }}</small></p>
                                            @if($addon->activated)
                                            <a href="#" class="btn btn-sm btn-primary float-end" onclick="StatusUpdate('{{$addon->id}}','0')">Activated</a>
                                            @else
                                            <a href="#" class="btn btn-sm btn-danger float-end" onclick="StatusUpdate('{{$addon->id}}','1')">Deactivated</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- End Col -->
                                @empty
                                <div class="col-md-6 col-lg-3 mt-4">
                                    <h4>No Addon Installed</h4>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="available-tab">
                            <?php
                            $payload = file_get_contents('https://paponapps.co.in/api/addonsapi.php?type=papon&item=v_card');
                            $obj = json_decode($payload);
                            ?>
                            <div class="row">
                                @foreach($obj->data as $item)
                                <div class="col-md-6 col-lg-3 mt-3">
                                    <div class="card">
                                        <img class="img-fluid" src='{{$item->image}}' alt="">
                                        <div class="card-body">
                                            <h5 class="card-title mt-3">{{$item->name}}</h5>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{$item->purchase}}" target="_blank" class="btn btn-sm btn-primary">Purchase</a>
                                            <span class="btn btn-sm btn-success float-end">FREE with extended license</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- End Col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
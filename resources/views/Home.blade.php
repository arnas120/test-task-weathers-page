@extends('layouts.app')

@section('content')

    <!-- Data form beginning -->
    <div class="row">
        <div class="col-md-12 mt-2">

        <form method="post" id="addTab">
            <div class="form-row">

                <!-- api key input -->
                <div class="col">
                    <input type="text" class="form-control" name="apiKey" placeholder="API key" aria-label="API key">
                </div>
                <!-- api key input -ending- -->

                <div class="col">

                    <!-- City name input and submit button -->
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" name="cityName" placeholder="City" aria-label="City">

                        <!-- submit button -->
                        <div class="input-group-append">
                            <button class="btn btn-success" id="submitForm" type="submit">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                        <!-- submit button -ending- -->
                        
                    </div>
                    <!-- City name input and submit button -ending- -->

                </div>

            </div>
        </form>
        <div>
    </div>
    <!-- Data form ending -->    

    <!-- Tabs beginning -->
    <div class="row">
        <div class="col-md-12 mt-2">

            <!-- tab names -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($tabsData as $key => $tab)
                        <a class="nav-item nav-link 
                            @if($key == 0) 
                                active 
                            @endif" id="nav-{{ $tab->city }}-tab" onclick="getTabData('{{ $tab->city }}')" data-toggle="tab" href="#nav-{{ $tab->city }}" role="tab" aria-selected="true">
                                {{ $tab->city }}
                        </a>
                    @endforeach
                </div>
            </nav>

            <!-- tab content -->
            <div class="tab-content" id="nav-tabContent">
                @foreach ($tabsData as $key => $tab)
                    <div class="tab-pane fade show 
                        @if($key == 0) 
                            active
                        @endif" id="nav-{{ $tab->city }}" role="tabpanel" aria-labelledby="nav-{{ $tab->city }}-tab">
                            
                            <div id="tab-data-{{ $tab->city }}"></div>
                            
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- tabs ending -->


@endsection

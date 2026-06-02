<div>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Online Store</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('workshop.vehicle_search') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Live API Part Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('workshop.vehicle_search') }}" class="btn btn-secondary"><i class='bx bx-arrow-back'></i> Back to Search</a>
        </div>
    </div>

    @if($loading)
        <div class="card p-5 text-center">
            <div class="spinner-border text-primary mx-auto" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h4 class="mt-3 clr12477a">Fetching Premium Catalog Details...</h4>
        </div>
    @elseif(!$article)
        <div class="alert alert-danger p-5 text-center shadow-sm">
            <i class='bx bx-error-circle' style="font-size: 4rem;"></i>
            <h3 class="mt-3">Part Not Found</h3>
            <p>We could not retrieve details for part number: <strong>{{ $partNumber }}</strong></p>
            <a href="{{ route('workshop.vehicle_search') }}" class="btn btn-primary mt-3">Try Another Search</a>
        </div>
    @else
        <div class="card border-0 shadow-lg overflow-hidden">
           

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- 🔹 Left Column: Tehnic Details (Specs) --}}
                    <div class="col-lg-6">
                        <div class="bg-light p-3 rounded mb-3">
                            <h5 class="fw-bold clr12477a border-bottom pb-2 mb-3 text-uppercase">Tehnic Details</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped bg-white border rounded">
                                    <tbody>
                                        @if(!empty($article['allSpecifications']))
                                            @foreach($article['allSpecifications'] as $spec)
                                                <tr>
                                                    <td class="fw-bold text-muted p-2" style="width: 40%;">{{ $spec['criteriaName'] }}</td>
                                                    <td class="text-end p-2 fw-bold">{{ $spec['criteriaValue'] ?? 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="2" class="p-3 text-center">No technical details available.</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- 🔹 Right Column: Tehnic Details (Article Info & OEM) --}}
                    <div class="col-lg-6">
                        <div class="bg-light p-3 rounded h-100">
                            <h5 class="fw-bold clr12477a border-bottom pb-2 mb-3 text-uppercase">Article Information</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped bg-white border rounded">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-muted p-2">Article ID:</td>
                                            <td class="text-end p-2 fw-bold">{{ $article['articleId'] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-muted p-2">Article Number:</td>
                                            <td class="text-end p-2 fw-bold text-primary">{{ $article['articleNo'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-muted p-2">Manufacturer:</td>
                                            <td class="text-end p-2 fw-bold">{{ $article['supplierName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-muted p-2">EAN Numbers:</td>
                                            <td class="text-end p-2 fw-bold">{{ $article['eanNumber'] ?? '' }}</td>
                                        </tr>
                                        
                                        @if(!empty($article['oemNumbers']))
                                            @foreach($article['oemNumbers'] as $oem)
                                                <tr>
                                                    <td class="fw-bold text-muted p-2">OEM Numbers {{ $oem['manufacturerName'] }}:</td>
                                                    <td class="text-end p-2 fw-bold">{{ $oem['oemNumber'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- 🔹 Full Width: Image Details --}}
                    <div class="col-12 mt-5">
                        <h4 class="fw-bold border-bottom pb-2 mb-4 clr12477a text-uppercase">Image Details</h4>
                        <div class="bg-light p-5 rounded text-center shadow-inner">
                            <h6 class="text-start text-muted mb-4">Photo</h6>
                            @php
                                $imgUrl = !empty($article['s3ImageLink']) ? $article['s3ImageLink'] : ($article['s3image'] ?? null);
                            @endphp
                            @if(!empty($imgUrl))
                                <img src="{{ $imgUrl }}" class="img-fluid rounded shadow border p-2 bg-white" style="max-height: 600px; width: auto;">
                            @else
                                <div class="bg-white border rounded d-flex align-items-center justify-content-center mx-auto" style="height: 400px; max-width: 600px;">
                                    <i class='bx bx-image-alt text-secondary' style="font-size: 10rem;"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 🔹 Compatible Vehicles Section --}}
                    @if(!empty($article['compatibleCars']))
                    <div class="col-12 mt-5">
                        <h4 class="fw-bold border-bottom pb-2 mb-4 clr12477a text-uppercase">Compatible Vehicles</h4>
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="bg12477a text-white">
                                    <tr>
                                        <th>Manufacturer</th>
                                        <th>Model</th>
                                        <th>Engine</th>
                                        <th>Fuel</th>
                                        <th>Year Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($article['compatibleCars'] as $car)
                                        <tr>
                                            <td>{{ $car['manufacturerName'] }}</td>
                                            <td>{{ $car['modelName'] }}</td>
                                            <td>{{ $car['typeEngineName'] }}</td>
                                            <td>{{ $car['fuelType'] }}</td>
                                            <td>
                                                {{ !empty($car['constructionIntervalStart']) ? substr($car['constructionIntervalStart'], 0, 4) : '' }}
                                                {{ !empty($car['constructionIntervalEnd']) ? ' - ' . substr($car['constructionIntervalEnd'], 0, 4) : '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card-footer bg-light p-4 text-center">
                <p class="text-muted small mb-0">© 2026 CARNATE Premium Auto Parts Catalog System | Powered by RapidAPI</p>
            </div>
        </div>
    @endif
</div>

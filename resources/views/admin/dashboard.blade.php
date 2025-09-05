@extends('admin.layout')

@section('title', 'Admin Dashboard')

{{-- fontawesome icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')
<div class="container-fluid mt-4">
    {{-- flash message --}}
    @include('admin.partials._flash')

    <!-- Metrics Cards -->
    <div class="row">
        {{-- welcome logged in user card--}}
        <div class="col-md-6 col-xl-4 mb-3 mb-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-file-alt fa-lg text-primary mr-2"></i>
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">Blog Posts</h5>
                </div>
                <div class="card-body p-0 d-flex align-items-center justify-content-center">
                    <h4 class="h3 lh-1 mb-2">{{ $postCount }}</h4>
                    <p class="small text-muted mb-0 ml-2">Total Posts</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-3 mb-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-users fa-lg text-success mr-2"></i>
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">Users</h5>
                </div>
                <div class="card-body p-0 d-flex align-items-center justify-content-center">
                    <h4 class="h3 lh-1 mb-2">{{ $userCount }}</h4>
                    <p class="small text-muted mb-0 ml-2">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mb-3 mb-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-folder-open fa-lg text-warning mr-2"></i>
                    <h5 class="h6 font-weight-semi-bold text-uppercase mb-0">Categories</h5>
                </div>
                <div class="card-body p-0 d-flex align-items-center justify-content-center">
                    <h4 class="h3 lh-1 mb-2">{{ $categoryCount }}</h4>
                    <p class="small text-muted mb-0 ml-2">Total Categories</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">Posts Per Month</h5>
                </div>
                <div class="card-body">
                   @php
                        $series = !empty($postsPerMonth) ? array_column($postsPerMonth->toArray(), 'count') : [];
                        $labels = !empty($postsPerMonth) ? array_map(function($m) { return date('M', mktime(0,0,0,$m)); }, array_column($postsPerMonth->toArray(), 'month')) : [];
                    @endphp
                    @if(count($series) > 0)
                        <div class="js-area-chart"
                            data-series='@json($series)'
                            data-labels='@json($labels)'
                            style="height: 250px;">
                        </div>
                    @else
                        <div class="text-muted">No chart data available.</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">Users Registered (Recent)</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($recentUsers as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $user->name }}</span>
                                <span class="badge badge-primary badge-pill">{{ $user->created_at->format('d M Y') }}</span>
                            </li>
                        @endforeach
                        @if($recentUsers->isEmpty())
                            <li class="list-group-item text-muted">No recent users.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts Table -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 mb-md-4">
                <div class="card-header">
                    <h5 class="font-weight-semi-bold mb-0">Recent Blog Posts</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive-xl">
                        <table class="table text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPosts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td> <a href="{{ url('posts/'.$post->id) }}" target="_blank">{{ $post->title }} &nbsp; <i class="fas fa-external-link-alt"></i> </a></td>
                                        <td>{{ $post->author }}</td>
                                        <td>{{ $post->category }}</td>
                                        <td>{{ $post->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                                @if($recentPosts->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-muted text-center">No recent posts.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    @include('admin.partials._footerscripts')
    @include('admin.partials._dashboardscripts')
    <script>
        // Example: Pass chart data to Chartist via data attributes
       $('.js-area-chart').each(function() {
            let $el = $(this);
            let labels = $el.data('labels');
            let series = $el.data('series');
            // Ensure series is an array of arrays
            if (series && !Array.isArray(series[0])) {
                series = [series];
            }
            if (series && series.length > 0) {
                new Chartist.Line($el[0], {
                    labels: labels,
                    series: series
                }, {
                    fullWidth: true,
                    chartPadding: { right: 40 },
                    plugins: [Chartist.plugins.tooltip()]
                });
            }
        });
    </script>
@endsection
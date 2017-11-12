@if($organization->logo2)
.navbar-brand {
    background-image: url("{{resourceLink($organization->logo2)}}") !important;
}
@endif

@if($organization->primary_color)
header {
    background-color: {{ $organization->primary_color }} !important;
}
.navbar-brand {
    background-color: {{ $organization->primary_color }} !important;
}
@endif

@if($organization->secondary_color)
.sidebar {
    background-color: {{ $organization->secondary_color }} !important;
}
@endif
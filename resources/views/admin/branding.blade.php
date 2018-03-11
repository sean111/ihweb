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

@if($organization->tertiary_color)
.nav-link:hover {
    background-color: {{ $organization->tertiary_color }} !important;
}

.nav-link.active {
    background-color: {{ $organization->tertiary_color }} !important;
}

.nav-item:hover > .nav-link {
    background-color: {{ $organization->tertiary_color }} !important;
}
@endif
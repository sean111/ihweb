<?php
function setAlert(string $type, string $message)
{
    \Session::flash('flash_message', ['type' => $type, 'message' => $message]);
}

function getAlert()
{
    if (!\Session::has('flash_message')) {
        return null;
    }
    $data = \Session::get('flash_message');
    $class = $data['type'];
    if ($class === 'error') {
        $class = 'danger';
    }
    return '<div class="alert alert-' . $class . '">' . $data['message'] . '</div>';
}

function getDefaultOrg() {
    //TODO: Add caching here
    $domainId = session('defaultOrg');
    if (empty($domainId)) {
        if (Auth::user()->organization_id !== null) {
            return \App\Models\Organization::find(Auth::user()->organization_id);
        }
        return \App\Models\Organization::first();
    }
    return \App\Models\Organization::find($domainId);
}

function setDefaultOrg(int $id) {
    session(['defaultOrg' => $id]);
}

function getOrgs()
{
    if (Auth::user()->role == 'dev') {
        return \App\Models\Organization::all();
    }
    return Auth::user()->organization();
}

function resourceLink(\App\Models\Resource $resource)
{
    if ($resource === null) {
        return null;
    }
    return 'https://' . env('AWS_BUCKET') . '.' . env('AWS_URL') . '/' . $resource->path;
}
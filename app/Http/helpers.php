<?php
/**
 * Set an alert message
 * @param string $type
 * @param string $message
 */
function setAlert(string $type, string $message)
{
    \Session::flash('flash_message', ['type' => $type, 'message' => $message]);
}

/**
 * Get alert message
 * @return null|string
 */
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

/**
 * Get the users default organization
 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
 */
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

/**
 * Set the users default organization
 * @param int $id
 */
function setDefaultOrg(int $id) {
    session(['defaultOrg' => $id]);
}

/**
 * Get all organizations that the user can access
 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Relations\BelongsTo|static[]
 */
function getOrgs()
{
    if (Auth::user()->role == 'dev') {
        return \App\Models\Organization::all();
    }
    return Auth::user()->organization();
}

/**
 * Get the link for the resource
 * @param string $path
 * @return null|string
 */
function resourceLink(string $path)
{
    if ($path === null) {
        return null;
    }
    return 'https://' . env('AWS_BUCKET') . '.' . env('AWS_URL') . '/' . $path;
}
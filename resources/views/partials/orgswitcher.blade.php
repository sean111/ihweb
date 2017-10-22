@if (Auth::user()->role !== 'admin')
    <div class="row">
        <div class="col-sm-3 form-inline">
            <label for="defaultorg" class="form-control-label">Organization: </label>
            <select name="defaultorg" id="defaultorg" class="form-control">
                @foreach(getOrgs() as $org)
                    <option value="{{ $org->id }}" {{ getDefaultOrg()->id == $org->id ? 'selected' : null }}>{{ $org->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
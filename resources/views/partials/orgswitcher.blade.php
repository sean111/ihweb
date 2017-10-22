@if (Auth::user()->role !== 'admin')
    <select name="defaultorg" id="defaultorg" class="form-control">
        @foreach(getOrgs() as $org)
            <option value="{{ $org->id }}" {{ getDefaultOrg()->id == $org->id ? 'selected' : null }}>{{ $org->name }}</option>
        @endforeach
    </select>
@endif
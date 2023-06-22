@php $editing = isset($clear) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="clearance_id" label="Clearance" required>
            @php $selected = old('clearance_id', ($editing ? $clear->clearance_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Clearance</option>
            @foreach($clearances as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $clear->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="role"
            label="Role"
            :value="old('role', ($editing ? $clear->role : ''))"
            maxlength="255"
            placeholder="Role"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="comment"
            label="Comment"
            :value="old('comment', ($editing ? $clear->comment : ''))"
            maxlength="255"
            placeholder="Comment"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="signature" label="Signature">
            @php $selected = old('signature', ($editing ? $clear->signature : '0')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($clear->date)->format('Y-m-d') : 'now()')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $clear->status : '0')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
        </x-inputs.select>
    </x-inputs.group>
</div>

@php $editing = isset($student) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        @if(Auth::user()->hasRole('student'))
        <x-inputs.hidden name="user_id" :value="Auth::user()->id"></x-inputs.hidden>
        @else
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $student->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
        @endif
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="id_number"
            label="Id Number"
            :value="old('id_number', ($editing ? $student->id_number : ''))"
            maxlength="255"
            placeholder="Id Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="block_number"
            label="Block Number"
            :value="old('block_number', ($editing ? $student->block_number : ''))"
            maxlength="255"
            placeholder="Block Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="room_number"
            label="Room Number"
            :value="old('room_number', ($editing ? $student->room_number : ''))"
            maxlength="255"
            placeholder="Room Number"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>

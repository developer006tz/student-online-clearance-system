@php $editing = isset($student) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.hidden name="user_id" :value="old('id_number', ($editing ? $student->user->id : Auth::user()->id))"></x-inputs.hidden>
       
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
        <x-inputs.select name="level" label="Level">
            @php $selected = old('level', ($editing ? $student->level : '')) @endphp
            <option value="certificate" {{ $selected == 'certificate' ? 'selected' : '' }} >Certificate</option>
            <option value="diploma" {{ $selected == 'diploma' ? 'selected' : '' }} >Diploma</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="block_number"
            label="Block Number"
            :value="old('block_number', ($editing ? $student->block_number : ''))"
            maxlength="255"
            placeholder="Block Number"
            
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="room_number"
            label="Room Number"
            :value="old('room_number', ($editing ? $student->room_number : ''))"
            maxlength="255"
            placeholder="Room Number"
            
        ></x-inputs.text>
    </x-inputs.group>
</div>

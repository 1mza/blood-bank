<div>
    <select style="width: 90px;border-radius:5%;border-color: black;" wire:model.live="selectedGovernorate" id="governorates" name="governorate_id">
                <option>اختر المحافظة</option>
        @foreach($this->governorates as $governorate)
            <option value="{{ $governorate->id }}">
                {{ $governorate->name }}
            </option>
        @endforeach
    </select>
    @if($selectedGovernorate)
        <select style="width: 140px;border-radius: 5%;border-color: black;" wire:model.live="selectedCity" id="cities" name="city_id">
                    <option>اختر المدينة</option>
            @foreach($this->cities as $city)
                <option value="{{ $city->id }}">
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    @endif
</div>

<label for="color">Color</label>
<div>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        @foreach($colors as $rgb => $colorName)
            <label class="btn btn-color-{{strtolower($colorName)}} {{($colorSelected == $rgb) ? 'active focus' : ''}}">
                <input type="radio" name="color" id="color{{$colorName}}" value="{{$rgb}}" class="radio-type"
                       autocomplete="off" {{($colorSelected == $rgb) ? 'CHECKED' : ''}} required> {{ucfirst($colorName)}}
            </label>
        @endforeach
    </div>
    <div class="invalid-feedback">
        Please choose a color.
    </div>
</div>


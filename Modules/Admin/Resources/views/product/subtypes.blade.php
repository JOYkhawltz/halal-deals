<div class="form-group">
    <label for="usr">SubType</label>
    <select class="form-control" name="sub_type" id="sub_type">
        <option value="">Choose One Product SubType</option>
        @forelse($subtypes as $subtype)
        <option value="{{$subtype->id}}" data-id="{{$subtype->id}}">{{$subtype->name}}</option>
        @empty
        @endforelse
    </select>
    <span class="help-block"></span> 
</div>



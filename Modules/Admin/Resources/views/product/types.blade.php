<div class="form-group">
    <label for="usr">Type</label>
    <select class="form-control" name="type" id="type" onchange="getSubtype(this);">
        <option value="">Choose One Product Type</option>
        @forelse($types as $type)
        <?php
        $pType = App\ProductType::where('id', $type)->first();
        ?>
        <option value="{{$pType->id}}" data-id="{{$pType->id}}">{{$pType->name}}</option>
        @empty
        @endforelse
    </select>
    <span class="help-block"></span> 
</div>





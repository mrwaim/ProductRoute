<form class="form-horizontal" method="post" action="{{ url('products/' . $product->id . '/units/' . $unit->id) }}" id="formAddUnit">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Unit</h2>
        </header>
        <div class="panel-body">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group">
                <label class="control-label col-md-3">Unit</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" disabled value="{{ $unit->name }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Description</label>
                <div class="col-md-7">
                    <textarea class="form-control" disabled>{{ $unit->description }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Quantity</label>
                <div class="col-md-7">
                    <input type="number" min="1" name="quantity" value="{{ $unit->pivot->quantity }}" class="form-control" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Quantity east</label>
                <div class="col-md-7">
                    <input type="number" min="1" name="quantity_east" value="{{ $unit->pivot->quantity_east }}" class="form-control" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Quantity pickup</label>
                <div class="col-md-7">
                    <input type="number" min="1" name="quantity_pickup" value="{{ $unit->pivot->quantity_pickup }}" class="form-control" required/>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary submit-unit">Update</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</form>
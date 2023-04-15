<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Agregar producto a la venta</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group d-none ">
                                    <div>
                                        <label for="Unidades" >Venta</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>  
                                    <input wire:model="sales_id" type="text" class="form-control" id="sales_id" placeholder="Sales Id">@error('sales_id') <span class="error text-danger">{{ $message }}</span> @enderror
                         </div>
                    </div>
                    <div class="form-group ">
                                    <div>
                                        <label for="Unidades" >Unidades</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-ruler"></i></span>  
                                    <select  wire:model="units_id" name="units_id" id="units_id" class="form-control">
                                            <option value="{{$addproducts->productos->inventarios->units->id ?? 0}}" selected>{{$addproducts->productos->inventarios->units->descripcion ?? '--Seleccione la unidad de venta--'}}</option>  
                                            @foreach ($units as $row) 
                                            <option  value="{{ $row->id }}"> {{  $row->descripcion }}</option>
                                            @endforeach
                                        </select>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div>
                             <label for="Unidades" >Cantidad de producto</label>
                        </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span> 
                             <input wire:model="cantidad" type="text" class="form-control" id="cantidad" placeholder="Cantidad">@error('cantidad') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                                    <div>
                                        <label for="productos" >Productos</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-boxes"></i></span>  
                                    <select  wire:model="productos_id" name="productos_id" id="productos_id" class="form-control">
                                            <option value="{{$addproducts->productos->id ?? 0}}" selected>{{$addproducts->productos->contenido ?? '--Seleccione el producto--'}}</option>  
                                            @foreach ($inventarios as $row) 
                                            <option  value="{{ $row->productos->id }}"> {{$row->productos->contenido}} {{$row->productos->descripcion}} {{$row->productos->colores->clave}} {{$row->productos->colores->descripcion}} ( {{ $row->piezas }} )</option>
                                            @endforeach
                                        </select>
                        </div> 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Addventaproduct</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group ">
                        <label for="sales_id"></label>
                        <input wire:model="sales_id" type="text" class="form-control" id="sales_id" placeholder="Sales Id">@error('sales_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="units_id"></label>
                        <input wire:model="units_id" type="text" class="form-control" id="units_id" placeholder="Units Id">@error('units_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="cantidad"></label>
                        <input wire:model="cantidad" type="text" class="form-control" id="cantidad" placeholder="Cantidad">@error('cantidad') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="productos_id"></label>
                        <input wire:model="productos_id" type="text" class="form-control" id="productos_id" placeholder="Productos Id">@error('productos_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>

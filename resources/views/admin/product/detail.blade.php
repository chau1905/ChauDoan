<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{trans('messages.detail_product_lable')}}</h4>
        </div>
        <div class="modal-body">
            <p><strong>{{trans('messages.name_product_lable')}}</strong> {{$product->name}}</p>
            <p><strong>{{trans('messages.price_product_lable')}}</strong> {{$product->price}} vnđ</p>
            <p><strong>{{trans('messages.desc_product_lable')}}</strong> {{$product->description}}</p>
            <div>
                <p><strong>{{trans('messages.image_product')}}</strong></p>
                <img src="{{asset('/storage/product/'.$product->image)}}" alt="{{$product->name}}" style="max-width: 100%;">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('messages.close_lable')}}</button>
        </div>
    </div>
</div>

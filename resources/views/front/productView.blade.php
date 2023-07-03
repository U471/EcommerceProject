@extends('front.layout.layout');
@section('contant')
<div class="span9">
    <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li><a href="products.html">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>	
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href="{{asset('themes/images/products/large/f1.jpg')}}" title="Fujifilm FinePix S2950 Digital Camera">
				<img src="{{asset('upload/'.$product->image)}}" style="width:100%" alt="Fujifilm FinePix S2950 Digital Camera"/>
            </a>
			</div>
			<div class="span6">
				<h3>{{$product->productDetail->tital}} </h3>
				<hr class="soft"/>
				  <div class="control-group">
					<label class="control-label"><span>{{$product->price}}</span></label>
					<div class="controls">
				 <form action="{{route('cartStore')}}" method="post">
					 @csrf
					<input type="number" required class="span1" name="qty" placeholder="Qty."/>
					<input type="hidden" name="product_id" value="{{$product->id}}" />
					@if(Auth::user())
				    	<button type="submit" class="btn btn-large btn-primary pull-right">
						   Add to cart <i class=" icon-shopping-cart"></i></button>
					@else
					<button class="btn btn-large btn-primary pull-right"><a style="color: #fff;text-decoration:none;" href="{{route('userLogin')}}">
					Add to cart	<i class=" icon-shopping-cart"></i></a></button>
					@endif
					</form>
					</div>
				  </div>
				
				
				<hr class="soft"/>
				<h4>{{$product->productDetail->total_item}} items in stock</h4>
				<!-- <form class="form-horizontal qtyFrm pull-right"> -->
				  <div class="control-group">
					<label class="control-label"><span>Color</span></label>
					<div class="controls">
					  <select class="span2">
						  <option>Black</option>
						  <option>Red</option>
						  <option>Blue</option>
						  <option>Brown</option>
						</select>
					</div>
				  </div>
				<!-- </form> -->
				<hr class="soft clr"/>
				<p>{{$product->productDetail->description}}</p>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
              <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">Fujifilm</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2">FinePix S2950HD</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Released on:</td><td class="techSpecTD2"> 2011-01-28</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Dimensions:</td><td class="techSpecTD2"> 5.50" h x 5.50" w x 2.00" l, .75 pounds</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Display size:</td><td class="techSpecTD2">3</td></tr>
				</tbody>
				</table>
				
				<h5>Features</h5>
				<p>
				14 Megapixels. 18.0 x Optical Zoom. 3.0-inch LCD Screen. Full HD photos and 1280 x 720p HD movie capture. ISO sensitivity ISO6400 at reduced resolution. Tracking Auto Focus. Motion Panorama Mode. Face Detection technology with Blink detection and Smile and shoot mode. 4 x AA batteries not included. WxDxH 110.2 ×81.4x73.4mm. Weight 0.341kg (excluding battery and memory card). Weight 0.437kg (including battery and memory card).<br/>
				OND363338
				</p>

				<h4>Editorial Reviews</h4>
				<h5>Manufacturer's Description </h5>
				<p>
				With a generous 18x Fujinon optical zoom lens, the S2950 really packs a punch, especially when matched with its 14 megapixel sensor, large 3.0" LCD screen and 720p HD (30fps) movie capture.
				</p>

				<h5>Electric powered Fujinon 18x zoom lens</h5>
				<p>
				The S2950 sports an impressive 28mm – 504mm* high precision Fujinon optical zoom lens. Simple to operate with an electric powered zoom lever, the huge zoom range means that you can capture all the detail, even when you're at a considerable distance away. You can even operate the zoom during video shooting. Unlike a bulky D-SLR, bridge cameras allow you great versatility of zoom, without the hassle of carrying a bag of lenses.
				</p>
				<h5>Impressive panoramas</h5>
				<p>
				With its easy to use Panoramic shooting mode you can get creative on the S2950, however basic your skills, and rest assured that you will not risk shooting uneven landscapes or shaky horizons. The camera enables you to take three successive shots with a helpful tool which automatically releases the shutter once the images are fully aligned to seamlessly stitch the shots together in-camera. It's so easy and the results are impressive.
				</p>

				<h5>Sharp, clear shots</h5>
				<p>
				Even at the longest zoom settings or in the most challenging of lighting conditions, the S2950 is able to produce crisp, clean results. With its mechanically stabilised 1/2 3", 14 megapixel CCD sensor, and high ISO sensitivity settings, Fujifilm's Dual Image Stabilisation technology combines to reduce the blurring effects of both hand-shake and subject movement to provide superb pictures.
				</p>
              </div>
		<div class="tab-pane fade" id="profile">
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<div class="tab-pane active" id="blockView">
				
				<ul class="thumbnails">
				@foreach($related_product as $related)
					<li class="span3">
					  <div class="thumbnail">
						<a href="{{route('productView',$related->id)}}"><img src="{{asset('upload/'.$related->image)}}" alt=""/></a>
						<div class="caption">
						  <h5>{{$related->name}}</h5>
						  <p> 
							Lorem Ipsum is simply dummy text. 
						  </p>
						  <h4 style="text-align:center">
						  <a class="btn" href="{{route('productView',$related->id)}}"> 
							  <i class="icon-zoom-in"></i></a>
							   <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
							    <a class="btn btn-primary" href="#">&euro;{{$related->price}}</a></h4>
						</div>
					  </div>
					</li>
					@endforeach
				  </ul>
			<hr class="soft"/>
			</div>
		</div>
				<br class="clr">
					 </div>
		</div>
          </div>

	</div>
</div>
@endsection
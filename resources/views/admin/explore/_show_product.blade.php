<div class="row" id="explorePage" style="margin-top: 30px">
	<div class="col-md-12 text-right" >
		<div class = "btn-group float-right">
		   <button type = "button" class = "btn btn-primary dropdown-toggle" data-toggle = "dropdown">
		      Filter 
		      <span class = "caret"></span>
		   </button>
		   
		   <ul class = "dropdown-menu" role = "menu">
		      <li><a onclick="filterProduct('new')">New</a></li>
		      <li><a onclick="filterProduct('old')">Old</a></li>
		      <li><a onclick="filterProduct('byname')">Sort by name</a></li>
		      <li><a onclick="filterProduct('outOfStock')">Out of stock</a></li>
		   </ul>
		   
		</div>
	</div>
</div>
<div id=exploreProduct>
	@include('admin.explore._product')
</div>
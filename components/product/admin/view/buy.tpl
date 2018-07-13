<form  class="form-buy" action="{request}" method="{form_method}" id="{form_id}" name="{form_name}"  autocomplete="{form_autocomplete}">
	<div class="clearfix"></div>
	{inputs}
	<img width="200" src="{src}"/>
	
	<h3>{name}</h3>
	<h4>Price: ZAR {price}</h4>
	<p>{description}</p>
	<hr/>
	<p>Amount: ZAR {price}</p>
	<p>Discount: ZAR {discount}</p>
	<p><strong>Total (Amount to pay):</strong> ZAR {final_amount}</p>
        
	<button type="submit" class="btn btn-primary mb-2">Yes, Buy Now</button>
	
</form>
<div class="clearfix"></div><br/>
<p>
<a href="{back}">No, I've changed my mind</a>
</p>
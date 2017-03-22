<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	// $("#patient_table").dataTable({
	// 	"pageLength": 50
	// });
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	});

	var limit = $('#limit').val(),
	sort = $('#searchfilter').val();
	runRequest();

	$('#next').on('click', function(e){
		e.preventDefault();
		var next = $('#next').attr('value');
    	sort = $('#searchfilter').val();
		nxtprev(next, sort);
	})

	$('#prev').on('click', function(e){
		e.preventDefault();
		var prev = $('#prev').attr('value');
    	sort = $('#searchfilter').val();
		nxtprev(prev, sort);
	})

	$('#searchfilter').on('keyup', throttle(function(){
    	sort = $('#searchfilter').val();
    	runRequest('', sort);
	}))

	
	function throttle(f, delay){
	    var timer = null;
	    return function(){
	        var context = this, args = arguments;
	        clearTimeout(timer);
	        timer = window.setTimeout(function(){
	            f.apply(context, args);
	        },
	        delay || 500);
	    };
	}


	function nxtprev(page, sort){
		var data = {
			page : page,
			limit: limit
		}
		runRequest(data, sort);
	}
	

	function runRequest(display, sort){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>index.php/payment/getPayment",
			data: {
				display : display,
				sort: sort
			}
		}).done(function( json ) {
			var result = JSON.parse(json);
			displayPaymentList(result);
		});
	}

	function displayPaymentList(result){
		var length = result.data.length;
		var list = result.data;
		var html = "";

		for(var ic = 0; ic < length; ic++){
			var class_ea = (ic%2 == 0) ? "even" : "odd";
			var site_url = '<?php echo base_url() . "index.php" ?>';

			html += "<tr class=" + class_ea +">";
				html += "<td>" + list[ic].payment_id + "</td>";
				html += "<td>" + list[ic].pay_date + "</td>";
				html +=	"<td>" + list[ic].first_name + " " + list[ic].middle_name + " " + list[ic].last_name + " </td>";
				html += "<td>" + list[ic].pay_amount + "</td>";
				html += "<td>" + list[ic].pay_mode + "</td>";
				html += "<td>" + "<a class='btn btn-sm btn-primary square-btn-adjust' href='" + site_url + 'payment/edit/' + list[ic].payment_id + "/payment'> Edit </a>";
				html += "<a class='btn btn-sm btn-danger square-btn-adjust confirmDelete' href='" + site_url + 'payment/delete/' + list[ic].payment_id + "/payment'> Delete </a>";
			html += "</tr>";
			
		}
		$('#next').attr('value', result.next);
		$('#prev').attr('value', result.previous);
		$('#cpage').html(result.currentpage);
		$('#currentpage').html(result.currentpage);
		$('#apage').html(result.list);
		$('#list').html(result.list); 
		$('#patientlist').html(html);
	}


});


</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					Payments
				</div>
				<div class="panel-body">
					<a 	title="<?php echo $this->lang->line("add")." ".$this->lang->line("payment");?>" 
						href="<?php echo base_url()."index.php/payment/insert/0/payment" ?>" 
						class="btn btn-primary square-btn-adjust"
					>
							<?php echo $this->lang->line("add")." ".$this->lang->line("payment");?>
					</a>	
					<p></p>
					<div class="table-responsive">
						<div class="row">
							<div class="col-sm-6">
								<div class="dataTables_length" id="patient_table_length">
									<label> 
										<select id="limit" name="patient_table_length" aria-controls="patient_table" class="form-control input-sm">
											<option value="10">10</option>
											<option value="25">25</option>
											<option value="50">50</option>
											<option value="100">100</option>
										</select> 
									</label> records per page
								</div>
							</div>
							<div class="col-sm-6">
								<div id="patient_table_filter" class="dataTables_filter">
									<label>Search: <input type="search" id="searchfilter" class="form-control input-sm" aria-controls="patient_table"></label>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover" id="patient_table">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>date</th>
									<th>patient</th>
									<th>amount</th>
									<th>payment_mode</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody id="patientlist">
							
							</tbody>
						</table>
						<div class="row">
							<div class="col-sm-6">
								<div class="dataTables_info" id="patient_table_info" role="alert" aria-live="polite" aria-relevant="all">
									Showing <span id="cpage"> </span> to <span id="apage"> </span> of <span id="list"> </span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="dataTables_paginate paging_simple_numbers" id="patient_table_paginate">
									<ul class="pagination">
										<li class="paginate_button previous" aria-controls="patient_table" tabindex="0" id="patient_table_previous">
											<a href="#" id="prev">Previous</a>
										</li>
										<li class="paginate_button active" aria-controls="patient_table" tabindex="0">
											<a href="#" id="currentpage"></a>
										</li>
										<li class="paginate_button next" aria-controls="patient_table" tabindex="0" id="patient_table_next">
											<a href="#" id="next" >Next</a></li>
										</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>


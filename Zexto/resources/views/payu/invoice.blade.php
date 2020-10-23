<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zexto Transactions</title>
    <link rel="stylesheet" href="{{$frontend_url}}/src/fashi/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="{{$backend_url}}css/invoice.css" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="{{$data['class']}} center print-hide">
		{{$data['title']}}
	</div>
	<div class="container bootdey">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter">
							<i class="ace-icon fa fa-leaf green"></i>
							Zexto Invoice
						</h3>

						<div class="widget-toolbar no-border invoice-info">
							<span class="invoice-info-label">Order no. :</span>
							<span class="red">{{$data['order_id']}}</span>

							<br>
							<span class="invoice-info-label">Order Created at:</span>
							<span class="red">{{$data['order_created_at']}}</span>
						</div>
					</div>

					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
											<b>Customer Info</b>
										</div>
									</div>

									<div>
										<ul class="list-unstyled spaced">
											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Customer Name:</strong> <b class="red">{{$data['firstname']}} {{$data['lastname']}}</b>
											</li>

											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i>
												<strong>Phone:</strong>
												<b class="red">{{$data['phone']}}</b>
											</li>
											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i>
												<strong>E-mail:</strong>
												<b class="red">{{$data['email']}}</b>
											</li>
											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Zipcode:</strong> <b class="red">{{$data['zipcode']}}</b>
											</li>

											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Shipping Address:</strong> <b class="red">{{$data['address']}}</b>
											</li>


											<li class="divider"></li>

											<div class="col-xs-11 label label-lg label-info arrowed-in">
											<b>Payment Details</b>
										</div>
										</ul>
									</div>
								</div><!-- /.col -->

								<div class="col-sm-6">
									<div class="row">
										<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
											<b>Payment Info</b>
										</div>
									</div>

									<div>
										<ul class="list-unstyled  spaced">
											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Order ID.:</strong> <b class="red">{{$data['order_id']}}</b>
											</li>

											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Transaction ID:</strong> <b class="red">{{$data['txnid']}}</b>
											</li>

											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Payment Mode:</strong> <b class="red">{{$data['mode']}}</b>
											</li>

											<li class="divider"></li>

											<li>
												<i class="fa fa-circle" style="font-size: 10px;"></i> <strong>Transaction Status:</strong> <b class="red">{{$data['status']}}</b>
											</li>
										</ul>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->

							<div class="space"></div>

							<div>
								<table class="table table-striped table-bordered table-responsive">
									<thead>
										<tr>
											<th class="center">S. no.</th>
											<th>Product</th>
											<th class="hidden-xs">Description</th>
											<th class="hidden-xs">Price <b>(in <i class="fa fa-inr"></i>)</b></th>
											<th class="hidden-xs">Quantity</th>
											<th class="hidden-480">Discount</th>
											<th>Total <b>(in <i class="fa fa-inr"></i>)</b></th>
										</tr>
									</thead>

									<tbody>
										@for($i =0; $i < sizeof($data['products']); $i++)
										<tr>
											<td>{{$i + 1}}</td>
											<td>{{$data['products'][$i]['product_name']}}</td>
											<td class="hidden-xs">{{$data['products'][$i]['product_description']}}</td>
											<td class="hidden-xs center">{{$data['products'][$i]['product_amount']}}</td>
											<td class="hidden-480 center"> {{$data['products'][$i]['product_quantity']}}</td>
											<td class="hidden-480 center"> --- </td>
											<td class="center">{{$data['products'][$i]['products_total_price']}}</td>
										</tr>
										@endfor
									</tbody>
								</table>
							</div>

							<div class="hr hr8 hr-double hr-dotted"></div>
							<div class="col-sm-5 pull-right">
									<h4 class="pull-right">
										Total amount :
										<span class="red"><i class="fa fa-inr"></i>{{$data['debit_amount']}}</span>
									</h4>
							</div>

							<div class="space-6"></div>
							<div class="well">
								<button class="btn btn-primary print-hide" onclick="window.print()">Print Invoice</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <br>
	<div class="{{$data['class']}} center print-hide">
		{{$data['sub_title']}}
	</div>
	<div class="alert alert-warning center print-hide">
		<strong>Note:</strong> To save invoice as pdf, click Ctrl+P or Print Button and then save as pdf.
	</div>
</body>
</html>
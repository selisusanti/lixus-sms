<!doctype html>
<html lang="en">
  <head>
	<title>LIXUS </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  
  </head>
  <body>
  		<div class="jumbotron text-center">
			<h1>Message Info</h1>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-striped">
						<tr>
							<th>No</th>
							<th>To</th>
							<th>From</th>
							<th>Text</th>
							<th>Status Sent</th>
							<th>Message Status</th>
							<th>Created</th>
						</tr>

						@foreach($data as $no => $item)
						<tr>
							<td>{{ $data->firstItem() + $no }}</td>
							<td>{{ $item->to }}</td>
							<td>{{ $item->from }}</td>
							<td>{{ $item->message }}</td>
							<td>
								@if($item->msg_status == '1')
									Success
								@else
									False
								@endif
							</td>
							<td>{{ $item->message_info }}</td>
							<td>{{ $item->created_at }}</td>
						</tr>
						@endforeach


					</table>
				</div>

				<div class="col-sm-12">
					{{ $data->links() }}
				</div>
			</div>
		</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

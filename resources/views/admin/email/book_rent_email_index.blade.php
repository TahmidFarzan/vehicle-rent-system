<h3>You have a  email from Vehicle rent System(VRS).</h3>
<p>Thank You user for your Book for per day.</p>
<div id="page-wrapper">
            <div class="row">
                <!-- Right side -->
                <div class="col-lg-9">
                  <!-- Show -->
                   <div class="panel panel-default">
                      <div class="panel-heading"><i class="fa fa-edit fa-fw"></i> Your Booking details</div>
                      <div class="panel-body"> 
                         <div class="table-responsive">
                         	<table class="table table-striped table-bordered table-hover">
                         		<tr>
                         			<td>Name</td>
                         			<td>:</td>
                         			<td>{{$name}}</td>
                         		</tr>
                         		<tr>
                         			<td>Mobile</td>
                         			<td>:</td>
                         			<td>{{$mobile}}</td>
                         		</tr>
                         		<tr>
                         			<td>Email</td>
                         			<td>:</td>
                         			<td>{{$email}}</td>
                         		</tr>
                         		<tr>
                         			<td>Journy date</td>
                         			<td>:</td>
                         			<td><input id="journey_date" type="date" class="form-control" name="journey_date" value="{{$journey_date }}" placeholder="EX:YYYY-MM-DD" readonly></td>
                         		</tr>
                         		<tr>
                         			<td>Return date</td>
                         			<td>:</td>
                         			<td><input id="return_date" type="date" class="form-control" name="return_date" value="{{$return_date}}" placeholder="EX:YYYY-MM-DD" readonly></td>
                         		</tr>
                         		<tr>
                         			<td>Description</td>
                         			<td>:</td>
                         			<td>{{$description}}</td>
                         		</tr>
                         		<tr>
                         			<td>Route</td>
                         			<td>:</td>
                         			<td>{{$route}}</td>
                         		</tr>
                         		<tr>
                         			<td>Vehicle Type</td>
                         			<td>:</td>
                         			<td>{{$vehicle_type}}</td>
                         		</tr>
                         		<tr>
                         			<td>Vehicle amount</td>
                         			<td>:</td>
                         			<td>{{$vehicle_amount}}</td>
                         		</tr>
                         		<tr>
                         			<td>Price</td>
                         			<td>:</td>
                         			<td>{{$price}}</td>
                         		</tr>
                                    <tr>
                                          <td>Toll</td>
                                          <td>:</td>
                                          <td>Paid by client</td>
                                    </tr>

                         	</table>
                         </div>          
                      </div>
                   </div>

                </div>
               
            </div>           
</div>
<p>Congratulation,Request has been accepted.</p>
<p>Sent via {{$admin_email}}</p>